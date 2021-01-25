<?php

use FastRoute\RouteCollector;

return [
    '/callback' => function (RouteCollector $route) {
        // 添加
        $route->addRoute(['POST'], '/task', '/Callback/Task/save');
    },
];
