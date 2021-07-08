<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayList extends Model
{

    protected $fillable = [
        'title',
        'user_id',
    ];

    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';

    public function playListVideos(){
        return $this->hasMany(PlayListVideo::class , 'paly_list_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
