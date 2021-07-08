<?php

namespace App\Http\Requests;

use App\Radio;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRadioRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('radio_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:radios,id',
        ];

    }
}
