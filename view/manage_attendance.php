<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Attendance Sessions</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="module" src="../js/manage_attendance.js"></script>
  <link rel="stylesheet" href="../css/attend.css">
</head>
<body>
<?php
include_once "attendance_menu.php";
include_once "../functions/get_past_classes.php";
check_login();
$attendance_menu = create_attendance_menu("Manage Attendance");
echo $attendance_menu->get_html();
?>
<header id="title" class="title-box">
  <h1 id="title-text">Manage Attendance</h1>
</header>
<section class="action-header" id="action-bar">

</section>
<section class="form-box" id="action-list">
<div class="form-group">
    
    <label for="class-date">Class:</label>
    <select name="class-date" id="class-date"><?php 
    $class_filter_list = get_past_classes();
    foreach ($class_filter_list as $class) {
        $id = $class['class_id'];
        $description = $class['class_date'] . " ".  $class['class_name'];
        echo "<option value=\"$id\">$description</option>";
    }
    ?></select>
</div>
<h4>Action List</h4>
</section>
