<?php
//connect to the login class
require "../classes/login_class.php";

//function to get login information - takes email
function get_login_fxn($uem)
{
  //Create an array variable to hold login key value pair
  $login_array = [];

  //create an instance of the login class
  $login_object = new login_class();

  //run the verify login method using the email
  $login_record = $login_object->verify_login($uem);

  //check if the method worked
  if ($login_record) {
    //fetch from the result
    $one_record = $login_object->db_fetch();
    //assign to array
    $login_array[] = $one_record;
  }
  //return array
  return $login_array;
}

?>
