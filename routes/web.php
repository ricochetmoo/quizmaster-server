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
    $router->post('register', ['uses' => 'AuthController@register']);
    $router->post('login', ['uses' => 'AuthController@login']);

    $router->get('profile', ['uses' => 'UserController@profile']);
    $router->get('users', ['uses' => 'UserController@showAll']);
    $router->get('users/{id}', ['uses' => 'UserController@showOne']);
    
    $router->get('quizzes', ['uses' => 'QuizController@showAll']);
    $router->get('quizzes/{id}', ['uses' => 'QuizController@showOne']);
    $router->post('quizzes', ['uses' => 'QuizController@create']);
    $router->put('quizzes/{id}', ['uses' => 'QuizController@update']);
    $router->delete('quizzes/{id}', ['uses' => 'QuizController@delete']);

    $router->get('questions', ['uses' => 'QuestionController@showAll']);
    $router->get('questions/byQuiz/{id}', ['uses' => 'QuestionController@showByQuiz']);
    $router->get('questions/{id}', ['uses' => 'QuestionController@showOne']);
    $router->get('questions/{id}/next', ['uses' => 'QuestionController@showNextInQuiz']);
    $router->get('questions/{id}/previous', ['uses' => 'QuestionController@showPreviousInQuiz']);
    $router->post('questions', ['uses' => 'QuestionController@create']);
    $router->put('questions/{id}', ['uses' => 'QuestionController@update']);
    $router->delete('questions/{id}', ['uses' => 'QuestionController@delete']);
});