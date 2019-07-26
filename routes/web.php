<?php
use Illuminate\Support\Facades\Input;

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

// Route::middleware('web')->group(function () {
//     Route::middleware('auth:admin')->prefix('admin')->group(function () {
Route::prefix('admin')->group(function () {
    Route::get('', 'Admin\DashboardController');
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
    Route::resource('admins', 'Admin\AdminController');
    Route::resource('writers', 'Admin\WriterController');
    Route::resource('permissions', 'Admin\PermissionController');
    Route::resource('roles', 'Admin\RoleController');
    
    Route::get('trashed-admins', 'Admin\AdminController@trashed')->name('admins.trashed');
    Route::get('trashed-writers', 'Admin\WriterController@trashed')->name('writers.trashed');
    Route::delete('admin-destroy/{id}', 'Admin\AdminController@userDestroy')->name('admin.force.destroy');
    Route::delete('writer-destroy/{id}', 'Admin\WriterController@userDestroy')->name('writer.force.destroy');
    Route::post('restore-admin/{id}', 'Admin\AdminController@restore')->name('admins.restore');
    Route::post('restore-writer/{id}', 'Admin\WriterController@restore')->name('writers.restore');

    Route::any('users/search',function(){
        $q = Input::get ( 'q' );
        $users = App\User::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->paginate();
        if(count($users) > 0) {
            return view('admin.users.index')->withUsers($users)->withQuery($q)->withTitle('Users Management')->withBreadcrumbItem('Search Users');
        } else {
              return redirect(route('users.index'))->withType('warning')->withMessage('No Details found. Try to search again !');
        }
    });
});



Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm')->name('login.admin');
Route::get('/login/writer', 'Auth\LoginController@showWriterLoginForm');
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');
Route::get('/register/writer', 'Auth\RegisterController@showWriterRegisterForm');

Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::post('/login/writer', 'Auth\LoginController@writerLogin');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin');
Route::post('/register/writer', 'Auth\RegisterController@createWriter');
Route::view('/writer', 'staff.writer')->middleware('auth');
 
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

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

// Socialite Register Routes
Route::get('social/{provider}', 'Auth\SocialController@redirect')->name('social.redirect');
Route::get('social/{provider}/callback', 'Auth\SocialController@callback')->name('social.callback');


Route::get('articles', 'ArticleController@index')->name('articles.index');
Route::get('articles/{id}','ArticleController@show')->name('articles.show'); 

use \App\Repositories\ElasticsearchArticleRepositoryInterface;

Route::get('/search', function (ElasticsearchArticleRepositoryInterface $repository) {
   
   $articles = $repository->search((string) request('q'));

//    dump($articles);
   return view('articles.index', [
       'posts' => $articles,
       'title' => 'Awesome Blog'
   ]);
});

