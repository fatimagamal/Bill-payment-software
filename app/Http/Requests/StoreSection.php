<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSection extends FormRequest
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
     * @return array<string, mixed>
     */


    public function messages()
    {
        return [
            
            'section_name.required'=>'ادخل اسم القسم',
            'section_name.unique'=>' اسم القسم موجود مسبقا',
            'notes.required'=>'ادخل الملاحظات الخاصه بالقسم',
        ];
    }

    public function rules()
    {
        return [
            
                'section_name'=>'required|unique:sections|max:300',
                'notes'=>'required',
        
        ];
    }
}
