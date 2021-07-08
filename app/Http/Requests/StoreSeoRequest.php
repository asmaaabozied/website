<?php

namespace App\Http\Requests;

use App\Seo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreSeoRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('seo_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'seo_title'    => [
                'min:1',
                'max:250',
                'required',
            ],
            'seo_keywords' => [
                'min:1',
                'max:2000',
            ],
        ];
    }
}
