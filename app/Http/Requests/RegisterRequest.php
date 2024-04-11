<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'account'  =>  'required|unique:users,account',
            'name'  =>  'required',
            'password'  =>  'required',
            'email'  =>  'required|email',
            'org_no' => 'required',
            'apply_file' => 'required|mimes:jpg,jpeg,png,pdf',
        ];
    }

    public function attributes()
    {
        return  [
            'account'    =>  '帳號',
            'name'    =>  '姓名',
            'password'    =>  '密碼',
            'email'    =>  'Email',
            'org_no'   =>  '單位號碼',
            'apply_file'   =>  '上傳檔案',
        ];
    }

    public function messages()
    {
        return [
            'account.required' => '請輸入帳號',
            'account.unique' => '帳號已存在',
            'name.required' => '請輸入姓名',
            'password.required' => '請輸入密碼',
            'email.required' => '請輸入Email',
            'email.email' => 'Email格式錯誤',
            'org_no.required' => '請輸入單位號碼',
            'apply_file.required' => '請選擇上傳檔案',
            'apply_file.mimes' => '上傳檔案格式錯誤',
        ];
    }
}
