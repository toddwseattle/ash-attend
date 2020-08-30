<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <link rel="stylesheet" href="../css/attend.css">
  <script type="module" src="../js/add_form.js"></script>
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
