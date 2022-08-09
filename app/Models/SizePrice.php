<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class SizePrice extends Model
{
    use HasFactory;
    use SoftDeletes, CascadeSoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['product_id', 'size', 'price', 'available', 'price_units'];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }
    static function getSizePrice()
    {
        DB::table('products')
            ->leftJoin('size_prices', 'products.id', '=', 'size_prices.product_id')
            ->select('size_prices.size', 'size_prices.price')
            ->where('products.id')
            ->get();
    }
}
