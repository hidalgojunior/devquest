<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // set locale and timezone based on authenticated user preferences
        if (auth()->check()) {
            $locale = auth()->user()->locale ?: config('app.locale');
            // set app locale for translation
            \Illuminate\Support\Facades\App::setLocale($locale);
            // set Carbon locale for date formatting
            \Carbon\Carbon::setLocale($locale);

            $timezone = auth()->user()->timezone ?: config('app.timezone');
            date_default_timezone_set($timezone);
        } else {
            // ensure default is applied
            \Carbon\Carbon::setLocale(config('app.locale'));
        }
    }
}
