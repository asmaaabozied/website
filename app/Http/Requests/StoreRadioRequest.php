<?php

namespace App\Http\Requests;

use App\Radio;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreRadioRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('radio_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'type' => [
                'required'],
            'file' => [
                'required'],
        ];

    }
}
