<?php

namespace App\Http\Requests\Site\Vendor\Auth;

use Illuminate\Foundation\Http\FormRequest;

class BecomeVendorRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'username' => 'required|unique:vendors,username',
            'email' => 'required|email|unique:vendors,email',
            'phone' => 'required|unique:vendors,phone,',
            'password' => 'required|confirmed|min:4',
        ];
    }
}
