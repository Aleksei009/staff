<?php
use Phalcon\Config;
use Phalcon\Logger;

return new Config([
    'privateResources' => [

        'session' => [
            'signup',
            'login',
            'logout',
            'index',
            'register',
        ],

        'admin' => [
            'signup',
        ],
        'users' => [
            'signup',
            'delete',
            'changePassword',
            'auth',
            'table',
            'login',
            'logout',
        ],
    ]
]);