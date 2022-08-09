<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Support\Facades\DB;

class ServicesType extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes, CascadeSoftDeletes;
    use InteractsWithMedia;

    protected $cascadeDeletes = ['categories'];
    protected $dates = ['deleted_at'];

    public function localization()
    {
        return $this->morphMany(Localization::class, 'localizationable');
    }

    public function categories()
    {
        return $this->hasMany(ServicesCategory::class, 'service_type_id');
    }

    static function getAllChild()
    {
        DB::table('services_types')
            ->leftJoin('services_categories', 'services_types.id', '=', 'services_categories.service_type_id')
            ->leftJoin('services', 'services_categories.id', '=', 'services.service_category_id')
            ->where('services_types.id')
            ->get();
    }
}
