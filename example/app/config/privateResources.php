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

        ],
        'users' => [
            'signUp',
            'changePassword',
            'auth'
        ],

    ]
]);