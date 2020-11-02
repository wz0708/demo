<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminLoginRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * 管理员登录必要字段名
     *
     * @return array
     */
    public function rules() {
        return [
            'name' => 'required',
            'password' => ['required']//密码必须，最小长度为6
        ];
    }

}
