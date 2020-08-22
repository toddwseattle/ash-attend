<?php
include_once "header.php";
$attend_scripts = [
  "utility/setvalue.js",
  "sample_data/attendance.js",
  "sample_data/students.js",
  "utility/managetable.js",
];
$prefix = "../js/src/";
foreach ($attend_scripts as &$toPrefix) {
  $toPrefix = $prefix . $toPrefix;
}
echoHeader("Mark Attendance", $attend_scripts);
