<?php
include_once "../view/header.php";
include_once "../view/AttendanceMenu.php";
include_once "../settings/baseurl.php";
echoHeader("Ashesi Web Development Attendance Homepage");
echo <<<__BODY_START
<body>
__BODY_START;
echo ShowAttendanceMenu("Home");
$name = $_SERVER["SERVER_NAME"];
echo BASEURL;
echo <<<__DIAG
<h1>$name</h1>
<h1>$dir</h1>

__DIAG;
