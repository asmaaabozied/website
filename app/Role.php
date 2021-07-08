<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';

    public $table = 'roles';

    protected $dates = [
        'creation_date',
        'last_update',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'creation_date',
        'last_update',
        'deleted_at',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
