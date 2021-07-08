<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Image extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';

    public $table = 'images';



    protected $dates = [
        'creation_date',
        'last_update',
        'deleted_at',
    ];

    protected $fillable = [
        'img_thm',
        'file_name',
        'title',
        'descp',
        'views',
        'likes',
        'dlike',
        'active',
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
        return $this->hasMany(Comment::class, 'image_id', 'id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'image_id', 'id');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'image_id', 'id');
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
