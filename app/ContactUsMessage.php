<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactUsMessage extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';

    public $table = 'contact_us_messages';

    protected $dates = [
        'creation_date',
        'last_update',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'phone',
        'email',
        'from_u',
        'readed',
        'content',
        'creation_date',
        'last_update',
        'deleted_at',
    ];
}
