<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Model
{
    use SoftDeletes;

    public $table = 'admins';

    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';

    protected $hidden = [
        'password',
    ];

    protected $dates = [
        'last_login',
        'creation_date',
        'last_update',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'email',
        'active',
        'username',
        'password',
        'permission',
        'last_login',
        'creation_date',
        'last_update',
        'deleted_at',
    ];

    public function getLastLoginAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setLastLoginAttribute($value)
    {
        $this->attributes['last_login'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
