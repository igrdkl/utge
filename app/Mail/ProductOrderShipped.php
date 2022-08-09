<?php

namespace App\Mail;

use App\Models\Customers;
use App\Models\Product;
use App\Models\ProductsOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductOrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    public $customers;
    public $productsOrder;
    public $products;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Customers $customers, ProductsOrder $productsOrder, Product $product_all)
    {
        $this->customers = $customers;
        $this->productsOrder = ProductsOrder::getProduct($customers->id);
        $this->product_all = Product::all();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('site.email.productOrder', [
            'customers' => $this->customers,
            'productsOrder' => $this->productsOrder,
            'product_all' => $this->product_all,
        ]);
    }
}
