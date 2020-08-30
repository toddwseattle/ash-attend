<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <link rel="stylesheet" href="../css/attend.css">
  <script src="../js/addform.js"></script>
  <title>Add Student</title>
</head>
<body>
<?php
include_once "attendance_menu.php";
$attendance_menu = create_attendance_menu("Add Student");
echo $attendance_menu->get_html();
?>
<div id="title" class="title-box">
  <h1 id="title-text">Add Student</h1>
</div>
<form id="addForm" class="form-box" method="post">
    <div class="field-group">
        <label for="first">First</label>
        <input type="text" id="first" name="f_name"  placeholder="First Name">
    </div>
    <div class="field-group">
        <label for="last">Last</label>
        <input type="text" id="last" name="l_name" placeholder="Last Name">
    </div>
    <div class="field-group">
        <label for "email">Email</label>
        <input type="email" id="email" name="email"  placeholder="studentname@ahesi.edu.gh">
    </div>
      <div class="radio-box">
        <p>Gender</p>
        <input type="radio" id="male" name="gender" value="Male">
        <label for="male">Male</label><br>
        <input type="radio" id="female" name="gender" value="Female">
        <label for="female">Female</label><br>
      </div>
      <button id="addStudentSubmit" type="submit" value="add" >Add</button>
      <div class="radio-box" id="form-errors"></div>
     </form> 
</body>
</html>
<!-- 
include_once "../settings/core.php";
include_once "header.php";
include_once "attendance_menu.php";
include_once "../utility/html_tag_class.php";
include_once "../classes/user_class.php";
include_once "../actions/add_student_action.php";
if (isset($_SESSION) and isset($_SESSION["user_id"])) {
  $curUser = user_class::create_from_session($_SESSION);
} else {
  $curUser = new user_class("Test", "User", "test@user.com", "Male", 1);
}
echoHeader("Add Student");

echo <<<__BODY_START
<body>
__BODY_START;
$attendance_menu = create_attendance_menu("Add Student");
echo $attendance_menu->get_html();
echo <<<__TITLE
<div id="title" class="title-box">
        <h1 id="title-text">Add Student</h1>
    </div>
__TITLE;

$add_student = new user_class();
$messages = [];
if (
  !empty($_POST['fname']) or
  !empty($_POST['lname']) or
  !empty($_POST['email']) or
  !empty($_POST['gender'])
) {
  $messages = $add_student->createFromForm(
    filter_var($_POST['fname'], FILTER_SANITIZE_STRING),
    filter_var($_POST['lname'], FILTER_SANITIZE_STRING),
    filter_var($_POST['email'], FILTER_SANITIZE_STRING),
    filter_var($_POST['gender'], FILTER_SANITIZE_STRING)
  );
  if (count($messages) == 1 and $messages[0]->is_ok()) {
    if (add_student_action($add_student)) {
      $messages[0] = new form_error($add_student->getFullName() . " Added");
    } else {
      $messages[0] = new form_error(
        'failed to add ' . $add_student->getFullName(),
        "",
        1
      );
    }
  }
}

