<?php

namespace App\Http\Requests\BulletinBoard;

use Illuminate\Foundation\Http\FormRequest;

class CategoryFormRequest extends FormRequest
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
            'main_category' => 'string | max:100 | unique:main_categories,main_category',
            'sub_category' => 'string | max:100 | unique:sub_categories,sub_category',
        ];
    }

    public function messages(){
        return [
            'main_category.max' => 'メインカテゴリー名は100文字以内で入力してください。',
            'sub_category.max' => 'サブカテゴリー名は100文字以内で入力してください。',
            'main_category.unique' => 'その名前は使われています。',
            'sub_category.unique' => 'その名前は使われています。',
            'main_category.required' => '必須項目です。',
            'sub_category.required' => '必須項目です。',
        ];
    }
}