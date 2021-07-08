<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{

    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';

    public $table = 'comments';

    protected $dates = [
        'creation_date',
        'last_update',
        'deleted_at',
    ];

    protected $fillable = [
        'dlike',
        'likes',
        'active',
        'user_id',
        'comment',
        'image_id',
        'sound_id',
        'video_id',
        'creation_date',
        'last_update',
        'deleted_at',
        'parent_comment_id',
    ];

    public function likes()
    {
        return $this->hasMany(Like::class, 'comment_id', 'id');
    }

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
    public function replies()
    {
        return $this->hasMany('App\Comment', 'parent_comment_id', 'id');
    }
}
