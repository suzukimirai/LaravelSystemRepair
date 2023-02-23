<?php
namespace App\Calendars\General;

use Carbon\Carbon;
use Auth;

class CalendarView{

  private $carbon/*同じ*/;
  function __construct($date){//callendercontoroller.phpでcalenderViewを呼び出したときの引数が送られてきて$dateに入る
    $this->carbon/*同じ*/ = new Carbon($date);//引数に指定した日付を便利なCarbonにして取得 /*$thisは同じクラス内のメソッドやプロパティを表す。*/
    // dd($date);
  }

  // function __construct($date){
  //   $carbon = new Carbon($date);
  // }
  // ★ Undefined property: App\Calendars\General\CalendarView::$carbonというエラーがでる


  public function getTitle(){
    return $this->carbon->format('Y年n月');//現在の日付を取得してフォーマットに落とし込む
  }

  function render(){
    $html = [];
    $html[] = '<div class="calendar text-center">';
    $html[] = '<table class="table">';
    $html[] = '<thead>';
    $html[] = '<tr>';
    $html[] = '<th>月</th>';
    $html[] = '<th>火</th>';
    $html[] = '<th>水</th>';
    $html[] = '<th>木</th>';
    $html[] = '<th>金</th>';
    $html[] = '<th>土</th>';
    $html[] = '<th>日</th>';
    $html[] = '</tr>';
    $html[] = '</thead>';
    $html[] = '<tbody>';
    //↑ここまでHTML固定部分

    $weeks = $this->getWeeks();//getWeeksメソッドは下にあるよ!! //配列で[0,1,2,...]と入っている
    foreach($weeks as $week){//一週目、二週目と回していく。そのたびに<tr>で囲まれるから七日で一列になる
      $html[] = '<tr class="'.$week->getClassName().'">';//週クラス名の付与

      $days = $week->getDays();//一週目の場合、week-0でgetDays
      foreach($days as $day){//七日分のデータが入っている。一個づつ吐き出す。
        $startDay = $this->carbon->copy()->format("Y-m-01");//dを01にして強制的に一日にしてる？？
        $toDay = $this->carbon->copy()->format("Y-m-d");//フォーマットの違いは？？？

        if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
          $html[] = '<td class="calendar-td">';//ここはどこの部分？？
        }else{
          $html[] = '<td class="calendar-td '.$day->getClassName().'">';//曜日が入る。day-mon day-blankなど
        }
        $html[] = $day->render();//何日を作る。1日 2日の部分。blankの方だったら何も入らない。

        if(in_array($day->everyDay(), $day->authReserveDay())){
          $reservePart = $day->authReserveDate($day->everyDay())->first()->setting_part;
          if($reservePart == 1){
            $reservePart = "リモ1部";
          }else if($reservePart == 2){
            $reservePart = "リモ2部";
          }else if($reservePart == 3){
            $reservePart = "リモ3部";
          }
          if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
            $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px"></p>';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
          }else{
            $html[] = '<button type="submit" class="btn btn-danger p-0 w-75" name="delete_date" style="font-size:12px" value="'. $day->authReserveDate($day->everyDay())->first()->setting_reserve .'">'. $reservePart .'</button>';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
          }
        }else{
          $html[] = $day->selectPart($day->everyDay());
        }
        $html[] = $day->getDate();
        $html[] = '</td>';
      }
      $html[] = '</tr>';//week tr 終わり
    }

    //↓ここからHTML固定部分
    $html[] = '</tbody>';
    $html[] = '</table>';
    $html[] = '</div>';
    $html[] = '<form action="/reserve/calendar" method="post" id="reserveParts">'.csrf_field().'</form>';
    $html[] = '<form action="/delete/calendar" method="post" id="deleteParts">'.csrf_field().'</form>';

    return implode('', $html);
  }

  protected function getWeeks(){
    $weeks = [];
    $firstDay = $this->carbon->copy()->firstOfMonth();//2月1日
    $lastDay = $this->carbon->copy()->lastOfMonth();//2023-02-28
    $week = new CalendarWeek($firstDay->copy());
    $weeks[] = $week;
    $tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();//2月6日 //startOfWeekはデフォルトで月曜日が入る
    while($tmpDay->lte($lastDay)){//$tmpDayが$lastDay以下だったら実行!二月だと4回まわせる。最後の日は2/27の月曜日。次だと28日を超えてしまう。
      $week = new CalendarWeek($tmpDay, count($weeks));//$tmpDayには何が入る？
      $weeks[] = $week;//回す度に増えていき、週目を表す。
      $tmpDay->addDay(7);//最後に七日を加えて、またwhile.
    }
    return $weeks;//この結果をrenderに渡す返り値
  }
}