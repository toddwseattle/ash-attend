<?php
//start session
session_start();

//for header redirection
ob_start();

// get the name of the current page to help with redirection
$current_file = $_SERVER['SCRIPT_NAME'];

//funCtion to check for login
function check_login()
{
  //check if login session exit
  if (!isset($_SESSION['attend_user_id'])) {
  
    //redirect to login page
    header('Location: ../login/login.php');
  }
}

//function to check for permission
function get_user_permission()
{
  //get session role
  if (isset($_SESSION['attend_user_role'])) {

  	//return user role
  	return $_SESSION['attend_user_role'];
  }
}

//function to get user ID
function get_user_id()
{
  //get session id
  if (isset($_SESSION['attend_user_id'])) {

  	//return user id
  	return $_SESSION['attend_user_id'];
  }
}
function get_user_display_name() {
  if (isset($_SESSION["user_first"])&&isset($_SESSION["user_last"])) {
    
  	//return user id
  	return $_SESSION["user_first"] . " ". $_SESSION["user_last"];
  } else {
    return "";
  }
}
?>
