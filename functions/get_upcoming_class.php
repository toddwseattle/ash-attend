<?php 
include_once "../controllers/attend_controller.php";

function get_upcoming_class() {
    $all_classes = get_all_class_sessions();
    $upcoming = [];
     foreach ($all_classes as $row) {
        $timestamp = DateTime::createFromFormat( "Y-m-d H:i:s", $row['class_date'] ); //strtotime($row['class_date']);
        $today = new DateTime(); // This object represents current date/time
        $today->setTime( 0, 0, 0 ); // reset time part, to prevent partial comparison
        $match_date = $timestamp;
        $match_date->setTime( 0, 0, 0 ); // reset time part, to prevent partial comparison
        $diff = $today->diff( $match_date );
        $diffDays = (integer)$diff->format( "%R%a" ); // Extract days count in interval
        if($diffDays==0) {
            array_push($upcoming,$row);
        }
     }
     return $upcoming;
}
?>