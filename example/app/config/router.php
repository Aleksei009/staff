<?php

$router = new Phalcon\Mvc\Router();

$router->add('/example/users/signUp', [
    'controller' => 'users',
    'action' => 'signUp'
]);
$router->add('/example/users/change-password', [
    'controller' => 'users',
    'action' => 'changePassword'
]);

$router->add('/example/session/signup-{id}', [
    'controller' => 'users',
    'action' => 'signUp'
]);

$router->add('/reset-password/{code}/{email}', [
    'controller' => 'user_control',
    'action' => 'resetPassword'
]);
//$router->handle();
 return $router;

