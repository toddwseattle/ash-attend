<?php
//include database class file
require "../settings/db_class.php";

/**
 *Attend class to handle everything student attendance related
 */
/**
 *@author David Sampah
 *extend connection class to use methods from that class
 */

class attend_class extends db_connection
{
  //--- INSERT -------//

  /**
   *method to register new student
   *use mysql real escape to prevent sql injection
   *takes fname, lname, gender and email
   */
  public function add_student($a, $b, $c, $d)
  {
    //open connection
    $this->db_connect();

    //apply mysql real escape string with db connection
    //to protect against attack
    $cleana = mysqli_real_escape_string($this->db, $a);
    $cleanb = mysqli_real_escape_string($this->db, $b);
    $cleanc = mysqli_real_escape_string($this->db, $c);
    $cleand = mysqli_real_escape_string($this->db, $d);

    //user role: 1 faculty, 2 faculty intern and 3 student
    //user status: 1 active and 2 inactive
    //Write the insert sql
    $sql = "INSERT INTO attend_users (`user_fname`,`user_lname`, `user_gender`, `user_email`, `user_role`, `user_status`) 
                VALUES('$cleana', '$cleanb', '$cleanc', '$cleand', 3, 1)";

    //execute the query
    return $this->db_query_escape_string($sql);
  }

  /**
   *method to insert new class schedule
   *takes class name and date
   */
  public function add_new_class_schedule($a, $b)
  {
    //open connection
    $this->db_connect();

    //apply mysql real escape string with db connection
    $cleana = mysqli_real_escape_string($this->db, $a);
    $cleanb = mysqli_real_escape_string($this->db, $b);

    //Write the insert sql
    $sql = "INSERT INTO attend_class (`class_name`,`class_date`) 
                VALUES('$cleana', '$cleanb')";

    //execute the query
    return $this->db_query_escape_string($sql);
  }

  /**
   *method to mark attendance
   *takes student id, class id and status (pending approval)
   */
  public function add_student_attendance($a, $b)
  {
    //Write the insert sql
    $sql = "INSERT INTO attend_mark (`mark_class_id`,`mark_student_id`, `mark_status`) VALUES('$a', '$b', 2)";

    //execute the sql and return boolean
    return $this->db_query($sql);
  }

  //--- SELECT -------//

  /**
   *method to get student by email (mainly for login,but can be used for other objectives)
   *using mysqli real escape string
   * to saveguard from sql injection
   */
  public function get_student_by_email($a)
  {
    //open connection
    $this->db_connect();

    //apply mysql real escape string with db connection
    $cleanemail = mysqli_real_escape_string($this->db, $a);

    //a query to get all user information base on email
    $sql = "SELECT * FROM attend_users WHERE user_email='$cleanemail'";

    //execute the query
    return $this->db_query_escape_string($sql);
  }

  /**
   *method to search user by last name
   *takes last name or first name
   *role 3 is for students
   */
  public function student_search($a)
  {
    //a query to get all user information base on first or last name
    $sql = "SELECT * FROM `attend_users` WHERE (`user_fname` LIKE '%$a%' OR `user_lname` LIKE '%$a%') AND `user_role` = 3";

    //execute the query
    return $this->db_query($sql);
  }

  /**
   *method to search a user by id
   *takes user id
   */
  public function get_student_by_id($a)
  {
    //a query to get all user information base on id
    $sql = "SELECT * FROM attend_users WHERE user_id=$a";

    //execute the query
    return $this->db_query($sql);
  }

  /**
   *method to get all students
   */
  public function get_all_students()
  {
    //a query to get all students
    $sql = "SELECT * FROM attend_users WHERE `user_role`= 3";

    //execute the query
    return $this->db_query($sql);
  }

  // /**
  // *method for view all attendance by pagination
  // *takes start and limit
  // */
  // public function view_all_attendance_pagination($start, $limit){
  // 	//a query to get all attendance information for pagination
  // 	$sql = "SELECT * FROM attend_mark WHERE `user_role` = 2 ORDER BY `mark_class_id` DESC LIMIT $start, $limit";

  // 	//execute the query
  // 	return $this->db_query($sql);
  // }

  /**
   *method to count all attendance for a particular class schedule
   *takes class id
   */
  public function count_class_attendance($a)
  {
    //a query to get all information
    $sql = "SELECT COUNT(mark_student_id) as class_attendance FROM attend_mark
		WHERE mark_status = 1 AND mark_class_id = $a";

    //execute the query
    return $this->db_query($sql);
  }

  /**
   *method to get students attendance
   *takes student id
   */
  public function get_student_attendance($a)
  {
    //a query to get student's attendance
    $sql = "SELECT * FROM attend_mark
		WHERE mark_status = 1 AND mark_student_id = $a";

    //execute the query
    return $this->db_query($sql);
  }

  /**
   *method to get class schedule by id
   *takes class id
   */
  public function get_class_by_id($a)
  {
    //a query to get a class by id
    $sql = "SELECT * FROM attend_class WHERE class_id=$a";

    //execute the query
    return $this->db_query($sql);
  }

  /**
   *method to get all class schedule
   */
  public function get_all_class_schedules()
  {
    //a query to get all classes
    $sql = "SELECT * FROM attend_class ORDER BY class_date";

    //execute the query
     return $this->db_query($sql);
  }

  //--- UPDATE -------//

  /**
   *method to approves student's attendance
   *takes class id and student's id
   */
  public function approve_student_attendance($a, $b)
  {
    //a query to approve student
    $sql = "UPDATE attend_mark SET `mark_status`= 1 WHERE mark_class_id=$a AND mark_student_id=$b";

    //execute the query
    return $this->db_query($sql);
  }

  //--- DELETE -------//

  // /**
  // *method to delete a student
  // *takes student id
  // */
  // public function delete_student($a){

  // 	//a query to delete a course
  // 	$sql = "DELETE FROM attend_users WHERE user_id=$a";

  // 	//execute the query
  // 	return $this->db_query($sql);
  // }
}

?>
