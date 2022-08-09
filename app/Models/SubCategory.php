<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Support\Facades\DB;

class SubCategory extends Model
{
    use HasFactory;
    use SoftDeletes, CascadeSoftDeletes;

    protected $cascadeDeletes = ['products'];
    protected $dates = ['deleted_at'];
    protected $fillable = ['category_id'];

    public function localization()
    {
        return $this->morphMany(Localization::class, 'localizationable');
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function categories()
    {
        return $this->belongsTo(Category::class);
    }
}
