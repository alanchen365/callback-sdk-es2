<?php

namespace App\Module\Callback\Bean;

use AsaEs\Base\BaseBean;

class TaskBean extends BaseBean
{
    /**
     * 控制某个字段是否显示 建议在项目开始之前将不需要显示的字段设置成 protected
     * public 可见 任何地方可见
     * protected Api接口中不可见 但可以通过get方法 例getName() 来获取到值，但不能通过 $obj->name 的形式获得
     * private 私有变量 在程序中可以通过 例getName() 来获取到值 但不能通过 $obj->name 的形式获得
     * @var
     */

    protected $id;    //
    protected $task_code;    // 任务唯一id
    protected $system_id;    // 所属系统id
    protected $domain;    // 本地域名
    protected $path;    // 请求路径
    protected $request_header;    // 请求头
    protected $request_method;    // 请求方法
    protected $request_type;    // 请求类型
    protected $request_param;    // 请求body
    protected $request_count;    // 请求次数
    protected $status;    // 综合判定请求结果
    protected $next_time;    // 下次请求时间
    protected $create_time;    // 创建时间
    protected $update_time;    // 最后更新时间
    protected $response_business_code;    // 响应业务编码
    protected $response_http_code;    // 响应http code
    protected $response_body;    // 响应body
    protected $request_duration;    // 请求耗时
    protected $env;    //
    protected $result;    // 执行结果

    /**
     * sql语句查询的字段 配置哪个字段 查哪个，可以将无用的字段在开发前去掉
     * 如果这里去掉后， 即使在属性中设置public，也无法获取到值， 这里是数据的源头
     * 建议在项目开发之前就确定好哪些字段是无用的 直接将其删掉
     */
    protected $_fields = ['id','task_code','system_id','domain','path','request_header','request_method','request_type','request_param','request_count','status','next_time','create_time','update_time','response_business_code','response_http_code','response_body','request_duration','env','result',];


    /**
     * request_method 数据字典
     * @var array
     */
    public static $request_method_enum = [
    ];

    /**
     * request_type 数据字典
     * @var array
     */
    public static $request_type_enum = [
    ];

    /**
     * status 数据字典
     * @var array
     */
    public static $status_enum = [
    ];

    /**
     * env 数据字典
     * @var array
     */
    public static $env_enum = [
    ];


    /**
     * 数据填充后做一些操作
     */
    protected function beforeInitialize(): void
    {
    }
    /**
     * 数据表名.
     */
    public static $_tableName = 'callback_task';

    /**
     * 数据表前缀
     */
    public static $_prefix = '';

    /**
     * 获取数据表名 该方法必须写在子类
     * @return mixed
     */
    public static function getTableName(bool $prefix = true)
    {
        if ($prefix) {
            return self::$_prefix.self::$_tableName;
        }
        return self::$_tableName;
    }

    /**
     * 获取主键 该方法必须写在子类
     * @return mixed
     */
    public static function getPrimaryKey()
    {
        return self::$_primaryKey;
    }

    /**
     * 获取数据表名 该方法必须写在子类
     * @return mixed
     */
    public static function getPrefix()
    {
        return self::$_prefix;
    }


    /**
     * 获取.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * 获取任务唯一id.
     *
     * @return mixed
     */
    public function getTaskCode()
    {
        return $this->task_code;
    }

    /**
     * @param mixed $task_code
     */
    public function setTaskCode($task_code): void
    {
        $this->task_code = $task_code;
    }

    /**
     * 获取所属系统id.
     *
     * @return mixed
     */
    public function getSystemId()
    {
        return $this->system_id;
    }

    /**
     * @param mixed $system_id
     */
    public function setSystemId($system_id): void
    {
        $this->system_id = $system_id;
    }

    /**
     * 获取本地域名.
     *
     * @return mixed
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param mixed $domain
     */
    public function setDomain($domain): void
    {
        $this->domain = $domain;
    }

    /**
     * 获取请求路径.
     *
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path): void
    {
        $this->path = $path;
    }

    /**
     * 获取请求头.
     *
     * @return mixed
     */
    public function getRequestHeader()
    {
        return $this->request_header;
    }

    /**
     * @param mixed $request_header
     */
    public function setRequestHeader($request_header): void
    {
        $this->request_header = $request_header;
    }

    /**
     * 获取请求方法.
     *
     * @return mixed
     */
    public function getRequestMethod()
    {
        return $this->request_method;
    }

    /**
     * @param mixed $request_method
     */
    public function setRequestMethod($request_method): void
    {
        $this->request_method = $request_method;
    }

    /**
     * 获取请求类型.
     *
     * @return mixed
     */
    public function getRequestType()
    {
        return $this->request_type;
    }

    /**
     * @param mixed $request_type
     */
    public function setRequestType($request_type): void
    {
        $this->request_type = $request_type;
    }

    /**
     * 获取请求body.
     *
     * @return mixed
     */
    public function getRequestParam()
    {
        return $this->request_param;
    }

    /**
     * @param mixed $request_param
     */
    public function setRequestParam($request_param): void
    {
        $this->request_param = $request_param;
    }

    /**
     * 获取请求次数.
     *
     * @return mixed
     */
    public function getRequestCount()
    {
        return $this->request_count;
    }

    /**
     * @param mixed $request_count
     */
    public function setRequestCount($request_count): void
    {
        $this->request_count = $request_count;
    }

    /**
     * 获取综合判定请求结果.
     *
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * 获取下次请求时间.
     *
     * @return mixed
     */
    public function getNextTime()
    {
        return $this->next_time;
    }

    /**
     * @param mixed $next_time
     */
    public function setNextTime($next_time): void
    {
        $this->next_time = $next_time;
    }

    /**
     * 获取创建时间.
     *
     * @return mixed
     */
    public function getCreateTime()
    {
        return $this->create_time;
    }

    /**
     * @param mixed $create_time
     */
    public function setCreateTime($create_time): void
    {
        $this->create_time = $create_time;
    }

    /**
     * 获取最后更新时间.
     *
     * @return mixed
     */
    public function getUpdateTime()
    {
        return $this->update_time;
    }

    /**
     * @param mixed $update_time
     */
    public function setUpdateTime($update_time): void
    {
        $this->update_time = $update_time;
    }

    /**
     * 获取响应业务编码.
     *
     * @return mixed
     */
    public function getResponseBusinessCode()
    {
        return $this->response_business_code;
    }

    /**
     * @param mixed $response_business_code
     */
    public function setResponseBusinessCode($response_business_code): void
    {
        $this->response_business_code = $response_business_code;
    }

    /**
     * 获取响应http code.
     *
     * @return mixed
     */
    public function getResponseHttpCode()
    {
        return $this->response_http_code;
    }

    /**
     * @param mixed $response_http_code
     */
    public function setResponseHttpCode($response_http_code): void
    {
        $this->response_http_code = $response_http_code;
    }

    /**
     * 获取响应body.
     *
     * @return mixed
     */
    public function getResponseBody()
    {
        return $this->response_body;
    }

    /**
     * @param mixed $response_body
     */
    public function setResponseBody($response_body): void
    {
        $this->response_body = $response_body;
    }

    /**
     * 获取请求耗时.
     *
     * @return mixed
     */
    public function getRequestDuration()
    {
        return $this->request_duration;
    }

    /**
     * @param mixed $request_duration
     */
    public function setRequestDuration($request_duration): void
    {
        $this->request_duration = $request_duration;
    }

    /**
     * 获取.
     *
     * @return mixed
     */
    public function getEnv()
    {
        return $this->env;
    }

    /**
     * @param mixed $env
     */
    public function setEnv($env): void
    {
        $this->env = $env;
    }

    /**
     * 获取执行结果.
     *
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param mixed $result
     */
    public function setResult($result): void
    {
        $this->result = $result;
    }


    /**
     * 对private变量可写
     * @param string $name
     * @param $value
     */
    public function __set(string $name, $value): void
    {
        $this->$name = $value;
    }

    public function &__get(string $name)
    {
        return $this->$name;
    }
}
