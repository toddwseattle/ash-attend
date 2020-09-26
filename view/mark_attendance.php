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
$message = "No Upcoming Class Today";
if(count($upcoming)==1) {
  $row=$upcoming[0];
  $message= "I'm present for class: " . $row['class_name'] . " on ". $row['class_date'];
  $js_encode = json_encode($row);
  echo <<<__JSDEFINE
    <script>
      var upComing = $js_encode;
    </script>
    __JSDEFINE;

    echo <<<__FORM
    <div id="title" class="title-box">
      <h1 id="title-text">Mark Attendance</h1>
    </div>
    <form class="form-box" method="post">
    <div class="inner-row">
            <label id="check-wrapper" class="fancy-check-label">
                <input type="checkbox" id="mark-present">
                <span class="fancy-check-custom"></span>
            </label>
            <span id="mark-date" class="check-title" >$message</span> 
    </div>
    <button type="submit">Submit Attendance</button>
    </form>
__FORM;
  
} else {  // no upcoming
  echo <<<__NOCLASS
  <div id="title" class="title-box">
  <h1 id="title-text">Mark Attendance</h1>
  </div>
  <section class="form-box">
  <h4>No Upcoming Classes for Today</h4>
  </section>
  __NOCLASS;

}
?> 
</body>
</html>
 
