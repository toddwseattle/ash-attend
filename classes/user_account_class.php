<?php
//connect to database class
require("../settings/db_class.php");

/**
*User account class to handle everything user account related
*/
/**
 *@author David Sampah
 *
 */

class user_account_class extends db_connection
{
//--INSERT METHODS--//
    /**
	*method to register new student
	*use mysql real escape to prevent sql injection
	*/
	public function insert_new_user($a, $b, $c, $d){

		//open connection 
		$this->db_connect();

		//get today's date
		//$today = date('Y-m-d');

		//apply mysql real escape string with db connection
		$cleana = mysqli_real_escape_string($this->db, $a);
		$cleanb = mysqli_real_escape_string($this->db, $b);
		$cleanc = mysqli_real_escape_string($this->db, $c);
		$cleand = mysqli_real_escape_string($this->db, $d);
		

        //user status: 1 active, 2 pending and 3 is inactive
        //user role: 1 faculty, 2 FI and 3 is student
		//Write the insert sql
		$sql = "INSERT INTO attend_users (`user_fname`,`user_lname`, `user_gender`, `user_email`, `user_role`,`user_status`) VALUES('$cleana', '$cleanb', '$cleanc', '$cleand', '3', '1')";
		
		//execute the query
		return $this->db_query_escape_string($sql);
    }
    
//--SELECT METHODS--//

    /**
	*method to get user by email 
	*using mysqli real escape string
	* to saveguard from sql injection
	*/
	public function get_user_by_email($um){
		//open connection 
		$this->db_connect();

		//apply mysql real escape string with db connection
		$cleanemail = mysqli_real_escape_string($this->db, $um);

		//a query to get all login information base on email
		$sql = "SELECT * FROM attend_users WHERE user_email='$cleanemail'";

		//execute the query
		return $this->db_query_escape_string($sql);
    }
    
//--UPDATE METHODS--//
//--DELETE METHODS--//

}

 ?>