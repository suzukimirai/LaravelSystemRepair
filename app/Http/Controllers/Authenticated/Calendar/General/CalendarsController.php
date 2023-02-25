<?php

namespace App\Http\Controllers\Authenticated\Calendar\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Calendars\General\CalendarView;
use App\Models\Calendars\ReserveSettings;
use App\Models\Calendars\Calendar;
use App\Models\USers\User;
use Auth;
use DB;

class CalendarsController extends Controller
{
    public function show(){
        $calendar = new CalendarView(time());
        return view('authenticated.calendar.general.calendar', compact('calendar'));
    }

    public function reserve(Request $request){//生徒が予約する
        DB::beginTransaction();
        try{
            $getPart = $request->getPart;//部数
            $getDate = $request->getData;//日付
            // dd($request);
            $reserveDays = array_filter(array_combine($getDate, $getPart));//部数と日付をarray_combine関数で配列にして格納
            foreach($reserveDays as $key => $value){
                $reserve_settings = ReserveSettings::where('setting_reserve', $key)->where('setting_part', $value)->first();//日付と部数からIDを取得
                $reserve_settings->decrement('limit_users');//decrementで人数を減らしている。
                $reserve_settings->users()->attach(Auth::id());//今ログインしているユーザーが予約する
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }
        return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
    }
}