<?php

$router = new Phalcon\Mvc\Router();

$router->add('/example/users/signUp}', [
    'controller' => 'users',
    'action' => 'signUp'
]);

/*$router->add('/reset-password/{code}/{email}', [
    'controller' => 'user_control',
    'action' => 'resetPassword'
]);*/
//$router->handle();
return $router;

/*$router = $di->getRouter();

$router->add('/confirm/{code}/{email}', [
    'controller' => 'user_control',
    'action' => 'confirmEmail'
]);
$router->add('/reset-password/{code}/{email}', [
    'controller' => 'user_control',
    'action' => 'resetPassword'
]);

$router->add('/users/signUp', [
    'controller' => 'users',
    'action' => 'signUp'
]);

// Define your routes here



$router->handle();*/
