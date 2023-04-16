<?php

/**
 * PHP Version 8.*
 * Laravel Framework 9.* - 10.*
 *
 * @category ServiceProvider
 *
 * @package Laravel
 *
 * @author CWSPS154 <codewithsps154@gmail.com>
 *
 * @license MIT License https://opensource.org/licenses/MIT
 *
 * @link https://github.com/CWSPS154
 *
 * Date 15/04/23
 * */

namespace CWSPS154\Settings;

use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/config/settings.php', 'settings');
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/resources/views/', 'settings');
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations/');
        $this->publishes([__DIR__.'/resources/views/settings' => resource_path('views/vendor/settings')], 'components');
        $this->publishes([__DIR__.'/config/settings.php' => config_path('settings.php')], 'config');
        $this->publishes([__DIR__.'/database/migrations/' => database_path('migrations')], 'migrations');
    }
}
