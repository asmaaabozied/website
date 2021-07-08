<?php

namespace App\Http\Requests;

use App\Sound;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySoundRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('sound_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:sounds,id',
        ];
    }
}
