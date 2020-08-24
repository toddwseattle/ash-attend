<?php
include_once "./settings/core.php";
include_once "./view/header.php";
include_once "./view/attendance_menu.php";
$title = "Ashesi Web Development Attendance";
echoHeader($title);
echo <<<__BODY_START
<body>
__BODY_START;

$attendance_menu = create_attendance_menu("Home", ROOT_PREFIX);
echo $attendance_menu->get_html();
echo <<<__TITLE
<div class="title-box">
    <h1>$title</h1>
</div>
__TITLE;
$name = $_SERVER["SERVER_NAME"];
echo <<<__DIAG
<h1>server: $name</h1>
<h2>Current File: $current_file</h2>

<h2>Server Vars</h2>
<ul>
__DIAG;
foreach ($_SERVER as $key => $value) {
  echo "<li> \$_SERVER[" . $key . "]=" . $value;
}
echo "</ul>";

?>
