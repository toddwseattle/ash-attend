<?php
include_once "../settings/core.php";
include_once "header.php";
include_once "attendance_menu.php";
include_once "../utility/html_tag_class.php";
$curUser = "Not Logged In";
if (isset($_SESSION) and isset($_SESSION["user_id"])) {
  $curUser = user_class::create_from_session($_SESSION);
}
echoHeader("Dashboard");

echo <<<__BODY_START
<body>
__BODY_START;
$attendance_menu = create_attendance_menu("Dashboard", ROOT_PREFIX);
echo $attendance_menu->get_html();
echo <<<__TITLE
<div id="title" class="title-box">
        <h1 id="title-text">$curUser</h1>
    </div>
__TITLE;
