<?php

namespace App\Http\Requests;

use App\Like;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreLikeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('like_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
        ];
    }
}
