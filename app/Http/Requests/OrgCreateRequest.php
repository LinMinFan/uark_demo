<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrgCreateRequest extends FormRequest
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
            'title' => 'required',
            'org_no'  =>  'required|unique:orgs,org_no',
        ];
    }

    public function attributes()
    {
        return  [
            'title'   =>  '單位名稱',
            'org_no'    =>  '單位編號',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '請輸入單位名稱',
            'org_no.required' => '請輸入單位編號',
            'org_no.unique' => '單位編號已存在',
        ];
    }
}
