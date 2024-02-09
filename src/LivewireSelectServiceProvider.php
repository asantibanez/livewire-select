<?php

namespace Asantibanez\LivewireSelect;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class LivewireSelectServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'livewire-select');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/livewire-select'),
            ], 'livewire-select-views');
        }

        $livewireSelect = new LivewireSelect;
        Blade::directive('livewireSelectScripts', function ($options) use ($livewireSelect) {
            return $livewireSelect->js($options);
        });
        Blade::directive('livewireSelectStyles', function ($options) use ($livewireSelect) {
            return $livewireSelect->css($options);
        });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'livewire-select');
    }
}
