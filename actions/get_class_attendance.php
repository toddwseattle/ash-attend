<?php
include_once "../settings/core.php";
include_once "../controllers/attend_controller.php";
include_once "../functions/sanitize_input.php";
header('Content-type: application/json');
check_login();
if(get_user_permission()>1&&_GET['class_id'])  { // fi or better; ok to return the info
    $classid = sanitize_as_int(get['class_id']);
    $class_attendance = $classid>0 ? get_attendance_by_class_ctr($classid) : [];
    if(count($class_attendance)>0) {
        $response = array("class_id"=>$classid,"attendance"=>$class_attendance);
        echo json_encode($response);
    }
} else {
    echo "no permission";
}
?>