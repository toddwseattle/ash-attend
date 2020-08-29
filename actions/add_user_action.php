<?php
//connnect to the controller
require("../controllers/user_controller.php");

//check for post email
if (isset($_POST['email'])) {
	
	//grab form details 
	$ftName = $_POST['f_name'];
    $ltName = $_POST['l_name'];
    $uGen = $_POST['gender'];
	$uMail = $_POST['email'];
	
	//check if email exit
	$check_email = get_user_by_email_ctr($uMail);

	if ($check_email) {
		
		//email is already registered
		echo "duplicate";
	} 
	else{
		//hash paswrod
		//$hashed_pass = password_hash($uPass, PASSWORD_DEFAULT);

		//register user
		$registerUser = insert_new_user_ctr($ftName, $ltName, $uGen, $uMail);

		//check if registration worked
		if ($registerUser) 
		{
			//success
			echo "success";	
		} 
		else 
			{
	
			//log error
			//get today's date
			$today = date('Y-m-d H:i:s');
			error_log("$today Add user failed. $uMail".PHP_EOL, 3, "../error/php-error.log");

			//failed
			echo "failed";
		}
	}

}else{
	echo "no post found";
}

?>