<?php

namespace App\Http\Requests;

use App\ContactUsMessage;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreContactUsMessageRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('contact_us_message_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'title'   => [
                'min:1',
                'max:250',
                'required',
            ],
            'content' => [
                'required',
            ],
            'from_u'  => [
                'min:1',
                'max:250',
                'required',
            ],
            'phone'   => [
                'min:1',
                'max:250',
            ],
            'email'   => [
                'min:1',
                'max:250',
            ],
            'readed'  => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
