<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TripFormRequest extends FormRequest
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
            'trip_ticket_id' =>'',
            'driver_id' => 'required',
            'truck_id'  => 'required',
            'source'  => 'required',
            'destination'  => 'required',
            'distance'  => 'required',
            'weigth'  => 'required',
            'rate'  => 'required',
            'bill'  => '',
            'date' => ['date', 'required'],
            'material' => '',
            'contractor' => '',
            'loaded_by' => '',
            'loaded_time' => '',
            'tx_no' => '',
            'entry_by' => ''

        ];
    }

    protected function prepareForValidation()
    {
        //Validation: use '' for field not match property of an object
        $this->merge([
            'trip_ticket_id' => strip_tags($this->trip_ticket_id),
            'driver_id' => strip_tags($this->driver_id),
            'truck_id' => strip_tags($this->truck_id),
            'source' => strip_tags($this->source),
            'destination' => strip_tags($this->destination),
            'distance' => strip_tags($this->distance),
            'weigth'  => strip_tags($this->weigth),
            'rate' => strip_tags($this->rate),
            //'bill' => strip_tags($this->bill),
            'date' => strip_tags($this->date),
            'material' => strip_tags($this->material),
            'contractor' => strip_tags($this->contractor),
            'loaded_by' => strip_tags($this->loaded_by),
            'loaded_time' => strip_tags($this->loaded_time),
            'tx_no' => strip_tags($this->tx_no),
            'entry_by' => strip_tags($this->entry_by),
        ]);
    }
}
