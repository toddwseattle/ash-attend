<?php
//for header redirection
ob_start();

//start session - needed to capture login information
session_start();

//connect to the controller
require "../controllers/login_controller.php";

//admin login
//admin@gmail.com
//pass:12345

//standard login
//standard@gmail.com
//pass:54321
echo "<h1>" . $_POST['u_mail'] . "</h1>";
//check if login button was clicked
echo "<h1>" . $_POST['u_login'] . "</h1>";
if (isset($_POST['u_login'])) {
  //grab form details
  $l_email = $_POST['u_mail'];
  $l_pass = $_POST['u_pass'];

  //check if email exist
  $check_login = get_login_fxn($l_email);
  if ($check_login) {
    //email exist, continue to password
    //get password from database
    echo "<h2>email " . $check_login[0]['user_email'] . "</h2>";
    echo "<h2>role" . $check_login[0]['user_role'] . "</h2>";
    echo "<h2>password" . $check_login[0]['user_pass'] . "</h2>";

    $hash = $check_login[0]['user_pass'];

    //verify password
    if (password_verify($l_pass, $hash)) {
      //create session for id, role and name
      $_SESSION["user_id"] = $check_login[0]['user_id'];
      $_SESSION["user_role"] = $check_login[0]['user_role'];
      $_SESSION["user_first"] = $check_login[0]['user_fname'];
      $_SESSION["user_last"] = $check_login[0]['user_lname'];
      $_SESSION["user_email"] = $check_login[0]['user_email'];
      $_SESSION["user_gender"] = $check_login[0]['user_gender'];
      $_SESSION["user_role"] = $check_login[0]['user_role'];
      $_SESSION["user_status"] = $check_login[0]['user_status'];

      //redirection to home page
      header('Location: ../view/dashboard.php');

      //to make sure the code below does not execute after redirection use exit
      exit();
    } else {
      //echo appropriate error
      echo '<p>incorrect username or password</p>';
    }
  } else {
    //echo appropriate error
    echo "<p>incorrect username or password</p>";
  }
}

?>
