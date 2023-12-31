<?php

namespace App\Http\Requests\Admin\Ship;

use Illuminate\Foundation\Http\FormRequest;

class StateUpdateRequest extends FormRequest
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

    public function rules()
    {
        return [
            'division_id' => 'required|integer|exists:ship_divisions,id',
            'district_id' => 'required|integer|exists:ship_districts,id',
            'state_name' => 'required|string',
        ];
    }
    public function messages()
    {
        return [
            'division_id.required' => 'The division field is required.',
            'division_id.integer' => 'The division field must be an integer.',
            'division_id.exists' => 'The selected division is invalid.',
            'district_id.required' => 'The district field is required.',
            'district_id.integer' => 'The district field must be an integer.',
            'district_id.exists' => 'The selected district is invalid.',
            'state_name.required' => 'The state name field is required.',
            'state_name.string' => 'The state name field must be a string.',
        ];
    }
}
