<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
class RequestUser extends FormRequest
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
            'email'=>'required | email:rfc,dns|unique:users,email,'.$this->id,
            'phone'=>'required | size:10',
            'password'=>'required | min:8',
            'name'=>'required',
            'address'=>'required',
            'password_confirmation'=>'required | required_with:password |same:password',
           
        ];
    }
    public function messages()
    {
        return [
            'email.email'=>'Lỗi cú pháp của email!',
            'email.unique'=>'Email đã tồn tại!',
            'phone.size'=>'Số điện thoại phải đủ :size số!',
            'password.min' =>'Độ dài tối thiểu :min!',
            'password_confirmation.same' =>'Mật khẩu và xác nhận mật khẩu phải khớp!',

        ];
     }

}
