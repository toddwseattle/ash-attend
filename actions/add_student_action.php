<?php
include_once "../classes/user_class.php";
include_once "../classes/attend_class.php";
function add_student_action(user_class $user)
{
  $attend_db = new attend_class();
  return $attend_db->add_student(
    $user->fname,
    $user->lname,
    $user->gender,
    $user->email
  );
}

// note this is not complete
