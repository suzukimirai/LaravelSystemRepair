<?php
namespace App\Calendars\General;

class CalendarWeekBlankDay extends CalendarWeekDay{//extendsなんだっけ？？
  function getClassName(){
    return "day-blank";//背景をグレーにする
  }

  /**
   * @return
   */

   function render(){
     return '';
   }

   function selectPart($ymd){
     return '';
   }

   function getDate(){
     return '';
   }

   function cancelBtn(){
     return '';
   }

   function everyDay(){
     return '';
   }

}