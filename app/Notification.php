<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';

    public $table = 'notifications';

    protected $dates = [
        'creation_date',
        'last_update',
        'deleted_at',
    ];

    const ALERT_TYPE_RADIO = [
        'فيديوهات' => 'فيديوهات',
        'صوتيات'   => 'صوتيات',
        'صور'      => 'صور',
    ];

    protected $fillable = [
        'link',
        'alert_text',
        'alert_type',
        'creation_date',
        'last_update',
        'deleted_at',
        'media_number',
        'message_details',
        'attachments_message',
    ];
}
