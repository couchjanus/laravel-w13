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

// Route::get('about', 'AboutController@index');
// Route::get('about', 'AboutController')->name('about');
// Route::get('contact-us', 'ContactController@index')->name('contact');
Route::get('admin', 'Admin\DashboardController@index');
// Route::get('dashboard', ['uses' => 'Admin\DashboardController@index', 'as' => 'admin']);

Route::get('blog', ['uses' => 'PostController@index', 'as' => 'blog']);
Route::get('blog/{id}', ['uses' => 'PostController@show', 'as' => 'show']);

// Route::get('blog/create', ['uses' => 'PostController@create', 'as' => 'create']);
// Route::post('blog/create', ['uses' => 'PostController@store', 'as' => 'store']);

Route::get('/login', function () {
    return 'login';
})->name('login');

