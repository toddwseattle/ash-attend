<?php 
include_once "../controllers/attend_controller.php";


/**
 * returns all classes in an array map indexed by class column.  classes are in ascending order
 */
function get_upcoming_class() {
    $all_classes = get_all_class_sessions();
    $upcoming = [];
    $CURRENT_TIMEZONE= new DateTimeZone("Africa/Monrovia");    foreach ($all_classes as $row) {
        $timestamp = DateTime::createFromFormat( "Y-m-d H:i:s", $row['class_date'] ,$CURRENT_TIMEZONE); //strtotime($row['class_date']);
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
/**
 * returns all classes in the future as an array map by table column
 */
function get_future_classes() {
    $all_classes = get_all_class_sessions();
    $future = [];
    $CURRENT_TIMEZONE= new DateTimeZone("Africa/Monrovia");
    foreach ($all_classes as $row) {
        $timestamp = DateTime::createFromFormat( "Y-m-d H:i:s", $row['class_date'], $CURRENT_TIMEZONE ); //strtotime($row['class_date']);
        $today = new DateTime(); // This object represents current date/time
        $today->setTime( 0, 0, 0 ); // reset time part, to prevent partial comparison
        $match_date = $timestamp;
        $match_date->setTime( 0, 0, 0 ); // reset time part, to prevent partial comparison
        $diff = $today->diff( $match_date );
        $diffDays = (integer)$diff->format( "%R%a" ); // Extract days count in interval
        if($diffDays>=0) {
            array_push($future,$row);
        }
     }
     return $future;   
}
?>
