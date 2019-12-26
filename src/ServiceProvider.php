<?php

namespace Den1n\NovaQueues;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->publishResources();
        $this->loadTranslations();

        // config('nova-queues.models.job')::observe(Observers\Job::class);
    }

    /**
     *  Publish package resources.
     */
    protected function publishResources(): void
    {
        $this->publishes([
            __DIR__ . '/../config/nova-queues.php' => config_path('nova-queues.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/nova-queues'),
        ], 'lang');
    }

    /**
     *  Load package translation files.
     */
    protected function loadTranslations(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'nova-queues');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'nova-queues');
        $this->loadJSONTranslationsFrom(__DIR__ . '/../resources/lang');
        $this->loadJsonTranslationsFrom(resource_path('lang/vendor/nova-queues'));
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/nova-queues.php', 'nova-queues');
    }
}
