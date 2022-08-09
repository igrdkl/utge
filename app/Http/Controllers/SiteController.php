<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\Product;
use App\Models\SizePrice;
use App\Models\ChildPage;
use App\Models\ServicesType;
use App\Filters\NewsFilter;
use App\Filters\ProductFilter;
use App\Models\Services;
use App\Models\ServicesCategory;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Requests\MultiRequest;
use App\Http\Requests\StoreServicesOrderRequest;
use App\Models\ServicesOrder;
use Illuminate\Auth\Events\Validated;
use App\Mail\OrderShipped;
use App\Models\Category;
use App\Models\Customers;
use App\Models\ProductOrder;
use Illuminate\Support\Facades\Mail;
use App\Models\ProductsOrder;
use App\Mail\ProductOrderShipped;

class SiteController extends Controller
{

    public function index(ProductFilter $request, $done = false)
    {
        $products = Product::filter($request)->where('home_view', '1')->paginate(12);

        return view('site.firstPage', [
            'products' => $products,
            'about_us' => ChildPage::all()->where('route', 'about_us'),
            'slider1' => ChildPage::where('route', 'slider1')->orderBy('order')->get(),
            'slider2' => ChildPage::where('route', 'slider2')->orderBy('order')->get(),
            'slider3' => ChildPage::where('route', 'slider3')->orderBy('order')->get(),
            'slider4' => ChildPage::where('route', 'slider4')->orderBy('order')->get(),
            'done' => $done,
        ]);
    }


    public function basket ()
    {
        $products = Product::all();

        return view('site.basket', [
            'products' => $products
        ]);
    }
    public function favourite ()
    {
        $products = Product::all();

        return view('site.favourite', [
            'products' => $products,
        ]);
    }

    public function showContacts()
    {
        $contacts = ChildPage::all()->where('route', 'contacts');

        return view('site.contacts', [
            'contacts' => $contacts,
        ]);

    }

    public function showDeliveryAndPay()
    {

        $deliveries = ChildPage::all()->where('route', 'delivery');
        $payments = ChildPage::all()->where('route', 'payment');
        $contacts = ChildPage::all()->where('route', 'contacts');

        return view('site.deliveryAndPay', [
            'deliveries' => $deliveries,
            'payments' => $payments,
        ]);
    }

    public function showNews(NewsFilter $request)
    {

        $news = News::filter($request)->paginate(4);
        $newsCategories = NewsCategory::all();
        $phones = ChildPage::all()->where('route', 'phone');

        return view('site.news', [
            'news' => $news,
            'newsCategories' => $newsCategories,
            'phones' => $phones,
        ]);

    }

    public function services()
    {
        $services = ServicesType::all();

        return view('site.services', [
            'services' => $services,
        ]);

    }

    public function service(ServicesType $id)
    {
        $types = ServicesType::all()->where('id', $id->id);
        $categories = ServicesCategory::all()->where('service_type_id', $id->id);
        $services = Services::all();

        return view('site.services.index', [

            'categories' => $categories,
            'services' => $services,
            'types' => $types,

        ]);
    }

    public function storeServiceOrder(StoreServicesOrderRequest $request)
    {


        $serviceOrder = new ServicesOrder();
        $validated = $request->validated();
        $serviceOrder->firstname = $request->firstname;
        $serviceOrder->lastname = $request->lastname;
        $serviceOrder->phone = $request->phone;
        $serviceOrder->email = $request->email;
        $serviceOrder->interes = $request->interes;
        $serviceOrder->status = '0';
        $serviceOrder->fill($request->validated());
        $serviceOrder->save();


        $user = 'info@utge.net';
        Mail::to($user)->send(new OrderShipped($serviceOrder));

        return redirect()->back();
    }
    public function storeProductOrder(StoreServicesOrderRequest $request, Product $product_all)
    {


        $customers = new Customers();
        $validated = $request->validated();
        $customers->firstname = $request->firstname;
        $customers->lastname = $request->lastname;
        $customers->phone = $request->phone;
        $customers->city = $request->city;
        $customers->adress_delivery = $request->adress_delivery;
        $customers->delivery_type = $request->delivery_type;
        $customers->payment_type = $request->payment_type;
        $customers->status = '0';
        $customers->fill($request->validated());
        $customers->save();

        $products = json_decode($request->product);
        foreach($products as $product){
            $productsOrder = new ProductsOrder();
            $productsOrder->customer_id = $customers->id;
            $productsOrder->product_id = $product[0];
            $productsOrder->quantity = $product[1];
            $productsOrder->top_price = $product[3] * $product[1];
            $productsOrder->size = $product[2];
            $productsOrder->price = $product[3];
            $productsOrder->fill($request->validated());
            $productsOrder->save();
        }



        $user = 'info@utge.net';
        Mail::to($user)->send(new ProductOrderShipped($customers, $productsOrder, $product_all));

        return redirect()->route('indexDone', 'true');
    }

    public function viewMailService(ServicesOrder $servicesOrder)
    {
        return view('site.email.serviceOrder', [
            'servicesOrder' => $servicesOrder,
        ]);
    }

    public function viewMailProduct($id)
    {
        $customer = Customers::find($id);
        $productsOrder = ProductsOrder::getProduct($id);
        $product_all = Product::find($productsOrder->product_id);


        return view('site.email.productOrder', [
            'customers' => $customer,
            'productsOrder'=> $productsOrder,
            'product_all'=> $product_all,
        ]);
    }

}
