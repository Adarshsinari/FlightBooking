<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class FlightDetailRequest extends FormRequest
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
            // persondetails
            'salutation' => 'required',
            'first_name' => 'required',
            'date_of_birth' => 'required|
                date_format:Y-m-d|
                before:' . Carbon::now()->subYears(18)->format('Y-m-d'),
            'email' => 'required|email',
            'phone_number' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required',
            'country' => 'required',
            // flightdetails
            'departure_date' => 'required|date_format:Y-m-d',
            'return_date' => 'required|date_format:Y-m-d',
            'departure_city' => 'required',
            'departure_country' => 'required',
            'destination_city' => 'required',
            'destination_country' => 'required|different:departure_country',
            'booking_class' => 'required',
            'ticket_type' => 'required',
            'id_proof' => 'required|mimes:csv,docx|max:990',
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
            'salutation.required'  => 'Salution is required.',
            'first_name.required' => 'First name required',
            'date_of_birth.required' => 'Date of Birth is required',
            'date_of_birth.before' => 'The age should be above 18 years.',
            'phone_number.required' => 'Number is required.',
            'address.required' => 'Please enter Address',
            'country.required'  => 'Select Nationality',
            'city.required' => 'City is required',
            'state.required' => 'State is required',
            'zip_code.required' => 'Zip code is required',
            'email.required' => 'Email is required',
            'departure_date.required' => 'Departure date is required',
            'return_date.required' => 'Return date is required',
            'departure_city.required' => 'Departure city is required',
            'departure_country.required' => 'Departure country is required',
            'destination_city.required' => 'Destination city is required',
            'destination_country.required' => 'Destination country is required',
            'destination_country.same' => 'Departure Country and Destination Country cannot be same.',
            'booking_class.required' => 'Class is required.',
            'ticket_type.required' => 'Ticket type is required',
            'id_proof.required' => 'Identity Prof  is required',

        ];
    }

    /**
     * Throw custom exception.
     * @param $validator
     * @return Illuminate\Http\Exceptions\HttpResponseException;
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
