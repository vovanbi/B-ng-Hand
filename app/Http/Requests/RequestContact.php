<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestContact extends FormRequest
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

    public function rules()
    {
        return [
            'c_phone'=>'required | size:10',
        ];
    }
    public function messages()
    {
        return [
            'c_phone.size'=>'Số điện thoại phải đủ :size số!',
        ];
    }
}
