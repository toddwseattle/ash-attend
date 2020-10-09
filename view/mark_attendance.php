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
include_once "../settings/core.php";
include_once "../functions/sanitize_input.php";
include_once "../functions/mark_user_attendance.php";
$CURRENT_TIMEZONE= new DateTimeZone("Africa/Monrovia");

$user_id = get_user_id();
$attendance_menu = create_attendance_menu("Mark");
// output the header of the page
echo <<<__HEAD
<div id="title" class="title-box">
<h1 id="title-text">Mark Attendance</h1>
</div>
__HEAD;
echo $attendance_menu->get_html();
$display_name =get_user_display_name();
if(!(isset($_POST)&&isset($_POST["present"])))  { // then the form has not yet been posted
      $upcoming = get_upcoming_class();
      $message = "No Upcoming Class Today";
      if(count($upcoming)>=1) {  // more than one class today.  Set it to the first one coming up
        $row = $upcoming[0];
        if(count($upcoming)>1) {
          foreach ($upcoming as  $ct) {
            $ct_time = DateTime::createFromFormat("Y-m-d H:i:s",$ct['class_date'],$CURRENT_TIMEZONE)->add(new DateInterval("PT1H30M"
            ));
            $now = new DateTime();
            $diff =$now->diff($ct_time); 
            // echo "<p>" . $diff->h . " hours " . $diff->m ." minutes </p> ";
          //  echo "<p>Class " . $ct['class_name'] . $ct['class_date'] . " is difference " . $diff->format("%R%a%H:%i:%s") . " " . ($diff->h*60+$diff->m*60) . "</p>";
          // see if it's within about 100 minutes of start of class 
          if(($diff->h*60+$diff->m) < 100) {
              $row=$ct;
            break;
            } 
          }
        } 

        $message= "I'm present for class: " . $row['class_name'] . " on ". $row['class_date'];
        $class_id = $row['class_id'];
        $js_encode = json_encode($row);
        echo <<<__JSDEFINE
          <script>
            var upComing = $js_encode;
          </script>
          __JSDEFINE;

          echo <<<__FORM
          <form class="form-box" method="post" action="mark_attendance.php">
          <div class="inner-row">
                  <label id="check-wrapper" class="fancy-check-label">
                      <input type="checkbox" id="mark-present" name="present" value="$class_id">
                      <span class="fancy-check-custom"></span>
                  </label>
                  <span id="mark-date" class="check-title" >$message</span> 
          </div>
          <button type="submit">Submit Attendance</button>
          </form>
      __FORM;
        
      } else {  // no upcoming, just display a message
        echo <<<__NOCLASS
        <section class="form-box">
        <h4>No Upcoming Classes for Today</h4>
        </section>
        __NOCLASS;

  }
} else {  // the form has been posted with present
  // first sanitize what's in present
  $present = sanitize_as_int($_POST['present']);
  if (mark_user_attendance($user_id,$present)) {
    echo <<<__MARKED
        <section class="form-box">
        <h4>Marked Present</h4>
        </section>
        
    __MARKED;  
  } else {
    echo <<<__MARKED
        <section class="form-box">
        <h4>An Error Occurred Marking Present (code uid: $user_id classId: $present)</h4>
        </section>
        
    __MARKED;  
  };
}
?> 
</body>
</html>
 
