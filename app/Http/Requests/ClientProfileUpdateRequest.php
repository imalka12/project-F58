<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientProfileUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'firstname' => 'required',
            'lastname' => 'required',
            'address_line_1' => 'required',
            'address_line_2' => 'nullable',
            'city_id' => 'required|exists:cities,id',
            'telephone' => 'required|numeric|regex:/^0[1-9]{1}[0-9]{1}[0-9]{7}$/',
        ];
    }
}
