<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favorite extends Model
{

    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';

    public $table = 'favorites';

    protected $dates = [
        'creation_date',
        'last_update',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'image_id',
        'sound_id',
        'video_id',
        'creation_date',
        'last_update',
        'deleted_at',
    ];

    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id');
    }

    public function sound()
    {
        return $this->belongsTo(Sound::class, 'sound_id');
    }

    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
