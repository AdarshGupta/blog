<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //works when the view is loaded
        // Is used here to load archives wherever there is sidebar layout
        // Registered  a composer - 'layouts.sidebar'
        view()->composer('layouts.sidebar', function($view){
            $view->with('archives', \App\Post::archives()); 
            // 'archives' => App\Post::archives()
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
