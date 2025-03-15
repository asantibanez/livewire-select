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

        Blade::directive('livewireSelectScripts', function () {
            return <<<'HTML'
                <script>
                        window.Livewire.on('livewire-select-focus-search', (data) => {
                            setTimeout(() => {
                                const elementId = `${data[0].name || 'invalid'}`;
                                const el = document.getElementById(elementId);
                                console.log('focus-search')
                                console.log(elementId)
                                console.log(el);

                                if (!el) {
                                    return;
                                }

                                el.focus();
                            }, 100);
                        });

                        window.Livewire.on('livewire-select-focus-selected', (data) => {
                            setTimeout(() => {
                                const elementId = `${data[0].name || 'invalid'}-selected`;
                                const el = document.getElementById(elementId);
                                console.log('focus-selected')
                                console.log(elementId)
                                console.log(el);

                                if (!el) {
                                    return;
                                }

                                el.focus();
                            }, 100);
                        });
                    </script>
HTML;
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
