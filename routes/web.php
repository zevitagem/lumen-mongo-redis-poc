<?php
/** @var \Laravel\Lumen\Routing\Router $router */
/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It is a breeze. Simply tell Lumen the URIs it should respond to
  | and give it the Closure to call when that URI is requested.
  |
 */

$router->get('/',
    function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'],
    function () use ($router) {

    $router->group(['prefix' => 'mongo', 'middleware' => 'database.mongo'],
        function () use ($router) {
        $router->post('/store', ApiController::class.'@store');
        $router->get('/list', ApiController::class.'@list');
        $router->get('', ApiController::class.'@list');
        $router->delete('/destroy', ApiController::class.'@destroy');
    });

    $router->group(['prefix' => 'cache'],
        function () use ($router) {
        $router->get('/user_list', UserController::class.'@list');
        $router->get('', UserController::class.'@list');
        $router->get('/user_find/{key}', UserController::class.'@find');
        $router->post('/user_store', UserController::class.'@store');
    });
});
