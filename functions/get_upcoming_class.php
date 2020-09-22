<?php 
include_once "../controllers/attend_controller.php";

function get_upcoming_class() {
    $all_classes = get_all_class_sessions();
     foreach ($all_classes as $row) {
         echo $row['class_date'];
         echo $row['class_name'];
     }
}
?>