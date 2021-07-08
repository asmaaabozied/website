<?php

namespace App\Http\Requests;

use App\AdvertisingSpace;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAdvertisingSpaceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('advertising_space_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:advertising_spaces,id',
        ];
    }
}
