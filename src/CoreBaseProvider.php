<?php

namespace Thienhungho\Modules\CoreBase;

use Illuminate\Support\ServiceProvider;

class CoreBaseProvider extends ServiceProvider
{
    /**
     * Register Services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/core.php', 'core');
    }

    /**
     * Bootstrap Services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/core.php' => config_path('core.php'),
        ]);
    }
}
