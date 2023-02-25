<?php
namespace App\Calendars\General;

use App\Models\Calendars\ReserveSettings;
use Carbon\Carbon;
use Auth;

class CalendarWeekDay{
  protected $carbon;

  function __construct($date){
    $this->carbon = new Carbon($date);//2023-01-30
  }

  function getClassName(){
    return "day-" . strtolower($this->carbon->format("D"));// strtolowerは小文字変換 //day-sat,day-sunだったら文字色を変更することなどができる
  }

  function pastClassName(){
    return;
  }

  /**
   * @return
   */

  // function render(){

  //   $startDay = $this->carbon->copy()->format("Y-m-01");//dを01にして強制的に一日にしてる？？
  //   $toDay = $this->carbon->copy()->format("Y-m-d");//フォーマットの違いは？？？
  
  //   if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){//なんの条件分岐？？ //今日より前か後で違うクラスの付与
  //     return '<p class="day">受付終了</p>';//何日の部分のHTML
  //   }else{
  //     return '<p class="day">' . $this->carbon->format("j"). '日</p>';//何日の部分のHTML
  //   }

  // }

   function render(){
     return '<p class="day">' . $this->carbon->format("j"). '日</p>';//何日の部分のHTML
   }

   function selectPart($ymd){//$ymdにはその日の日付
     $one_part_frame = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '1')->first();//一部、残りの枠数
     $two_part_frame = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '2')->first();//二部、残りの枠数
     $three_part_frame = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '3')->first();//三部、残りの枠数
     if($one_part_frame){
       $one_part_frame = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '1')->first()->limit_users;
     }else{
       $one_part_frame = '0';
     }
     if($two_part_frame){
       $two_part_frame = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '2')->first()->limit_users;
     }else{
       $two_part_frame = '0';
     }
     if($three_part_frame){
       $three_part_frame = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '3')->first()->limit_users;
     }else{
       $three_part_frame = '0';
     }

     $html = [];
     $html[] = '<select name="getPart[]" class="border-primary" style="width:70px; border-radius:5px;" form="reserveParts">';
     $html[] = '<option value="" selected ></option>';//選択されていない時のvalueが入ってしまっている。disabledにしてみた。
     if($one_part_frame == "0"){//一部、残りの枠が0だったらtrue
       $html[] = '<option value="1" disabled>リモ1部(残り0枠)</option>';//disableで押せなくしている
     }else{
       $html[] = '<option value="1">リモ1部(残り'.$one_part_frame.'枠)</option>';

     }
     if($two_part_frame == "0"){
       $html[] = '<option value="2" disabled>リモ2部(残り0枠)</option>';

     }else{
       $html[] = '<option value="2">リモ2部(残り'.$two_part_frame.'枠)</option>';

     }
     if($three_part_frame == "0"){
       $html[] = '<option value="3" disabled>リモ3部(残り0枠)</option>';

     }else{
       $html[] = '<option value="3">リモ3部(残り'.$three_part_frame.'枠)</option>';

     }
     $html[] = '</select>';
     return implode('', $html);
   }

   function getDate(){
     return '<input type="hidden" value="'. $this->carbon->format('Y-m-d') .'" name="getData[]" form="reserveParts">';//すべてのinputにhiddenが適用されてしまっている。

   }

   function everyDay(){
     return $this->carbon->format('Y-m-d');
   }

   function authReserveDay(){
     return Auth::user()->reserveSettings->pluck('setting_reserve')->toArray();
   }

   function authReserveDate($reserveDate){
     return Auth::user()->reserveSettings->where('setting_reserve', $reserveDate);
   }

}