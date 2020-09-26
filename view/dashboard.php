<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="module" src="../js/dashboard.js"></script>
  <link rel="stylesheet" href="../css/attend.css">
<title>Dashboard</title>
</head>
<body>
<?php
include_once "../settings/core.php";
include_once "header.php";
include_once "attendance_menu.php";
include_once "../utility/html_tag_class.php";
include_once "../classes/user_class.php";
include_once "../functions/get_upcoming_class.php";

check_login();

// //1 faculty, 2 FI and 3 student

$get_user_id = get_user_id();

// $curUser = "Not Logged In";
// if ($get_user_id) {
//   $curUser = user_class::create_from_session($_SESSION);
// }

check_login();
$up_coming = get_future_classes();
if(count($up_coming)>0) {
    $js_encode = json_encode($up_coming);
  echo <<<__JSDEFINE
    <script>
      var upComing = $js_encode;
    </script>
    __JSDEFINE;
}
$attendance_menu = create_attendance_menu("Dashboard");
echo $attendance_menu->get_html();
echo <<<__TITLE
<div id="title" class="title-box">
        <h1 id="title-text">Dashboard: Upcoming Classes</h1>
    </div>
__TITLE;
?>
<div id="upcoming-div" class="form-box">
    <h4>No Upcoming Classes</h4>
</div>   
</body>
</html>