<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class ServicesSizePrice extends Model
{
    use HasFactory;
    use SoftDeletes, CascadeSoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['service_id', 'materials', 'price', 'units'];

    public function services()
    {
        return $this->belongsTo(Services::class, 'service_id');
    }
    static function getServicesSizePrice()
    {
        DB::table('services')
            ->leftJoin('services_size_prices', 'services.id', '=', 'services_size_prices.service_id')
            ->select('services_size_prices.materials', 'services_size_prices.price')
            ->where('services.id')
            ->get();
    }
}
