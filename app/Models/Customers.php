<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Customers extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['firstname', 'lastname', 'phone', 'city', 'adress_delivery', 'delivery_type', 'payment_type', 'status'];

    public function productOrders()
    {
        return $this->hasMany(ProductsOrder::class);
    }
    public static function orderByAsc()
    {
        return DB::table('customers')->select('*')->orderBy('status', 'asc' ,'deleted_at', 'NULL')->get();

    }
}
