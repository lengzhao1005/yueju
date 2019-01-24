<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
            'name'=>'required|unique:permissions',
            'url'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'权限名不能为空',
            'name.unique'=>'权限名已存在',
            'url.required'=>'权限对应的地址不能为空',
        ];
    }
}
