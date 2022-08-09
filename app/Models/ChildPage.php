<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\DB;

class ChildPage extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;

    protected $dates = ['deleted_at'];
    protected $fillable = ['route'];

    public function localization()
    {
        return $this->morphMany(Localization::class, 'localizationable');
    }

    public static function orderSlider()
    {
        return DB::table('child_pages')->where('route', 'slider1')->orderBy('order')->get();
    }
}
