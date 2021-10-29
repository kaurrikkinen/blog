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

$router->group(["prefix" => "api"], function () use ($router) {

    $router->get("categories", ["uses" => "CategoryController@getAllCategories"]);

    $router->post("categories", ["uses" => "CategoryController@create"]);

    $router->put("categories/{id}", ["uses" => "CategoryController@update"]);

    $router->get("posts/{category_id}", ["uses" => "PostController@getPosts"]);

    $router->post("posts", ["uses" => "PostController@create"]);

    $router->put("posts/{id}", ["uses" => "PostController@update"]);

    $router->delete("posts/{id}", ["uses" => "PostController@delete"]);
});
