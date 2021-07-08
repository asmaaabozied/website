<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Radio extends Model
{
    use SoftDeletes;

    public $table = 'radios';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const TYPE_SELECT = [
        'video' => 'video',
        'sound' => 'sound',
    ];

    protected $fillable = [
        'type',
        'name',
        'file',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
