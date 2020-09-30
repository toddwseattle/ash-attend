<?php
include_once "../controllers/attend_controller.php";
function mark_user_attendance($user_id, $class_id) {
    // does it exist? 
    $student_attendance = get_a_student_attendance_ctr($user_id);
    if(count($student_attendance)>0) {
        foreach ($student_attendance as $attend) {
            if($attend['mark_class_id']==$class_id) {
                return true; //already marked
            }
        }
    } 
    return insert_new_student_attendance_ctr($class_id, $user_id);
}
?>