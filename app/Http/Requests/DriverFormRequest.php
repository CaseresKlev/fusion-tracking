<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DriverFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //This needs to be change later when we implement user signin
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
            'middlename' => '',
            'lastname'=> 'required',
            'address' => '',
            'contact_no' => '',
            'position' => 'required',
            'trip_status' => '',
        ];
    }

    protected function prepareForValidation()
    {
        //Validation: use '' for field not match property of an object
        $this->merge([
            'firstname' => strip_tags($this->firstname),
            'middlename' => strip_tags($this->middlename),
            'lastname' => strip_tags($this->lastname),
            'address' => strip_tags($this->address),
            'contact_no' => strip_tags($this->contact_no),
            'position' => strip_tags($this->position),
            'trip_status'  => strip_tags($this->trip_status),
        ]);
    }
}
