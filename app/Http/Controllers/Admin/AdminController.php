<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Customers;
use App\Models\Product;
use App\Models\ProductsOrder;
use App\Models\Services;
use App\Models\ServicesOrder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class AdminController extends Controller
{

    public $key = 'atr';
    public $value = 'dfdf';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashbord', [
            'products' =>  Product::all(),
            'customers' => Customers::all()->where('status' ,'0'),
            'customers_all' => Customers::all(),
            'services_order' => ServicesOrder::all()->where('status' ,'0'),
            'services' => Services::all(),
            'products_order' => ProductsOrder::all(),
        ]);
    }



    // public function setValueToCache(string $key = 'sad', $value = ['dfsd','sdfds'])
    // {
    //     $this->getRedis()->rawCommand('SET', $key, $value);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changeLocale($locale){

        session(['locale' => $locale]);
        App::setLocale($locale);
        return redirect()->back();

    }
}
