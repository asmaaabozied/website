<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubDomian extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';

    public $table = 'sub_domians';

    protected $hidden = [
        'password',
    ];

    protected $dates = [
        'creation_date',
        'last_update',
        'deleted_at',
    ];

    protected $fillable = [
        'url',
        'titleEn',
        'titleAr',
        'username',
        'password',
        'creation_date',
        'last_update',
        'deleted_at',
    ];

    public function images()
    {
        return $this->hasMany(Image::class, 'sub_domain_no', 'id');
    }

    public function sounds()
    {
        return $this->hasMany(Sound::class, 'sub_domain_no', 'id');
    }

    public function videos()
    {
        return $this->hasMany(Video::class, 'sub_domain_no', 'id');
    }
}
