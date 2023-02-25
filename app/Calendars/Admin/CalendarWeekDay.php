<?php
namespace App\Calendars\Admin;

use Carbon\Carbon;
use App\Models\Calendars\ReserveSettings;
use Illuminate\Support\Facades\Auth;

class CalendarWeekDay{
  protected $carbon;

  function __construct($date){
    $this->carbon = new Carbon($date);
  }

  function getClassName(){
    return "day-" . strtolower($this->carbon->format("D"));
  }

  function render(){
    return '<p class="day">' . $this->carbon->format("j") . '日</p>';
  }

  function everyDay(){
    return $this->carbon->format("Y-m-d");
  }

  function dayPartCounts($ymd){
    $html = [];
    $one_part = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '1')->first();
    $two_part = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '2')->first();
    $three_part = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '3')->first();

    $html[] = '<div class="text-left">';
    if($one_part){
      $html[] = '<p class="day_part m-0 pt-1"><a href="/calendar/'.Auth::id().'/'.$one_part->setting_reserve.'/'.'1'.'">1部</a><sapn class="ml-2">'.$one_part->users()->count('user_id').'<sapn></p>';
      // $html[] = '<p class="day_part m-0 pt-1"><a href="/calendar/'.{!! Auth::id() !!}.'/'.{!! $one_part->setting_reserve !!}.'/'.{!! 1 !!}.'">1部</a><sapn class="ml-2">'.$one_part->users()->count('user_id').'<sapn></p>';

      // $html[] = '<p class="day_part m-0 pt-1"><a href=".{{ route('.calendar.admin.detail.' , ['id'=>Auth::id(), 'data' => $one_part->setting_reserve, 'part' => 1 ]) }}.">1部</a><sapn class="ml-2">'.$one_part->users()->count('user_id').'<sapn></p>';
      // $html[] = '<span>'.$one_part->users()->count('user_id').'</span>';
    }
    if($two_part){
      $html[] = '<p class="day_part m-0 pt-1"><a href="/calendar/'.Auth::id().'/'.$two_part->setting_reserve.'/'.'2'.'">2部</a><sapn class="ml-2">'.$two_part->users()->count('user_id').'<sapn></p>';
      // $html[] = '<span>'.$two_part->users()->count('user_id').'</span>';
    }
    if($three_part){
      $html[] = '<p class="day_part m-0 pt-1"><a href="/calendar/'.Auth::id().'/'.$three_part->setting_reserve.'/'.'3'.'">3部</a><sapn class="ml-2">'.$three_part->users()->count('user_id').'<sapn></p>';
      // $html[] = '<span>'.$three_part->users()->count('user_id').'</span>';
    }
    $html[] = '</div>';

    return implode("", $html);
  }

  function onePartFrame($day){
    $one_part_frame = ReserveSettings::where('setting_reserve', $day)->where('setting_part', '1')->first();
    if($one_part_frame){
      $one_part_frame = ReserveSettings::where('setting_reserve', $day)->where('setting_part', '1')->first()->limit_users;
    }else{
      $one_part_frame = "20";
    }
    return $one_part_frame;
  }
  function twoPartFrame($day){
    $two_part_frame = ReserveSettings::where('setting_reserve', $day)->where('setting_part', '2')->first();
    if($two_part_frame){
      $two_part_frame = ReserveSettings::where('setting_reserve', $day)->where('setting_part', '2')->first()->limit_users;
    }else{
      $two_part_frame = "20";
    }
    return $two_part_frame;
  }
  function threePartFrame($day){
    $three_part_frame = ReserveSettings::where('setting_reserve', $day)->where('setting_part', '3')->first();
    if($three_part_frame){
      $three_part_frame = ReserveSettings::where('setting_reserve', $day)->where('setting_part', '3')->first()->limit_users;
    }else{
      $three_part_frame = "20";
    }
    return $three_part_frame;
  }

  //
  function dayNumberAdjustment(){
    $html = [];
    $html[] = '<div class="adjust-area">';
    $html[] = '<p class="d-flex m-0 p-0">1部<input class="w-25" style="height:20px;" name="1" type="text" form="reserveSetting"></p>';
    $html[] = '<p class="d-flex m-0 p-0">2部<input class="w-25" style="height:20px;" name="2" type="text" form="reserveSetting"></p>';
    $html[] = '<p class="d-flex m-0 p-0">3部<input class="w-25" style="height:20px;" name="3" type="text" form="reserveSetting"></p>';
    $html[] = '</div>';
    return implode('', $html);
  }
}