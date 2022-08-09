<?php

use App\Http\Middleware\SetLocale;
use App\Models\Product;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use phpDocumentor\Reflection\Types\Null_;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Controllers\Controller;



$locale = App::currentLocale();




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('locale/{locale}', [\App\Http\Controllers\Admin\AdminController::class, 'changeLocale'])->name('locale');

Route::middleware('set_locale')->group(function()
{


    Route::prefix('/')->group(function(){

        Route::get('/', [\App\Http\Controllers\SiteController::class, 'index'])->name('index');
        Route::get('done/{done?}', [\App\Http\Controllers\SiteController::class, 'index'])->name('indexDone');
        Route::get('products', [\App\Http\Controllers\ProductController::class, 'index'])->name('products');
        Route::get('product/{id}/size/{size}', [\App\Http\Controllers\ProductController::class, 'show'])->name('product');
        Route::get('services', [\App\Http\Controllers\SiteController::class, 'services'])->name('services');
        Route::get('service/{id}/', [\App\Http\Controllers\SiteController::class, 'service'])->name('service');
        Route::post('storeServiceOrder', [\App\Http\Controllers\SiteController::class, 'storeServiceOrder'])->name('storeServiceOrder');
        Route::post('storeProductOrder', [\App\Http\Controllers\SiteController::class, 'storeProductOrder'])->name('storeProductOrder');
        Route::post('basket', [\App\Http\Controllers\SiteController::class, 'basket'])->name('basket');
        Route::get('favourite', [\App\Http\Controllers\SiteController::class, 'favourite'])->name('favourite');
        Route::get('deliveriesAndPayments', [\App\Http\Controllers\SiteController::class, 'showDeliveryAndPay'])->name('deliveriesAndPayments');
        // Route::get('mailviewservise', [\App\Http\Controllers\SiteController::class, 'viewMailService'])->name('viewMailService');
        // Route::get('mailviewproduct', [\App\Http\Controllers\SiteController::class, 'viewMailProduct'])->name('viewMailProduct');
        Route::get('news', [\App\Http\Controllers\SiteController::class, 'showNews'])->name('news');
        Route::get('contacts', [\App\Http\Controllers\SiteController::class, 'showContacts'])->name('contacts');
        Route::get('addToBascket', [\App\Http\Controllers\SiteController::class, 'addToBascket'])->name('addToBascket');


    });
});


Route::middleware('set_locale')->group(function ()
{
    Route::middleware('auth')->group(function()
    {
        Route::prefix('admin')->group(function()
        {
            //pages route
            Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin');
            Route::resource('productType', \App\Http\Controllers\Admin\ProductTypeController::class);
            Route::resource('category', \App\Http\Controllers\Admin\CategoryController::class);
            Route::resource('subCategory', \App\Http\Controllers\Admin\SubCategoryController::class);
            Route::resource('seo', \App\Http\Controllers\Admin\SeoController::class);
            Route::resource('newsCategory', \App\Http\Controllers\Admin\NewsCategoryController::class);
            Route::resource('servicesTypes', \App\Http\Controllers\Admin\ServicesTypeController::class);
            Route::resource('servicesCategory', \App\Http\Controllers\Admin\ServicesCategoryController::class);
            Route::resource('services', \App\Http\Controllers\Admin\ServicesController::class);
            Route::resource('trashBox', \App\Http\Controllers\Admin\TrashBoxController::class);
            Route::resource('servicesOrder', \App\Http\Controllers\Admin\ServiceOrderController::class);
            Route::resource('productsOrder', \App\Http\Controllers\Admin\ProductsOrderController::class);
            // create route
            Route::get('sliderCreate', [\App\Http\Controllers\Admin\ChildPageController::class, 'sliderCreate'])->name('childPage.sliderCreate');
            Route::get('sliderEdit/{slider_id}', [\App\Http\Controllers\Admin\ChildPageController::class, 'sliderEdit'])->name('childPage.sliderEdit');
            //delete route
            Route::get('servicesOrder/delete/{servicesOrder}', [\App\Http\Controllers\Admin\ServiceOrderController::class, 'delete'])->name('servicesOrder.delete');
            Route::get('productsOrder/delete/{productsOrder}', [\App\Http\Controllers\Admin\ProductsOrderController::class, 'delete'])->name('productsOrder.delete');
            Route::get('productType/delete/{productType}', [\App\Http\Controllers\Admin\ProductTypeController::class, 'delete'])->name('productType.delete');
            Route::get('category/delete/{category}', [\App\Http\Controllers\Admin\CategoryController::class, 'delete'])->name('category.delete');
            Route::get('subCategory/delete/{subCategory}', [\App\Http\Controllers\Admin\SubCategoryController::class, 'delete'])->name('subCategory.delete');
            Route::get('product/delete/{product}', [\App\Http\Controllers\Admin\ProductController::class, 'delete'])->name('product.delete');
            Route::get('servicesType/delete/{servicesType}', [\App\Http\Controllers\Admin\ServicesTypeController::class, 'delete'])->name('servicesTypes.delete');
            Route::get('servicesCategory/delete/{servicesCategory}', [\App\Http\Controllers\Admin\ServicesCategoryController::class, 'delete'])->name('servicesCategory.delete');
            Route::get('services/delete/{services}', [\App\Http\Controllers\Admin\ServicesController::class, 'delete'])->name('services.delete');
            Route::get('newsCategory/delete/{newsCategory}', [\App\Http\Controllers\Admin\NewsCategoryController::class, 'delete'])->name('newsCategory.delete');
            Route::get('news/delete/{news}', [\App\Http\Controllers\Admin\NewsController::class, 'delete'])->name('news.delete');
            Route::get('childPage/delete/{childPage}', [\App\Http\Controllers\Admin\ChildPageController::class, 'delete'])->name('childPage.delete');
            Route::get('seo/delete/{seo}', [\App\Http\Controllers\Admin\SeoController::class, 'delete'])->name('seo.delete');
            Route::get('trashBox/{prouct}/restore/', [\App\Http\Controllers\Admin\TrashBoxController::class, 'restore'])->name('trashBox.restore');
            Route::get('trashBox/{prouct}/productForceDelete/', [\App\Http\Controllers\Admin\TrashBoxController::class, 'productForceDelete'])->name('trashBox.productForceDelete');
            Route::post('product/mediaUpdatePdf/{product}', [\App\Http\Controllers\Admin\ProductController::class, 'mediaUpdatePdf'])->name('product.mediaUpdatePdf');
            // Route::get('setValueToCache', [\App\Http\Controllers\Admin\AdminController::class, 'setValueToCache'])->name('admin.setValueToCache');

            Route::middleware('optimizeImages')->group(function (){
                Route::post('product/mediaUpdate/{product}', [\App\Http\Controllers\Admin\ProductController::class, 'mediaUpdate'])->name('product.mediaUpdate');
                Route::post('servicesType/mediaUpdate/{servicesType}', [\App\Http\Controllers\Admin\ServicesTypeController::class, 'mediaUpdate'])->name('servicesType.mediaUpdate');
                Route::post('news/mediaUpdate/{news}', [\App\Http\Controllers\Admin\NewsController::class, 'mediaUpdate'])->name('news.mediaUpdate');
                Route::post('childPage/mediaUpdate/{childPage}', [\App\Http\Controllers\Admin\ChildPageController::class, 'mediaUpdate'])->name('childPage.mediaUpdate');
                Route::resource('product', \App\Http\Controllers\Admin\ProductController::class);
                Route::resource('news', \App\Http\Controllers\Admin\NewsController::class);
                Route::resource('childPage', \App\Http\Controllers\Admin\ChildPageController::class);
            });
        });
    });
});


require __DIR__.'/auth.php';
