<?php

namespace App\Module\Callback\Service;

use App\AppConst\EnvConst;
use App\Module\Callback\Bean\TaskType;
use App\Module\Callback\Dao\TaskDao;
use App\Module\Callback\Validate\TaskValidate;
use AsaEs\Exception\MsgException;
use AsaEs\Utility\Tools;

class TaskService extends BaseCallbackService
{
    public function __construct()
    {
        $this->setDaoObj(new TaskDao());
    }


    public function push(TaskType $task): void
    {
        /** 推送系统列表 */
        $pushList = $this->getDaoObj()->pushList($task->getApiCode());
        if (Tools::superEmpty($pushList)) {
            throw new MsgException(7101, '未找到api:' . $task->getApiCode() . '的推送配置');
        }

        /** 拼接整理参数 */
        $tasks = [];
        foreach ($pushList as $key => $push) {
            //response_success_condition 和 response_success_value 是否都传递了
            $successCondition = $push['response_success_condition'];
            $successValue = $push['response_success_value'];

            if (Tools::superEmpty($successCondition)) {
                throw new MsgException(7013, "system没有配置response_success_condition字段");
            }

            if (Tools::superEmpty($successValue)) {
                throw new MsgException(7014, "system没有配置response_success_value字段");
            }

            /** 获取task code */
            $taskCode = $task->getTaskCode();
            if (Tools::superEmpty($taskCode)) {
                $taskCode = md5(uniqid(microtime(true), true));
            }
            $taskCode = md5($taskCode . $push['system_code'] ?? null);
            $headers = array_merge(json_decode($push['request_header'], true) ?? [], $task->getRequestHeader() ?? []);

            $tasks[] = [
                'task_code' => md5($taskCode),
                'system_id' => $push['system_id'],
                'domain' => $push['domain'],
                'path' => $push['path'],
                'request_header' => json_encode($headers),
                'request_method' => $push['request_method'],
                'request_type' => $push['request_type'],
                'request_param' => json_encode($task->getRequestParams()),
                'env' => strtoupper(EnvConst::ENV),
            ];
        }

        if (Tools::superEmpty($tasks)) {
            throw new MsgException(7102, '未找到推送配置');
        }

        /** codes 是否重复 */
        $taskCodes = array_column($tasks, 'task_code') ?? [];
        $taskList = empty($taskCodes) ? [] : $this->getDaoObj()->getTaskList($taskCodes);

        if (!Tools::superEmpty($taskList)) {
            $taskCode = array_column($taskList, 'task_code');
            $taskCode = implode(',', $taskCode);
            throw new MsgException(7011, "任务编码 " . $taskCode . " 已存在 请更换");
        }

        /** 是否必填 */
        $taskValidate = new TaskValidate();
        foreach ($tasks as $taskArr) {
            $taskValidate->verify('save', $taskArr);
            if (!in_array($taskArr['request_method'], ['GET', 'POST', 'PUT', 'DELETE'])) {
                throw new MsgException(7012, "请求方法[" . $taskArr['request_method'] . "]传递有误 请更换");
            }
            if (!in_array($taskArr['request_type'], ['JSON'])) {
                throw new MsgException(7013, "请求类型[" . $taskArr['request_type'] . "]传递有误 请更换");
            }
        }

        /** 投递任务 */
        $this->getDaoObj()->insertAll($tasks);
    }

    /**
     * @return TaskDao
     */
//    public function getDaoObj(): TaskDao
//    {
//        return $this->daoObj;
//    }

}