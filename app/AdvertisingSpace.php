<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class AdvertisingSpace extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';

    public $table = 'ads';

    protected $dates = [
        'creation_date',
        'last_update',
        'deleted_at',
    ];

    protected $fillable = [
        'code',
        'title',
        'ads_type',
        'image',
        'creation_date',
        'last_update',
        'deleted_at',
    ];

    const ADS_TYPE_RADIO = [
        'إعلان ادسنس' => 'إعلان ادسنس',
        'إعلان عادي'  => 'إعلان عادي',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }

}
