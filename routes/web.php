<?php

Route::get('/', function () {
    return view('welcome');
});

// Route::get('about', 'AboutController@index');
// Route::get('about', 'AboutController')->name('about');
// Route::get('contact-us', 'ContactController@index')->name('contact');

// Route::get('blog', ['uses' => 'PostController@index', 'as' => 'blog']);
// Route::get('blog/{slug}', 'PostController@show')->name('blog.show');

Route::prefix('blog')->group(function () {
    Route::get('', 'PostController@index')->name('blog');
    Route::get('/{slug}', 'PostController@show')->name('blog.show');
 
    Route::get('category/{id}', 'PostController@getPostsByCategory')->name('blog.category');
});

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
    Route::resource('tags', 'Admin\TagController');
});
 
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('posts-by-cat', function () {
    $posts = \App\Category::find(10)->posts;
    foreach ($posts as $post) {
        dump($post);
    }
    dump(\App\Category::find(1)->posts->first()->title);
});

Route::get('posts-by-status', function () {
    $category = \App\Category::find(2);
    $posts = $category->posts()->get();
    $posts = $category->posts->where('status', 1)->all();
    foreach ($posts as $post) {
        dump($post);
    }
});


Route::middleware('web')->group(function () {
    Route::middleware('auth')->prefix('profile')->group(function () {
        Route::get('', 'ProfileController@index')
            ->name('profile');
        Route::put('information', 'ProfileController@store')
            ->name('profile.info.store');
        Route::get('security', 'ProfileController@showPasswordForm')
            ->name('profile.security');
        Route::put('security', 'ProfileController@storePassword')
            ->name('profile.security.store');
        Route::get('delete-account', 'ProfileController@showDeleteAccountConfirmation')
            ->name('profile.delete.show');
        Route::delete('delete-account', 'ProfileController@deleteAccount')
            ->name('profile.remove');
    });
});


Route::get('test', 'GadgetTestController@index');
