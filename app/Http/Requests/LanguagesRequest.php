<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguagesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;  // guard admin
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:100',
            'abbr' => 'required|string|max:10',
            //'active' => 'required|in:0,1',
            'direction' => 'required|in:rtl,ltr',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'in' => 'القيم المدخلة غير صحيحة',
            'name.string' => 'هذا الحقل لابد ان يكون احرف',
            'abbr.max' => 'هذا الحقل لابد الا يزيد عن 10 احرف',
            'abbr.string' => 'هذا الحقل لابد ان يكون احرف',
            'name.max' => 'هذا الحقل لابد الا يزيد عن 100 احرف',

        ];
    }
}
