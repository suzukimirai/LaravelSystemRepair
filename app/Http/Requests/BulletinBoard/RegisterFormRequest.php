<?php

namespace App\Http\Requests\BulletinBoard;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

     public function getValidatorInstance()
     {

     $datetime_year = $this->input('old_year', array());
     $datetime_month = $this->input('old_month', array());
     $datetime_day = $this->input('old_day', array());



     $datetime_validation = $datetime_year.'-'.$datetime_month.'-'.$datetime_day;

     $this->merge([
        'datetime_validation' => $datetime_validation,
     ]);

     return parent::getValidatorInstance();

    }


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
            'over_name' => 'required | string | max:10 ',
            'under_name' => 'required | string | max:10 ',
            'over_name_kana' => 'required | string | max:30 | katakana ',
            'under_name_kana' => 'required | string | max:30 | katakana ',
            'mail_address' => 'required | max:100 | email | unique:users',
            'sex' => 'required | in:1,2,3',
            'datetime_validation' => 'required | after_or_equal:2000-01-01 | before:today',
            'role' => 'required | in:1,2,3,4',
            'password' => 'required | between:8,30 ',
            'password_confirmation' => 'required | same:password',
        ];
    }

    public function messages(){
        return [
            'over_name.max' => '姓は10文字以下で入力してください。',
            'under_name.max' => '名は10文字以下で入力してください。',
            'over_name_kana.max' => '姓をカナで10文字以下で入力してください。',
            'under_name_kana.max' => '名をカナで10文字以下で入力してください。',
            'over_name_kana.katakana' => 'カタカナで入力してください。',
            'under_name_kana.katakana' => 'カタカナで入力してください。',
            'password.between' => 'パスワードを8～30文字で入力してください',
            'password_confirmation.same' => 'パスワードが一致していません',
            'datetime_validation.after_or_equal' => '無効の日付です',
            'mail_address.email' => '無効のメールアドレスです',
            'mail_address.unique' => 'そのメールアドレスは使われています',
            'sex.in' => '無効な性別です。',
            'role.in' => '無効な役職です。',
            'sex.required' => '未入力です。',
            'role.required' => '未入力です。',
            'over_name.required' => '未入力です。',
            'under_name.required' => '未入力です。',
            'over_name_kana.required' => '未入力です。',
            'under_name_kana.required' => '未入力です。',
            'mail_address.required' => '未入力です。',
            'datetime_validation.required' => '未入力です。',
            'password.required' => '未入力です。',
            'password_confirmation.required' => '未入力です。',
            'over_name.string' => '無効な文字列です。',
            'under_name.string' => '無効な文字列です。',
            'over_name_kana.string' => '無効な文字列です。',
            'under_name_kana.string' => '無効な文字列です。',

        ];
    }
}
