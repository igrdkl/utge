<?php

namespace App\Providers;

use App\Models\Seo;
use App\Models\Product;
use App\Models\Category;
use App\Models\ChildPage;
use App\Models\Customers;
use App\Models\ServicesType;
use App\Models\ServicesOrder;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\ProductsOrder;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        View::composer('site.index', function($view){
            $view->with('phones',  ChildPage::all()->where('route', 'phone'));
        });
        View::composer('site.index', function($view){
            $view->with('logoImg',  ChildPage::all()->where('route', 'logo-img'));
        });
        View::composer('site.index', function($view){
            $view->with('logoName',  ChildPage::all()->where('route', 'logo-name'));
        });
        View::composer('site.index', function($view){
            $view->with('footerPlace',  ChildPage::all()->where('route', 'footer-place'));
        });
        View::composer('site.index', function($view){
            $view->with('email',  ChildPage::all()->where('route', 'email'));
        });
        View::composer('site.index', function($view){
            $view->with('categories',  Category::all());
        });
        View::composer('site.index', function($view){
            $view->with('servicesType',  ServicesType::all());
        });

        View::composer('admin.admin', function($view){
            $view->with('servicesOrders',  ServicesOrder::all()->where('status' , '0'));
        });

        View::composer('admin.admin', function($view){
            $view->with('productsOrders',  Customers::all()->where('status' , '0'));
        });

        View::composer('admin.admin', function($view){
            $view->with('trashProduct',  Product::onlyTrashed()->paginate(20));
        });


    }
}
