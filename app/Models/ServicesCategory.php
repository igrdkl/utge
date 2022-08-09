<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class ServicesCategory extends Model
{
    use HasFactory;
    use SoftDeletes, CascadeSoftDeletes;

    protected $cascadeDeletes = ['services'];
    protected $dates = ['deleted_at'];
    protected $fillable = ['service_type_id'];

    public function services_types()
    {
        return $this->belongsTo(ServicesType::class, 'service_type_id');
    }
    public function services()
    {
        return $this->hasMany(Services::class, 'service_category_id');
    }
    public function localization()
    {
        return $this->morphMany(Localization::class, 'localizationable');
    }
}
