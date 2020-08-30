<?php
include_once "../settings/core.php";
include_once "header.php";
include_once "attendance_menu.php";
include_once "../utility/html_tag_class.php";
include_once "../classes/user_class.php";

check_login();

// //1 faculty, 2 FI and 3 student

$get_user_id = get_user_id();

// $curUser = "Not Logged In";
// if ($get_user_id) {
//   $curUser = user_class::create_from_session($_SESSION);
// }

echoHeader("Dashboard");
check_login();
echo <<<__BODY_START
<body>
__BODY_START;
$attendance_menu = create_attendance_menu("Dashboard");
echo $attendance_menu->get_html();
echo <<<__TITLE
<div id="title" class="title-box">
        <h1 id="title-text">Dashboard</h1>
    </div>
__TITLE;
