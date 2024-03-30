<?php

namespace App\Logic;

class CustomTime
{
   /**
     * Convert given time to "time ago" expression
     * example of $expectedFormat = 'M d, Y. g:i A'
     * example of $givenDatetimeFormat = 'Y-m-d H:i:s'
     * $datetime = $ebookData->created_at
     */
   public function alteredDatetime($datetime, $givenDatetimeFormat, $expectedFormat)
   {
      $modified_date = date_create_from_format($givenDatetimeFormat, "$datetime");
      return date_format($modified_date, $expectedFormat);
   }

   /**
     * Convert given time to "time ago" expression
     */
    public function timeAgo($date)
    {
       $timestamp = strtotime($date);   
       
       $strTime = array("second", "minute", "hour", "day", "month", "year");
       $length = array("60","60","24","30","12","10");

       $currentTime = time();
       if($currentTime >= $timestamp) {
            $diff     = time() - $timestamp;
            for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
            $diff = $diff / $length[$i];
            }

            $diff = round($diff);
            return $diff . " " . $strTime[$i] . "(s) ago ";
       }
    }
}
