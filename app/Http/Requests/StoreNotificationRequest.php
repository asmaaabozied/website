<?php

namespace App\Http\Requests;

use App\Notification;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreNotificationRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('notification_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'alert_text'          => [
                'min:1',
                'max:250',
                'required',
            ],
            'alert_type'          => [
                'required',
            ],
            'media_number'        => [
                'min:1',
                'max:250',
            ],
            'message_details'     => [
                'min:1',
                'max:300',
                'required',
            ],
            'attachments_message' => [
                'min:1',
                'max:250',
            ],
            'link'                => [
                'min:1',
                'max:250',
            ],
        ];
    }
}
