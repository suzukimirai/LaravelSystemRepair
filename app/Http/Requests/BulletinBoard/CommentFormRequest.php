<?php

namespace App\Http\Requests\BulletinBoard;

use Illuminate\Foundation\Http\FormRequest;

class CommentFormRequest extends FormRequest
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
            'comment' => 'string| max:2500 | required ',
        ];
    }

    public function messages(){
        return [
            'comment.max' => 'コメントは2500文字以内で入力してください。',
            'comment.string' => '文字列で入力してください。',
            'comment.required' => '必須項目です。',
        ];
    }
}
