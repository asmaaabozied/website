<?php

namespace App\Http\Requests;

use App\Sound;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreSoundRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('sound_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'title'       => [
                'min:1',
                'max:250',
                'required',
            ],
            'category_id' => [
                'required',
                'integer',
            ],
            'icon_image'  => [
                'required',
            ],
            'duration'    => [
                'min:1',
                'max:250',
            ],
            'views'       => [
                'min:1',
                'max:250',
            ],
            'comments'    => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'likes'       => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'favorites'   => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'dlike'       => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
