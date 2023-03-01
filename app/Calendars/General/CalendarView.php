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
    $html = [];//配列変数を定義する
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
      $html[] = '<tr class="'.$week->getClassName().'">';//週クラス名の付与 //$weekにはCalendarWeekインスタンス化した情報が入っている。

      $days = $week->getDays();//一週目の場合、week-0でgetDays //CalendarWeekインスタンスの中にあるgetDays関数を呼ぶ
      foreach($days as $day){//一回目だったら一週目七日分のデータが入っている。一個づつ吐き出す。
        $startDay = $this->carbon->copy()->format("Y-m-01");//dを01にして強制的に一日にしてる？？
        $toDay = $this->carbon->copy()->format("Y-m-d");//フォーマットの違いは？？？

        if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){//なんの条件分岐？？ //今日より前か後で違うクラスの付与
          $html[] = '<td class="calendar-td past-day border">';//過去日だったら
        }else{
          $html[] = '<td class="calendar-td '.$day->getClassName().'">';//曜日が入る。//CalenderWeek(Blank)Dayインスタンスの中に入っている。day-mon day-blankなど
        }
        $html[] = $day->render();//何日を作るHTML。1日 2日の部分。blankの方だったら何も入らない。

        if(in_array($day->everyDay(), $day->authReserveDay())){//in_array関数、第一引数には、検索する値を指定し、第二引数には対象の配列を指定します。//予約してたら「リモ～部」で赤くなる
          $reservePart = $day->authReserveDate($day->everyDay())->first()->setting_part;
          if($reservePart == 1){
            $reservePart_name = "リモ1部";
          }else if($reservePart == 2){
            $reservePart_name = "リモ2部";
          }else if($reservePart == 3){
            $reservePart_name = "リモ3部";
          }
          if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
            $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px">'.$reservePart_name.'</p>';//過去日にスクール参加しているので「リモ一部」」を出す
            // $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
          }else{
            $html[] = '<button type="submit" class="btn btn-danger p-0 w-75 delete-modal-open delete_date"  style="font-size:12px" value="'. $day->authReserveDate($day->everyDay())->first()->setting_reserve .'">'. $reservePart_name .'</button>';//予約ボタン
            $html[] = '<input type="hidden"  name="getPart" value="'.$reservePart.'" form="deleteParts">';
            $html[] = '<input type="hidden" class="getPart" name="getPart" value="'.$reservePart_name.'" >';

          }
        }elseif($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){//予約してなかったら、セレクトを出す

          if(in_array($day->everyDay(), $day->authReserveDay())){//過去日にスクール参加していたらtrue
            $reservePart = $day->authReserveDate($day->everyDay())->first()->setting_part;
            if($reservePart == 1){
              $html[] = '<p>リモ1部</p>';
            }else if($reservePart == 2){
              $html[] = '<p>リモ2部</p>';
            }else if($reservePart == 3){
              $html[] = '<p>リモ3部</p>';
            }

          }else{//過去日にスクール参加していなかったら
            $html[] = '<p>受付終了</p>';
          }

         }else{
          $html[] = $day->selectPart($day->everyDay());//セレクトボックスを出す。
          $html[] = $day->getDate();//input hidden getData[]を出す
        }

        // $html[] = $day->getDate();
        $html[] = '</td>';
      }
      $html[] = '</tr>';//week <tr> 終わり
    }

    //↓ここからHTML固定部分
    $html[] = '</tbody>';
    $html[] = '</table>';
    $html[] = '</div>';
    $html[] = '<form action="/reserve/calendar" method="post" id="reserveParts">'.csrf_field().'</form>';
    $html[] = '<form action="/delete/calendar" method="post" id="deleteParts">'.csrf_field().'</form>';
    //↓モーダル
    $html[] = '<div class="modal js-modal-delete">';
    $html[] = '<div class="modal__bg js-modal-close"></div>';
    $html[] = '<div class="modal__content">';
    $html[] = '<div class="w-100">';
    $html[] = '<dl class="modal-inner w-50 m-auto">';
    $html[] = '<dt>予約日</dt>';
    $html[] = '<dd class="date"></dd>';
    $html[] = '<dt>場所</dt>';
    $html[] = '<dd class="part"></dd>';
    $html[] = '<dd>上記の予約をキャンセルしてもよろしいでしょうか？</dd>';
    $html[] = '</dl>';
    $html[] = '<div class="w-50 m-auto delete-modal-btn d-flex">';
    $html[] = '<a class="js-modal-close btn btn-danger d-inline-block" href="">閉じる</a>';
    $html[] = '<input type="submit" class="btn btn-primary d-block" form="deleteParts" value="キャンセル">';
    $html[] = '<input type="hidden" class="delete_date"  form="deleteParts"  name="delete_date" style="font-size:12px" value=""></input>';
    $html[] = '</div>';
    $html[] = '</div>';
    $html[] = '</div>';
    $html[] = '</div>';


    return implode('', $html);//最終的にrenderの戻り値となる
  }

  protected function getWeeks(){
    $weeks = [];//配列変数を定義する
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
