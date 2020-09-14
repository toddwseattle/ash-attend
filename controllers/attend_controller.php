<?php
//connect to the attend class
require("../classes/attend_class.php");

//--INSERT CONTROLLERS--//

//function to insert new class session
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



?>