<?php

namespace App\Http\Requests;

use App\AdvertisingSpace;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateAdvertisingSpaceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('advertising_space_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'title'    => [
                'min:1',
                'max:250',
                'required',
            ],
            'ads_type' => [
                'required',
            ],
        ];
    }
}
