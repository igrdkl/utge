<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;;

class Services extends Model
{
    use HasFactory;
    use SoftDeletes, CascadeSoftDeletes;


    protected $cascadeDeletes = ['servicesSizePrice'];
    protected $dates = ['deleted_at'];
    protected $fillable = ['service_category_id'];

    public function categories()
    {
        return $this->belongsTo(ServicesCategory::class);
    }
    public function localization()
    {
        return $this->morphMany(Localization::class, 'localizationable');
    }
    public function servicesSizePrice()
    {
        return $this->hasMany(ServicesSizePrice::class, 'service_id');
    }

}
