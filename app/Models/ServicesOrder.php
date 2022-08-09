<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class ServicesOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['firstname', 'lastname', 'phone', 'email', 'interes', 'status'];


    public static function orderByServices()
    {
        return DB::table('services_orders')->select('*')->orderBy('status', 'asc' ,'deleted_at', 'NULL')->get();

    }
}

