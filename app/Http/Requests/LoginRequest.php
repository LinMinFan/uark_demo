<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as Request;

class LoginRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'account' => 'required',
            'password'  =>  'required',
        ];
    }

    public function attributes()
    {
        return  [
            'account'   =>  '帳號',
            'password'    =>  '密碼',
        ];
    }

    public function messages()
    {
        return [
            'account.required' => '請輸入帳號',
            'password.required' => '請輸入密碼',
        ];
    }

}
