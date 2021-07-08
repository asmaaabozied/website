<?php

namespace App\Http\Requests;

use App\CategoryType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreCategoryTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('category_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'type' => [
                'min:1',
                'max:250',
                'required',
            ],
        ];
    }
}
