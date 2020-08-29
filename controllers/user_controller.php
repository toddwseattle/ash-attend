<?php
//connect to the user class
require("../classes/user_account_class.php");

//--INSERT CONTROLLERS--//

//function to insert new student
function insert_new_user_ctr($a, $b, $c, $d){
	
	//create an instance of the user account class
	$new_user = new user_account_class();

	//run the insert new user method
	$user_record = $new_user->insert_new_user($a, $b, $c, $d);

	//check if method worked
	if ($user_record) {

		//return query result (boolean)
		return $user_record;

	}else{

        //failed
		return false;
	}
}


//--SELECT CONTROLLERS--//

//function to get/verify user account - takes email
//applies mysqli real escape string
//saveguard from sql injection
function get_user_by_email_ctr($uem){

	//create an instance of the user class
	$user_object = new user_account_class();

	//run the verify user method using the email
	$user_object->get_user_by_email($uem);

	//check if a record was found
	$any_record = $user_object->db_count();

	//check if any record was found
	if ($any_record > 0) {
		
		//fetch the from the result
		$one_record = $user_object->db_fetch();

		//create one array
		$user_array = [];
		//assign to array
		$user_array = $one_record;
		//return array
		return $user_array;

	}else{
		return false;
	}
}

//--UPDATE CONTROLLERS--//
//--DELETE CONTROLLERS--//

?>