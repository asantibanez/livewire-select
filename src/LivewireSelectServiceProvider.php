<?php

namespace Asantibanez\LivewireSelect;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

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
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'livewire-select');

        $this->app->afterResolving('blade.compiler', function (BladeCompiler $bladeCompiler) {
            Blade::directive('livewireSelectScripts', function () {
                return <<<'HTML'
                    <script>
                        window.livewire.on('livewire-select-focus-search', (data) => {
                            const el = document.getElementById(`${data.name || 'invalid'}`);

                            if (!el) {
                                return;
                            }

                            el.focus();
                        });

                        window.livewire.on('livewire-select-focus-selected', (data) => {
                            const el = document.getElementById(`${data.name || 'invalid'}-selected`);

                            if (!el) {
                                return;
                            }

                            el.focus();
                        });
                    </script>
HTML;
            });
        });
    }
}
