<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name'=>'required|between:1,30',
            'password'=>'required|confirmed|min:6',
            'email'=>'required|unique:users',
            'phone'=>'required|unique:users',
            'avatar'=>'image'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'用户名不能为空',
            'name.between'=>'用户名必须在1-30个字符之间',
            'password.required'=>'密码不能为空',
            'password.confirmed'=>'两次密码不一致',
            'password.min'=>'密码最少6个字符',
            'email.required'=>'邮箱不能为空',
            'email.unique'=>'该邮箱已注册',
            'phone.required'=>'手机不能为空',
            'phone.unique'=>'该手机已注册',
            'avatar'=>'请传人图片文件'
        ];
    }
}
