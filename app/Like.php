<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{

    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';

    public $table = 'likes';

    protected $dates = [
        'creation_date',
        'last_update',
        'deleted_at',
    ];

    const LIKE_TYPE_RADIO = [
        '1' => 'like',
        '2' => 'dis like',
    ];

    protected $fillable = [
        'user_id',
        'image_id',
        'sound_id',
        'video_id',
        'like_type',
        'comment_id',
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

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
