<?php

namespace App\Http\Requests;

use App\SubDomian;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreSubDomianRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('sub_domian_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'titleEn' => [
                'min:1',
                'max:250',
                'required',
            ],
            'titleAr' => [
                'min:1',
                'max:250',
                'required',
            ],
            'url'      => [
                'min:1',
                'max:250',
                'required',
            ],
            'username' => [
                'min:1',
                'max:250',
                'required',
            ],
            'password' => [
                'required',
            ],
        ];
    }
}
