<?php

namespace App\Http\Requests;

use App\Like;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateLikeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('like_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
        ];
    }
}
