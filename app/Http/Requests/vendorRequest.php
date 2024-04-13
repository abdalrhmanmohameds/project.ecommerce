<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class vendorRequest extends FormRequest
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
            'logo' => 'required_without:id|mimes:jpg,jpeg,png',
            'name' => 'required|string|max:100',
            'mobile' => 'required|unique:vendors,mobile|max:100',
            'email' => 'required|unique:vendors,email|email',
            'category_id' => 'required|exists:main_categories,id',
            'address' => 'required|string|max:500',
            'password' => 'required|string|min:6'
        ];
    }


    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'max' => 'هذا الحقل طويل',
            'category_id.exists' => 'القسم غير موجود',
            'email.email' => 'صيغة البريد الالكتروني غير صحيحة',
            'address.string' => 'العنوان لابد ان يكون حروف او حروف وارقام',
            'name.string' => 'الاسم لابد ان يكون حروف او حروف وارقام',
            'logo.required_without' => 'الصورة مطلوبة',
            'email.unique' => 'البريد الالكتروني مستخدم من قبل',
            'mobile.unique' => 'رقم الهاتف مستخدم من قبل'


        ];
    }
}