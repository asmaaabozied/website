<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize()
    {

        return true;
    }

    public function rules()
    {
        return [
            'from_u' => 'required|string',
            'email' => 'required|email|string',
            'phone' => 'required|min:10',
            'content' => 'required',

        ];
    }
}
