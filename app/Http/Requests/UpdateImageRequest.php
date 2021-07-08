<?php

namespace App\Http\Requests;

use App\Image;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateImageRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('image_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'title'            => [
                'min:1',
                'max:250',
                'required',
            ],
            'category_id'      => [
                'required',
                'integer',
            ],
            'views'            => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'comments'         => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'favorites'        => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'active'           => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
