<?php

$router = new Phalcon\Mvc\Router();

$router->add('/example/users/signUp', [
    'controller' => 'users',
    'action' => 'signUp'
]);

$router->add('/example/session-{dsd}/signup', [
    'controller' => 'users',
    'action' => 'signUp'
]);

$router->add('/reset-password/{code}/{email}', [
    'controller' => 'user_control',
    'action' => 'resetPassword'
]);
//$router->handle();
 return $router;

