<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
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
            'name' => 'required|unique:cities,name' . $this->id,
            'country' => 'required',
            'description' => 'required'
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'Name is required field',
            'country.required' => 'Country is required field',
            'description.required' => 'Description is required field'
        ];
    }
}
