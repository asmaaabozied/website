<?php

namespace App\Http\Requests;

use App\Adminmenu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateAdminmenuRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('adminmenu_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'menuTitleEn' => [
                'min:1',
                'max:250',
            ],
            'menuTitleAr' => [
                'min:1',
                'max:250',
                'required',
            ],
            'menuLink'     => [
                'min:1',
                'max:250',
                'required',
            ],
            'menuIco'      => [
                'min:1',
                'max:250',
            ],
            'parentMenuID'   => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'ordering'      => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'member'        => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
