<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seo extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';

    public $table = 'seo';

    protected $dates = [
        'creation_date',
        'last_update',
        'deleted_at',
    ];

    protected $fillable = [
        'seo_title',
        'creation_date',
        'last_update',
        'deleted_at',
        'seo_keywords',
        'seo_description',
    ];
}
