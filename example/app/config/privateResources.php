<?php
use Phalcon\Config;
use Phalcon\Logger;
return new Config([
    'privateResources' => [
        'Users' => [
            'index',
            'search'
        ],
        'Index' => [
            'index',
            'setstart',
            'setend'
        ],
        'Session' => [
            'index',

        ]
    ]
]);