<?php

namespace App\Http\Requests;

use App\Setting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateSettingRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'keyEn' => [
                'min:1',
                'max:250',
                'required',
            ],
            'value'  => [
                'required',
            ],
            'keyAr' => [
                'min:1',
                'max:250',
                'required',
            ],
        ];
    }
}
