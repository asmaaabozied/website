<?php

namespace App\Http\Requests;

use App\Adminmenu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAdminmenuRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('adminmenu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:adminmenus,id',
        ];
    }
}
