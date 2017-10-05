<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Billing\Stripe;

class AppServiceProvider extends ServiceProvider
{
    // Avoids loading on every single pade and only when requested but can't use
    // here since we have some work being done in boot method
    //protected $defer = true;
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
            //$view->with('archives', \App\Post::archives()); 
            // 'archives' => App\Post::archives()

            //$view->with('tags', \App\Tag::has('posts')->pluck('name'));
            // To add tags to the sidebar
            // has('posts') allows only tags which are associated some or other post

            // OR
            $archives = \App\Post::archives();
            $tags = \App\Tag::has('posts')->pluck('name');
            $view->with(compact('archives', 'tags'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Bind into the container
        $this->app->singleton(Stripe::class, function(){
            return new Stripe(config('services.stripe.secret'));
            // returning an instance of a stripe class passing the secret API key
        }); 
    }
}
