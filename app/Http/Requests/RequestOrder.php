<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
class RequestOrder extends FormRequest
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
            'phone'=>'required|size:10',
            'address'=>'required',
           
        ];
    }
    public function messages()
    {
        return [
            'phone.size'=>'Số điện thoại phải đủ :size số!',
        ];
     }

}
