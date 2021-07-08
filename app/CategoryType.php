<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryType extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';

    public $table = 'categories_types';

    protected $dates = [
        'creation_date',
        'last_update',
        'deleted_at',
    ];

    protected $fillable = [
        'type',
        'creation_date',
        'last_update',
        'deleted_at',
    ];

    public function categories()
    {
        return $this->hasMany(Category::class, 'category_type', 'id');
    }
}
