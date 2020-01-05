<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'wallet_id' => 'required',
            'type' => 'required',
            'transfer_movement_id' => 'required_if:transfer,1',
            'type_payment' => 'in:c,bt,mb,null',
            'mb_entity_code' => 'required_if:type_payment,mb|numeric',
            'date' => 'required | date | before:tomorrow',
            'start_balance' => 'required',
            'end_balance' => 'required',
            'value' => 'required'
        ];
    }
}
