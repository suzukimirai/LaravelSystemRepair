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
            'sex' => 'required',
            'datetime_validation' => 'required | after_or_equal:2000-01-01 | before:today',
            'role' => 'required',
            'password' => 'required | between:8,30 ',
            'password_confirmation' => 'same:password',
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
            'datetime_validation.after_or_equal' => '無効の日付です',
            'mail_address.email' => '無効のメールアドレスです',
            'mail_address.unique' => 'そのメールアドレスは使われています',
            'password_confirmation.same' => 'パスワードが一致していません',



        ];
    }
}
