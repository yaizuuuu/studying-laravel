<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    $route = Route::current();
    $name = Route::currentRouteName();
    $action = Route::currentRouteAction();
    dd($route, $name, $action);
})->name('hello');

Route::get('/foo', function () {
    File::put(__DIR__ . '/file.txt', 'Lorem ipsum');
});

Route::get('find_user', function () {
    $find_user = \App\Eloquent\User::find(1);
    $find_users = \App\Eloquent\User::all();

    return View::make(
        'welcome',
        [
            'find_user' => $find_user,
            'find_users' => $find_users,
        ]
    );
});
