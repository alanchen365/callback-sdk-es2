<?php

namespace App\Module\Callback\Validate;

use AsaEs\Base\BaseValidate;

class TaskValidate extends BaseValidate
{
    /*
     * 验证规则
     * @var array
     */
    protected $rule = [
        'domain' => 'require',
        'path' => 'require',
        'request_method' => 'require',
        'request_type' => 'require',

    ];

    /**
     * 场景信息(场景不能为空 为空会验全部).
     */
    protected $scene = [
        // 添加的时候干嘛 这里记得加一个验证 一定不能为空
        'save' => ['domain', 'path', 'request_method', 'request_type'],
    ];

    /**
     * 变量和列绑定, 这里定义的是所有场景的绑定关系.
     *
     * @var array
     */
    protected $bindingField = [
        'domain' => 'domain',
        'path' => 'path',
        'request_method' => 'request_method',
        'request_type' => 'request_type',
    ];

    /**
     * 提示消息.
     *
     * @var array
     */
    protected $message = [];

    /**
     * 提示消息起别名
     * @var array
     */
    protected $field = [
        'domain' => '域名',
        'path' => '请求路径',
        'request_method' => '请求方法',
        'request_type' => '请求类型',
    ];
}