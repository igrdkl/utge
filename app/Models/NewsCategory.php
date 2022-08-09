<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class NewsCategory extends Model
{
    use HasFactory;
    use SoftDeletes, CascadeSoftDeletes;

    protected $cascadeDeletes = ['news'];
    protected $dates = ['deleted_at'];
    public function localization()
    {
        return $this->morphMany(Localization::class, 'localizationable');
    }

    public function news()
    {
        return $this->hasMany(News::class, 'categories_id');
    }
}
