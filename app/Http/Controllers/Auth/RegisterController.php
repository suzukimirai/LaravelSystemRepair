<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Users\User;
use App\Models\Users\Subject;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\BulletinBoard\RegisterFormRequest;
use DB;


use App\Models\Users\Subjects;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function registerView()
    {
        $subjects = Subject::all();
        return view('auth.register.register', compact('subjects'));
    }

    public function registerPost(RegisterFormRequest $request)
    {
        // $validator = $request->validate([
        //     'over_name' => 'required | string | max:10 ',
        //     'under_name' => 'required | string | max:10 ',
        //     'over_name_kana' => 'required | string | max:30 ',
        //     'under_name_kana' => 'required | string | max:30 ',
        //     'mail_address' => 'required | max:100 | email | unique:users',
        //     'sex' => 'required',
        //     'old_year' => 'required',
        //     'old_month' => 'required',
        //     'old_day' => 'required',
        //     'role' => 'required',
        //     'password' => 'required | between:8,30 | confirmed',
        // ]);

        // $validate_collection = $validator->collect();
        
        //   if ($validate_collection->fails()) {
        //     return redirect()->back()
        //     ->withInput()
        //     ->withErrors($validator);
        //   }

        // DB::beginTransaction();
        // try{
            $old_year = $request->old_year;
            $old_month = $request->old_month;
            $old_day = $request->old_day;
            $data = $old_year . '-' . $old_month . '-' . $old_day;
            $birth_day = date('Y-m-d', strtotime($data));
            $subjects = $request->subject;
            // dd($subjects);

            $user_get = User::create([
                'over_name' => $request->over_name,
                'under_name' => $request->under_name,
                'over_name_kana' => $request->over_name_kana,
                'under_name_kana' => $request->under_name_kana,
                'mail_address' => $request->mail_address,
                'sex' => $request->sex,
                'birth_day' => $birth_day,
                'role' => $request->role,
                'password' => bcrypt($request->password)
            ]);
            $user = User::findOrFail($user_get->id);//今登録したユーザーからuser_idを作る
            $user_get->subjects()->attach($subjects);//今登録したユーザーからuser_idを作る
            // DB::commit();
            return view('auth.login.login');
        // }catch(\Exception $e){
        //     DB::rollback();
        //     return redirect()->route('loginView');
        // }
    }
}