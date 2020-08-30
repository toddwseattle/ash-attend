<?php
//start session - needed to capture login information 
session_start(); 

//connnect to the controller
require("../controllers/user_controller.php");

if (isset($_POST['email'])) {

	//grab form details 
	$lemail = $_POST['email'];
	//$lpass = $_POST['upass'];

	//check if email exist
	$check_login = get_user_by_email_ctr($lemail);

	if ($check_login) {
		//email exist, continue..

		//check if user is active
		$userstat = $check_login['user_status'];

		if ($userstat == 1) {
            //user is active, continue...
            
            //set session
            $_SESSION["attend_user_id"] = $check_login['user_id'];
            $_SESSION["attend_user_role"] = $check_login['user_role'];

            echo "success";

            // //check for previous page
            // if (isset($_SESSION['cap_pre_page'])) {
            //     echo $_SESSION['cap_pre_page'];
            // }else{
            //     echo "../view/dashboard.php";
            // }
		}
		elseif ($userstat == 2) {
			//echo appropriate error
			echo "pending";
		}
		else{
			//echo appropriate error
			echo "inactive";
		}
	} 
	else
	{
		//echo appropriate error
		echo "failed";
	}

}else{
	echo "No post found";
}

?>