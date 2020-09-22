<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="module" src="../js/mark_attendance.js"></script>
  <link rel="stylesheet" href="../css/attend.css">
<title>Mark Attendance</title>
</head>
<body>
<?php 
include_once "attendance_menu.php";
include_once "../functions/get_upcoming_class.php";
$attendance_menu = create_attendance_menu("Mark");
echo $attendance_menu->get_html();
$display_name =get_user_display_name();
echo "<p>";
$upcoming = get_upcoming_class();
$message = "Upcoming class";
if(count($upcoming)==1) {
  $row=$upcoming[0];
  $message= $row['class_name'] . " on ". $row['class_date'];
}
echo <<<__FORM
<div id="title" class="title-box">
  <h1 id="title-text">Mark Attendance</h1>
</div>
<form class="form-box" method="post">
<div class="inner-row">
        <label class="fancy-check-label">
            <input type="checkbox" id="mark-present">
            <span class="fancy-check-custom rectangular"></span>
        </label>
        <span class="check-title" id="mark-date">I'm attending: $message </span>
</div>
<button type="submit">Submit Attendance</button>
</form>
</body>
</html>
__FORM;
?>  
