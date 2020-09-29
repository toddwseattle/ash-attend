<?php
//connect to the attend class
require("../classes/attend_class.php");

//--INSERT CONTROLLERS--//

//function to insert new class session
//takes class name and date
function insert_new_class_session_ctr($a, $b){
	
	//create an instance of the attend class
	$new_item = new attend_class();

	//run the insert new class method
    $class_record = $new_item->add_new_class_schedule($a, $b);
    
	//check if method worked
	if ($class_record) {

		//return query result (boolean)
		return $class_record;

	}else{

        //failed
		return false;
	}
}

//function to mark student attendance
//takes student id and class id
function insert_new_student_attendance_ctr($classid, $stuid){
	
	//create an instance of class
	$item_object = new attend_class();

	//run the insert new method
	$any_record = $item_object->add_student_attendance($classid, $stuid);

	//check if method worked
	if ($any_record) {

		//return query result (boolean)
		return $any_record;

	}else{

		return false;
	}
}
	

//--SELECT--

//function to get all class sessions
function get_all_class_sessions() {
	$get_classes = new attend_class();
    if($get_classes->get_all_class_schedules()) {
		if($get_classes->db_fetch()) {
			return $get_classes->results;
		} else 
		{
			echo "<p>didn't fetch</p>";
			return [];
		}
	} else {
		echo "<p>query problem</p>";
		return [];
	};
}

//function to get user by id (any user)
function get_user_by_id_ctr($uid){

	//create an instance of the class
	$item_object = new attend_class();

	//run method to get by id
	$any_record = $item_object->get_student_by_id($uid);

	//check if any record was found
	if ($any_record) {
		
		//fetch the from the result
		$one_record = $item_object->db_fetch();

		//create one array
		$item_array = [];

		//assign to array
		$item_array = $one_record;
		
		//return array
		return $item_array;

	}else{
		return false;
	}
}

//get all students
function get_all_students_ctr(){
	//Create an array variable
	$item_array = array();

	//create an instance of the class
	$item_object = new attend_class();

	//run the view all method
	$any_record = $item_object->get_all_students();

	//check if the method worked
	if ($any_record) {
		
		//loop to see if there is more than one result
		//fetch one at a time
		while ($one_record = $item_object->db_fetch()) {
			//Assign each result to the array
			$item_array[] = $one_record;
		}
	}
	//return the array
	return $item_array;
}

//function to get class by id
function get_class_by_id_ctr($cid){

	//create an instance of the class
	$item_object = new attend_class();

	//run method to get by id
	$any_record = $item_object->get_class_by_id($cid);

	//check if any record was found
	if ($any_record) {
		
		//fetch the from the result
		$one_record = $item_object->db_fetch();

		//create one array
		$item_array = [];

		//assign to array
		$item_array = $one_record;
		
		//return array
		return $item_array;

	}else{
		return false;
	}
}


//get all class schedules
function get_all_class_schedule_ctr(){
	//Create an array variable
	$item_array = array();

	//create an instance of the class
	$item_object = new attend_class();

	//run the view all method
	$any_record = $item_object->get_all_class_schedules();

	//check if the method worked
	if ($any_record) {
		
		//loop to see if there is more than one result
		//fetch one at a time
		while ($one_record = $item_object->db_fetch()) {
			//Assign each result to the array
			$item_array[] = $one_record;
		}
	}
	//return the array
	return $item_array;
}

//get a students attendance (both present and absent)
function get_a_student_attendance_ctr($studid){
	//Create an array variable
	$item_array = array();

	//create an instance of the class
	$item_object = new attend_class();

	//run the view all method
	$any_record = $item_object->get_a_student_attendance($studid);

	//check if the method worked
	if ($any_record) {
		
		//loop to see if there is more than one result
		//fetch one at a time
		while ($one_record = $item_object->db_fetch()) {
			//Assign each result to the array
			$item_array[] = $one_record;
		}
	}
	//return the array
	return $item_array;
}

//get all pending attendnace
function get_all_pending_attendance_ctr(){
	//Create an array variable
	$item_array = array();

	//create an instance of the class
	$item_object = new attend_class();

	//run the view all method
	$any_record = $item_object->get_all_pending_attendance();

	//check if the method worked
	if ($any_record) {
		
		//loop to see if there is more than one result
		//fetch one at a time
		while ($one_record = $item_object->db_fetch()) {
			//Assign each result to the array
			$item_array[] = $one_record;
		}
	}
	//return the array
	return $item_array;
}

//get all class attendance
//takes class id
function get_attendance_by_class_ctr($classid){
	//Create an array variable
	$item_array = array();

	//create an instance of the class
	$item_object = new attend_class();

	//run the view all method
	$any_record = $item_object->get_attendance_by_class($classid);

	//check if the method worked
	if ($any_record) {
		
		//loop to see if there is more than one result
		//fetch one at a time
		while ($one_record = $item_object->db_fetch()) {
			//Assign each result to the array
			$item_array[] = $one_record;
		}
	}
	//return the array
	return $item_array;
}

//--UPDATE--
//function to approve student attendnace
//takes class id and student id
function approve_student_attendance_ctr($classid, $stuid){
	
	//create an instance of the class
	$item_object = new attend_class();

	//run the update method
	$update_item = $item_object->approve_student_attendance($classid, $stuid);

	//check if method worked
	if ($update_item) {

		//return query result (boolean)
		return $update_item;

	}else{

		return false;
	}
}

//--DELETE--


?>