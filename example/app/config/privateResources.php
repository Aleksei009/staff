<?php
use Phalcon\Config;
use Phalcon\Logger;

return new Config([
    'privateResources' => [

        'users' => [
            'index',
            'signIn',
            'changePassword',
            'auth',
            'table',
            'signUp',
            'delete',
            'save',
            'create',
            'new',
            'search',
            'register',
            'edit',
            'correct',
            'return',
            'time',
            'holiday'

        ],
    ]
]);