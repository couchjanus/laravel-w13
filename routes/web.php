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
// Auth::routes(['verify' => true]);

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


use Illuminate\Support\Facades\Log;

Route::get('/test-log', function () {    
    Log::info('This is an info message that someone has arrived at the welcome page.');
    // Log::channel('slack')->info('This is an informative Slack message.');

    // Log::stack(['single', 'stderr'])->critical('I need ice-cream!');

    // Log::alert('This page was loaded', ['user' => 3, 'previous_page' => 'www.google.com']);

    // Log::emergency($message);
    // Log::alert($message);
    // Log::critical($message);
    // Log::error($message);
    // Log::warning($message);
    // Log::notice($message);
    // Log::info($message);
    // Log::debug($message);

    return '<h1>Welcome back User</h1>';
});

Route::get('/reminder', function () {
    // return new App\Mail\Reminder();
    return new App\Mail\Reminder('Blahamuha');

});

use Illuminate\Support\Facades\Mail;
// use App\Mail\Reminder;

Route::get('/send-test', function () {
    Mail::to('kuku@my.cat')->send(new Reminder('Blahamuha'));
    return 'Email was sent';
});

// Route::get('register/request', 'Auth\RegisterController@requestInvitation')->name('requestInvitation');

// Route::post('invitations', 'InvitationsController@store')->middleware('guest')->name('storeInvitation');

Route::get('/invite', function () {
    // $invoice = App\Order::find(1);
    // return (new App\Mail\InvitationMail())->render();
    // return (new App\Mail\InvitationMail('http://localhost:8000/register/writer?invitation_token=81c146559d06248a18c36c699e3efcd8'))->render();
    $url = App\Invitation::find(1)->getLink();
    return (new App\Mail\InvitationMail($url))->render();
});

Route::get('sendbasicemail','MailController@basic_email');
Route::get('sendhtmlemail','MailController@html_email');
Route::get('sendattachmentemail','MailController@attachment_email');


// Socialite Register Routes
Route::get('social/{provider}', 'Auth\SocialController@redirect')->name('social.redirect');
Route::get('social/{provider}/callback', 'Auth\SocialController@callback')->name('social.callback');
