<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsFormRequest extends FormRequest
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
            'app_name' => 'required',
            'app_section' => 'required',
            'app_field' => 'required',
            'app_value_1' => 'required',
            'app_value_2' => '',
            'app_value_3' => '',
            'app_setting_description' => 'required'
        ];
    }

    protected function prepareForValidation()
    {
        //Validation: use '' for field not match property of an object
        $this->merge([
            'app_name' => strip_tags(strtoupper($this->app_name)),
            'app_section' => strip_tags(strtoupper($this->app_section)),
            'app_field' => strip_tags(strtoupper($this->app_field)),
            'app_value_1' => strip_tags(strtoupper($this->app_value_1)),
            'app_value_2' => strip_tags(strtoupper($this->app_value_2)),
            'app_value_3' => strip_tags(strtoupper($this->app_value_3)),
            'app_setting_description' => strip_tags($this->app_setting_description),
        ]);
    }
}
