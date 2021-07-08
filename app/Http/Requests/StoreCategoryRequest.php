<?php

namespace App\Http\Requests;

use App\Category;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreCategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'category_name'    => [
                'min:1',
                'max:250',
                'required',
            ],
            'category_type' => [
                'required',
                'integer',
            ],
            'category_level'   => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
