<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('users', 'Api\UserController', [
    'except' => ['create', 'edit', 'destroy'],
]);
Route::resource('groups', 'Api\GroupController', [
    'except' => ['create', 'edit', 'destroy'],
]);
