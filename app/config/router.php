<?php

/*$router = new Phalcon\Mvc\Router();

$router->add('/example/ssss', [
    'controller' => 'users',
    'action' => 'test'
]);

$router->add('/example/test', [
    'controller' => 'users',
    'action' => 'test'
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

$router->handle();
 return $router;*/

/*$router = new \Phalcon\Mvc\Router(false);
$router->removeExtraSlashes(true);
$request = new \Phalcon\Http\Request();
$action = strtolower($request->getMethod()); // get, post, etc.
$modules = ['calendar', 'main', 'user']; // names of the modules you create

// you can define other static routes here

foreach ($modules as $module) {
    // must match what you register with the Loader service
    $namespace = 'App\\' . ucfirst($module) . '\Controllers';

    // make a group to avoid setting namespace and module for every route definition
    $moduleGroup = new \Phalcon\Mvc\Router\Group([
        'namespace' => $namespace,
        'module' => $module
    ]);

    // this will match a route like /calendar/index/save
    $moduleGroup->add("/{$module}/:controller/:action", [
        'controller' => 'session',
        'action' => 'login'
    ]);

    // setting a prefix will apply it to all routes below
    $moduleGroup->setPrefix('/api');

    // this will match a route like /api/calendar/index/save
    $moduleGroup->add("/{$module}/([a-zA-Z_]+)/:action", [
        'controller' => 1,
        'action' => 2
    ]);

    // this will match a route like /api/calendar/123
    $moduleGroup->add("/{$module}/:int", [
        'moduleId' => 1,
        'controller' => 'index',
        'action' => $action // defined at the top of example
    ]);

    $router->mount($moduleGroup);
}

// you can define other static routes here

return $router;*/


use Phalcon\Mvc\Router;

$router = new Router();

$router->add(
    '/session-you-can-sigup/none',
    array(
        'controller' => 'session',
        'action' => 'signIn',
        'lang' => 1
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
