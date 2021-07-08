<?php

namespace App\Http\Requests;

use App\Admin;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreAdminRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('admin_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name'       => [
                'min:1',
                'max:250',
                'required',
            ],
            'username'   => [
                'min:1',
                'max:250',
                'required',
            ],
            'password'   => [
                'required',
            ],
            'permission' => [
                'min:1',
                'max:500',
            ],
            'email'      => [
                'min:1',
                'max:250',
                'required',
            ],
            'last_login' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
