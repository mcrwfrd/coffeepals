<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group(['prefix' => 'organization'], function () use ($router) {
	$router->post('register', 'AuthController@register');
	$router->post('login', 'AuthController@login');
	$router->post('logout', 'AuthController@logout');
});

$router->group([
	'middleware' => 'jwt.auth',
	'prefix' => 'users'
], function () use ($router) {
	$router->get('/', 'UserController@read');
	$router->post('/', 'UserController@create');
});