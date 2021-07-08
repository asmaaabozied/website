<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Category extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';

    public $table = 'categories';


    protected $dates = [
        'creation_date',
        'last_update',
        'deleted_at',
    ];

    protected $fillable = [
        'descp',
        'active',
        'creation_date',
        'last_update',
        'deleted_at',
        'view',
        'category_name',
        'is_last_level',
        'category_level',
        'parent_category',
        'category_type',
        'icon_img'
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'category_id', 'id');
    }

    public function sounds()
    {
        return $this->hasMany(Sound::class, 'category_id', 'id');
    }

    public function videos()
    {
        return $this->hasMany(Video::class, 'category_id', 'id');
    }



    public function categories_type()
    {
        return $this->belongsTo(CategoryType::class, 'category_type');
    }
    public function categories_parent()
    {
        return $this->belongsTo(Category::class, 'parent_category');
    }

    public function sub_categories()
    {
        return $this->hasMany('App\Category', 'parent_category', 'id');
    }
}
