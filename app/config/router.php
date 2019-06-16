<?php

use Phalcon\Mvc\Router;

$router = new Router();

//IndexController
$router->add(
    '/index',
    array(
        'controller' => 'index',
        'action' => 'index',
        'lang' => 1
    )
);

$router->add(
    '/start_time_work',
    array(
        'controller' => 'index',
        'action' => 'setstart',
        'lang' => 1
    )
);

$router->add(
    '/end_time_work',
    array(
        'controller' => 'index',
        'action' => 'setend',
        'lang' => 1
    )
);

//SessionController

$router->add(
    '/session/sign-in',
    array(
        'controller' => 'session',
        'action' => 'signIn'
    )
);

$router->add(
    '/session/auth-user',
    array(
        'controller' => 'session',
        'action' => 'auth'
    )
);

$router->add(
    '/session/remove-user',
    array(
        'controller' => 'session',
        'action' => 'removeAuth'
    )
);


$router->add(
    '/[a-z]{2}/[a-z]{2}',
    array(
        'controller' => 'session',
        'action' => 'signIn',
        'lang' => 1
    )
);

return $router;
