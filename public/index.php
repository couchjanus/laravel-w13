<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels great to relax.
|
*/
// $user = new \App\User();
// dd($user);

require __DIR__.'/../vendor/autoload.php';
// $user = new \App\User();
// dd($user);

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We need to illuminate PHP development, so let us turn on the lights.
| This bootstraps the framework and gets it ready for use, then it
| will load up this application so that we can run it and send
| the responses back to the browser and delight our users.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

// Извлекаем значение $_GET['user'], а если оно не задано,
// то возвращаем 'nobody'
// $username = $_GET['user'] ?? 'nobody';
// dd($username);

// dd($_ENV['APP_BASE_PATH']);
// dd(dirname(__DIR__));

// Класс приложения наследуется от сервис-контейнера:
// class Application extends Container implements ApplicationContract, HttpKernelInterface

// таким образом из объекта приложения ($app) можно получить доступ ко всем сервисам, которые регистрируются в сервис-контейнере. Например выполнив:
// dd(app('router'));

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/


$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Выведем на экран свойства данного объекта дописав следующей строкой:
// dd($kernel);


// вызывается метод handle() класса Illuminate\Foundation\Http\Kernel из файла vendor/laravel/framework/src/Illuminate/Foundation/Http/Kernel.php, который занимается обработкой входящего запроса:
// dd($request);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);


// Получив приложение, мы можем обработать входящий запрос через ядро и отправить соответствующий ответ обратно в браузер клиента, что позволит им насладиться креативным и замечательным приложением, которое мы для него подготовили.
// dd($response);

$response->send(); // отправляет HTTP-заголовки и контент.


$kernel->terminate($request, $response); // завершает работу приложения. 


// $env = env('APP_ENV');
// dd($env);
// Returns 'production' if APP_ENV is not set...
// $env = env('APP_ENV', 'production');
// dd($env);

// $environment = App::environment();
// dd($environment);

if (App::environment('local')) {
    // The environment is local
}

if (App::environment(['local', 'staging'])) {
    // The environment is either local OR staging...
}
config(['app.timezone' => 'Europe/Kiev']);
$value = config('app.timezone');
dd($value);

$time_end = microtime(true);
$time = $time_end - LARAVEL_START;
echo "Выполнено за $time секунд";
