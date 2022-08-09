<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Support\Facades\DB;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes, CascadeSoftDeletes;
    use InteractsWithMedia;


    protected $cascadeDeletes = ['sizePrices'];
    protected $dates = ['deleted_at'];
    protected $fillable = ['sub_category_id', 'available', 'list_position', 'home_view', 'mass_id'];

    public function sub_categories()
    {
        return $this->belongsTo(SubCategory::class);
    }
    public function localization()
    {
        return $this->morphMany(Localization::class, 'localizationable');
    }
    public function sizePrices()
    {
        return $this->hasMany(SizePrice::class);
    }

    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        return $filter->apply($builder);
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
