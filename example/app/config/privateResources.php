<?php
use Phalcon\Config;
use Phalcon\Logger;

return new Config([
    'privateResources' => [
        'session' => [
            'signup'
        ],
        'users' => [
            'signIn',
            'changePassword'
        ]

    ]
]);