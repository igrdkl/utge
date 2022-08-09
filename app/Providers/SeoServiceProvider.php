<?php

namespace App\Providers;

use App\Models\Seo;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class SeoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('site.index', function($view){
            $view->with('seos',  Seo::all());
        });
    }
}
