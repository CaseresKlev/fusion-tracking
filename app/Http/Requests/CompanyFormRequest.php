<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyFormRequest extends FormRequest
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
            'name' => 'required',
             'address'=> '',
             'contact_no' => 'Integer',
             'email' => 'email',
             'description' => '',
        ];
    }

    protected function prepareForValidation()
    {
        //Validation: use '' for field not match property of an object
        $this->merge([
            'name' => strip_tags($this->name),
            'address' => strip_tags($this->address),
            'contact_no' => strip_tags($this['contact_no']),
            'email' => strip_tags($this->email),
            'description' => strip_tags($this->description),
        ]);
    }
}
