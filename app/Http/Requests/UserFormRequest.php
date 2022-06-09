<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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

            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
            'password' => 'required',
            'type' => ['required', 'string'],
            'status' => ['required', 'string'],
            'new_password' => ['required', 'string'],
            
        ];
    }

    protected function prepareForValidation()
    {
        //Validation: use '' for field not match property of an object
        $this->merge([
            'name' => strip_tags($this->name),
            'email' => strip_tags($this->email),
            'password' => strip_tags($this->password),
            'type' => strip_tags($this->type),
            'status' => strip_tags($this->status),
            'new_password' => strip_tags($this->new_password),
        ]);
    }
}
