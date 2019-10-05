<?php

namespace visermort\typimultiinput;

use Illuminate\Support\ServiceProvider;

class MultiInputProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/multiinput.php' => config_path('multiinput.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/views' => resource_path('views/vendor/multiinput')
        ], 'views');

        $this->publishes([
            __DIR__.'/scss/admin' => resource_path('scss/admin'),
            __DIR__.'/scss/public' => resource_path('scss/public')
        ], 'scss');

        $this->publishes([
            __DIR__.'/js/admin' => resource_path('js/admin')
        ], 'js');

    }
}
