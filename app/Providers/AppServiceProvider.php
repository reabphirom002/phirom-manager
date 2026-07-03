<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // នាំចូលប្រព័ន្ធគ្រប់គ្រង URL Facade

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
        // បង្ខំឱ្យប្រព័ន្ធបង្កើតតំណភ្ជាប់ (Assets, CSS, JS, Images) ជាប្រភេទ HTTPS ជានិច្ចនៅលើ Cloud
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}