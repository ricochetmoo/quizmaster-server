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

$router->get('/', function () use ($router)
{
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router)
{
    $router->get('quizzes', ['uses' => 'QuizController@showAll']);
    $router->get('quizzes/{id}', ['uses' => 'QuizController@showOne']);
    $router->post('quizzes', ['uses' => 'QuizController@create']);
    $router->put('quizzes/{id}', ['uses' => 'QuizController@update']);
    $router->delete('quizzes/{id}', ['uses' => 'QuizController@delete']);
});