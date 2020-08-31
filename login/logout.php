<?php
//for header redirection
ob_start();

//start session
session_start();

//clear session
// remove all session variables
unset($_SESSION['attend_user_id']);
unset($_SESSION['attend_user_role']);

//redirect to login
header('Location: ../index.php');

?>