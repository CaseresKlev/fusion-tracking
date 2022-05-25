<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseFormRequest extends FormRequest
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
            'trip_id' => '',
            'company_id' => 'required',
            'truck_id' => 'required',
            'driver_id' => '',
            'ref_no' => '',
            'stock_source' => '',
            'item' => 'required',
            'destination' => '',
            'quantity' => 'required',
            'accumulated_total' => 'required',
            'entry_by' => '',
            'date' => ''

        ];
    }

    protected function prepareForValidation()
    {
        //Validation: use '' for field not match property of an object
        $this->merge([
            'trip_id' => strip_tags($this->trip_id),
            'company_id' => strip_tags($this->company_id),
            'truck_id' => strip_tags($this->truck_id),
            'driver_id' => strip_tags($this->driver_id),
            'ref_no' => strip_tags($this->ref_no),
            'stock_source' => strip_tags($this->stock_source),
            'item' => strip_tags($this->item),
            'destination' => strip_tags($this->destination),
            'quantity' => strip_tags($this->quantity),
            'accumulated_total' => strip_tags($this->accumulated_total),
            'entry_by' => strip_tags($this->entry_by),
            'date' => strip_tags($this->date)
        ]);
    }
}
