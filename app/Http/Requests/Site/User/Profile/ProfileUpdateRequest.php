<?php

namespace App\Http\Requests\Site\User\Profile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
            'username' => 'required|string',
            'email' => 'required|unique:users,email,' . Auth::id(),
            'phone' => 'required|unique:users,phone,' . Auth::id(),
            'address' => 'required|string',
            'photo' => 'mimes:jpeg,png|max:2048'
        ];
    }
}
