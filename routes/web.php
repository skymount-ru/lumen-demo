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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api', 'namespace' => '\App\Http\Controllers'], function () use ($router) {
    $router->get('books', ['uses' => 'BookController@showAllBooks']);
    $router->post('books', ['uses' => 'BookController@create']);
    $router->get('books/{id}', ['uses' => 'BookController@showBook']);
    $router->put('books/{id}', ['uses' => 'BookController@update']);
    $router->delete('books/{id}', ['uses' => 'BookController@delete']);

    $router->post('graphql', ['uses' => 'GraphqlController@index']);
    $router->options('graphql', ['uses' => 'GraphqlController@index']);
});
