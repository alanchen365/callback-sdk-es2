<?php

namespace App\Module\Callback\Dao;

use App\AppConst\EnvConst;
use App\Module\Callback\Bean\TaskBean;
use AsaEs\Base\BaseDao;

class TaskDao extends BaseDao
{
    public function __construct(?string $beanName = null)
    {
        $this->setBeanObj(new TaskBean());
    }


    public function pushList(string $apiCode)
    {
        $env = strtoupper(EnvConst::ENV);
        $sql = "
            SELECT
                system.id system_id,
                system.system_name,
                system.request_header,
                system.system_code,
                system.domain,
                system.response_key_code,
                system.response_key_msg,
                system.response_success_condition,
                system.response_success_value,
                api.api_code,
                api.api_name,
                api.path,
                api.request_method,
                api.request_type 
            FROM
                `callback_system_api` system_api
                LEFT JOIN `callback_api` api ON system_api.`api_code` = api.`api_code`
                LEFT JOIN `callback_system` system ON system_api.system_code = system.system_code 
            WHERE
                api.delete_flg = 0 
                AND system.delete_flg = 0 
                AND api.api_code = '{$apiCode}' 
                AND system.env = '{$env}'
              ";

        $list = $this->query($sql);
        return $list;
    }

    public function getTaskList(array $taskCodes)
    {
        $taskCodeStr = implode("','", $taskCodes);
        $sql = "
            SELECT
                *
            FROM
                callback_task
            WHERE
                task_code IN ('{$taskCodeStr}')
        ";
        return $this->querySql($sql);
    }
}