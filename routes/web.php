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

Route::get('/hello', function()
{
   return 'Hello World';
});

Route::match(['get', 'post'], '/foobar', function () {
    return 'Hello FooBar!';
});

Route::any('foomar', function () {
    return 'Hello Foomar!';
});
 
Route::get('hello-bar', function () {
    return 'Hello Bar!';
})->name('bar');
 
Route::get('hello-barz', [function () {
    return 'Hello Bar!';
}, 'as' => 'barz']);
 

Route::get('barab', [function () {return 'Hello Bar!';}, 'as' => 'barz']);

Route::get('/hey', function () {
    return view('hello');
});


Route::get('/greeting', function () {
    return view('greeting', ['name' => 'Couch Janus']);
});

Route::get('/ole', function() {
    return view('hello.greeting', ['name' => 'Janus']);
});

Route::get('/oleole', function() {
    return view('hello/greeting', ['name' => 'Ole Janus']);
});

Route::get('/heyYou', function() {
    if (view()->exists('hello/greeting')) {
        return view('hello/greeting', ['name' => 'Hey U Janus! Whatsapp?']);
    }
});

Route::get('/bazuka', function() {
    return view('home/bazuka', ['name' => 'Hey U Janus! Whatsapp?', 'title' => 'Bazuka Page', 'fooUrl'=>'heyYou']);
});


Route::get('test', function () {
    $sampleArray = ['one', 'two', 'three'];
    dump($sampleArray);
    return 'Test Dump Server';
});

Route::get('/test-controller', 'TestController@index')->name('tdd');

// Route::get('about', 'AboutController@index');
// Route::get('about', 'AboutController')->name('about');
// Route::get('contact-us', 'ContactController@index')->name('contact');

// // Route::get('admin', 'Admin\DashboardController@index');
// Route::get('dashboard', ['uses' => 'Admin\DashboardController@index', 'as' => 'admin']);

// Route::get('blog', ['uses' => 'PostController@index', 'as' => 'blog']);

// Route::get('blog/create', ['uses' => 'PostController@create', 'as' => 'create']);

// Route::post('blog/create', ['uses' => 'PostController@store', 'as' => 'store']);

// Route::get('blog/{id}', 
// ['uses' => 'PostController@show', 'as' => 'show']);

