<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdvertisementRequest extends FormRequest
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
            'sub_category_id' => 'required|exists:sub_categories,id',
            'city_id' => 'required|exists:cities,id',
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'condition' => 'required',
            'is_price_negotiable' => 'required',
            'is_offers_accepted' => 'required',
            'min_offer' => 'nullable|numeric'
        ];
    }
}

