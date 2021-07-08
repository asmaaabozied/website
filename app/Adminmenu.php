<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Adminmenu extends Model
{
    use SoftDeletes;

    public $table = 'adminmenu';

    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';

    protected $dates = [
        'creation_date',
        'last_update',
        'deleted_at',
    ];

    protected $fillable = [
        'member',
        'visable',
        'menuIco',
        'ordering',
        'menuLink',
        'creation_date',
        'last_update',
        'deleted_at',
        'parentMenuID',
        'menuTitleEn',
        'menuTitleAr',
    ];

    public function menue_parent()
    {
        return $this->belongsTo(Adminmenu::class, 'parentMenuID');
    }
}
