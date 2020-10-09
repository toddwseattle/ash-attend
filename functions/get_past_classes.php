<?php
include_once "../controllers/attend_controller.php";
/***
 * retrieve a map of past classes
 */
function get_past_classes() {
        $all_classes = get_all_class_sessions();
        $past = [];
        $CURRENT_TIMEZONE= new DateTimeZone("Africa/Monrovia");    
        foreach ($all_classes as $row) {
            $timestamp = DateTime::createFromFormat( "Y-m-d H:i:s", $row['class_date'] ,$CURRENT_TIMEZONE); //strtotime($row['class_date']);
            $today = new DateTime(); // This object represents current date/time
            $match_date = $timestamp;
            $diff = $today->diff( $match_date );
            $diffDays = (integer)$diff->format( "%R%a" ); // Extract days count in interval
            if($diffDays<0) {
                array_push($past,$row);
            }
         }
         return $past;
}