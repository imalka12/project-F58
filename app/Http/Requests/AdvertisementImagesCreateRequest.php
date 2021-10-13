<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdvertisementImagesCreateRequest extends FormRequest
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
            'image_1' => 'required|file|mimes:png,jpg',
            'image_2' => 'nullable|file|mimes:png,jpg',
            'image_3' => 'nullable|file|mimes:png,jpg',
            'image_4' => 'nullable|file|mimes:png,jpg',
        ];
    }
}
