<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Gadgets\Gadget;
use Blade;

class GadgetServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->singleton(Gadget::class, function ($app) {
        //     // return new Gadget();
        //     return new Gadget(config('gadgets'));
        // }); 

        $this->app->singleton('gadget', function ($app) {
            return new Gadget(config('gadgets'));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive(
            'gadget', function ($name) {
                return "<?php echo app('gadget')->show($name); ?>";
            }
        ); 
        /*
         * Регистрируем каталог для хранения шаблонов виджетов
         * views\widgets
         */
        $this->loadViewsFrom(resource_path('views/gadgets'), 'gadgets');
    }
}
