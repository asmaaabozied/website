<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayListVideo extends Model
{

    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';

    protected $fillable = [
        'paly_list_id',
        'video_id',
    ];
    public function video(){
        return $this->hasOne(Video::class , 'id');
    }
}
