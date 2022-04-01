<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TruckFormRequest extends FormRequest
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
            'brand' => '',
            'model' => '',
            'plate_no' => 'required',
            'company_id' => 'required',
            'owner' => '',
            'status' => '',
            'description' => ''
        ];
    }

    protected function prepareForValidation()
    {
        //Validation: use '' for field not match property of an object
        $this->merge([
            'name' => strip_tags(strtoupper($this->name)),
            'brand' => strip_tags(strtoupper($this->brand)),
            'model' => strip_tags(strtoupper($this->model)),
            'plate_no' => strip_tags(strtoupper($this->plate_no)),
            'company_id' => strip_tags(strtoupper($this->company_id)),
            'owner' => strip_tags(strtoupper($this->owner)),
            'status' => strip_tags($this->status),
            'description' => strip_tags($this->description)
        ]);
    }
}
