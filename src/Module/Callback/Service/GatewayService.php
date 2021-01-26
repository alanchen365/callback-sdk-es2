<?php

namespace App\Module\Callback\Service;

use AsaEs\AsaEsConst;
use AsaEs\Exception\MsgException;
use EasySwoole\Core\Component\Di;
use App\Module\Callback\Consts\CallbackConst;

class GatewayService
{
    /**
     * 投递任务 同步
     */
    public function push(array $taskList)
    {
        /** 是否开始事物 */
        $dbManager = Di::getInstance()->get(AsaEsConst::DI_MYSQL_DEFAULT);
        $isTransaction = method_exists($dbManager, 'isTransactionInProgress') && $dbManager->isTransactionInProgress();

        /** 外面没有开事物 里面就开 外面开里面就不开 */
        try {
            !$isTransaction ? $dbManager->startTransaction() : null;

            $taskService = new TaskService();

            /** 循环投递任务 */
            foreach ($taskList as $key => $task) {
                $taskService->push($task);
            }

            !$isTransaction ? $dbManager->commit() : null;

            /** 任务投递成功后发布 */
            $redis = Di::getInstance()->get(AsaEsConst::DI_REDIS_DEFAULT);
            $redisKey = strtolower(\App\AppConst\AppInfo::APP_EN_NAME . '_' . \App\AppConst\AppInfo::REDIS_KEY_ES3_SERVER_PORT . '_' . CallbackConst::REDIS_CALL_CHANNEL);
            $redis->publish($redisKey, 'INVALID');

        } catch (\Throwable $throwable) {
            !$isTransaction ? $dbManager->rollback() : null;
            throw new MsgException($throwable->getCode(), '任务投递异常:' . $throwable->getMessage());
        }
    }
}