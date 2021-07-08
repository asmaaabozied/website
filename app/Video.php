<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Video extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';

    public $table = 'videos';


    protected $dates = [
        'creation_date',
        'last_update',
        'deleted_at',
    ];

    protected $fillable = [
        'file_name',
        'icon_image',
        'title',
        'descp',
        'views',
        'likes',
        'dlike',
        'active',
        'duration',
        'comments',
        'favorites',
        'creation_date',
        'last_update',
        'deleted_at',
        'category_id',
        'sub_domain_no',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'video_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
        return $this->hasMany(Like::class, 'video_id', 'id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'video_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function sub_domain_no()
    {
        return $this->belongsTo(SubDomian::class, 'sub_domain_no');
    }


}
