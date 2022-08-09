<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes, CascadeSoftDeletes;

    protected $cascadeDeletes = ['subcategories'];
    protected $dates = ['deleted_at'];
    protected $fillable = ['product_type_id'];

    public function services()
    {
        return $this->hasMany(Services::class);
    }
    public function product_types()
    {
        return $this->belongsTo(ProductType::class);
    }
    public function subcategories()
    {
        return $this->hasMany(SubCategory::class);
    }
    public function localization()
    {
        return $this->morphMany(Localization::class, 'localizationable');
    }

    static function getProduct($id)
    {
        return DB::table('categories')
        ->select('products.id')
        ->leftJoin('sub_categories','category_id', '=', 'categories.id')
        ->leftJoin('products','sub_category_id', '=', 'sub_categories.id')
        ->where('categories.id', $id)
        ->get();
    }
}
