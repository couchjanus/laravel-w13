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


Route::get('blog', ['uses' => 'PostController@index', 'as' => 'blog']);
// Route::get('blog/{id}', ['uses' => 'PostController@show', 'as' => 'show']);
Route::get('blog/{slug}', 'PostController@show')->name('blog.show');

// Route::resource(
//     'blog', 'PostController', [
//         'only' => [ 'index', 'show' ]
//     ]
// );

// Route::resource(
//     'blog', 'PostController', [
//         'except' => [
//             'create', 'store', 'update', 'destroy'
//         ]
//     ]
// );

Route::get('admin', 'Admin\DashboardController@index');
Route::resource('posts', 'Admin\PostController');
Route::resource('categories', 'Admin\CategoryController');

Route::prefix('admin')->group(function () {
    Route::get('', 'Admin\DashboardController@index');
    Route::get('categories-sort', 'Admin\CategoryController@sortByDate')->name('categories.sort');
    Route::get('status', 'Admin\PostController@getPostsByStatus')->name('posts.status');
    Route::get('sort', 'Admin\PostController@sortPostsByDate')->name('posts.sort');
    Route::get('trashed', 'Admin\UserController@trashed')->name('users.trashed');
    Route::delete('user-destroy/{id}', 'Admin\UserController@userDestroy')->name('user.force.destroy');
    Route::post('restore/{id}', 'Admin\UserController@restore')->name('users.restore');
    Route::resource('posts', 'Admin\PostController');
    Route::resource('categories', 'Admin\CategoryController');
    Route::resource('users', 'Admin\UserController');
});

 
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('test', 'HomeController@showRequest');