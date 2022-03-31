<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateRequest extends FormRequest
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
            // flightdetails
            'departure_date' => 'required|date_format:Y-m-d',
            'return_date' => 'required|date_format:Y-m-d',
        ];
    }

    /**
     * Custom error messages.
     * @return array
     */
    public function messages()
    {
        return [
            // Custom messages
            'departure_date.required' => 'Departure date is required',
            'return_date.required' => 'Return date is required',
        ];
    }

     /**
     * Throw custom exception.
     * @param $validator
     * @return Illuminate\Http\Exceptions\HttpResponseException;
     */
    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
