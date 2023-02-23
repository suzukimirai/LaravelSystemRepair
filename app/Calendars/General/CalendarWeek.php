<?php
namespace App\Calendars\General;

use Carbon\Carbon;

class CalendarWeek{
  protected $carbon;
  protected $index = 0;

  function __construct($date, $index = 0){//$indexには何週目か入る
    //dd($date); 2023-02-01
    $this->carbon = new Carbon($date);
    $this->index = $index;
  }

  function getClassName(){
    return "week-" . $this->index;//week-0が一週目
  }

  /**
   * @return
   */

   function getDays(){
     $days = [];

     //週の開始日〜終了日を作成します。
     $startDay = $this->carbon->copy()->startOfWeek(); //2023-01-30
     $lastDay = $this->carbon->copy()->endOfWeek(); //2023-02-05
    //  dd($startDay);

     $tmpDay = $startDay->copy();//2023-01-30
      //  dd($tmpDay);
     while($tmpDay->lte($lastDay)){//月曜日〜日曜日までループ
       if($tmpDay->month != $this->carbon->month){//$tmpDayが$carbonの月内かどうか。そうじゃなかったらブランクにしたい。
         $day = new CalendarWeekBlankDay($tmpDay->copy());
         $days[] = $day;
         $tmpDay->addDay(1);
         continue;
        }//$tmpDayが$carbonの月内だった場合
        $day = new CalendarWeekDay($tmpDay->copy());
        $days[] = $day;

        $tmpDay->addDay(1);
      }
      return $days;//$daysは一週間=7個のオブジェクトが入っていますがCalendarWeekBlankDayとCalendarWeekDayのオブジェクトが混ざっています。
    }
  }