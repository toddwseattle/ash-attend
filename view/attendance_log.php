<?php
include_once "header.php";
include_once "AttendanceMenu.php";
$attend_scripts = [
    "utility/setvalue.js",
    "sample_data/attendance.js",
    "sample_data/students.js",
    "utility/managetable.js"
];
$prefix = "../js/src/";
foreach ($attend_scripts as &$toPrefix) {
    $toPrefix = $prefix . $toPrefix;
}
echoHeader("Attendance History",$attend_scripts);
echo <<<__WINLOAD
<script>
window.onload = () => {
    const user = sample_students[0]
    setTextFromId('title-text', `Mark \${user.first}'s Attendance`);
    const attendanceData = sampleAttendance[user.email];
    const attendanceTable = new HTMLTable(["Date", "StartTime", "MarkedPresent", "Present"]);
    attendanceTable.values = attendanceData;
    const tableArea = document.getElementById("att-section");
    attendanceTable.insertFullTable(tableArea);
}
</script>
__WINLOAD;
echo ShowAttendanceMenu("Record");
echo <<<__TITLE


<body>

<div id="title" class="title-box">
<h1 id="title-text">Mark Attendance</h1>
</div>
__TITLE;

echo <<<_ATTENDANCE
<div id="att-section" class="att"></div>
</body>

</html>
_ATTENDANCE;


