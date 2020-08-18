
<?php
include_once "header.php";
include_once "AttendanceMenu.php";
include_once "./utility/HTMLTag.php";
include_once "../classes/user_class.php";
$attend_scripts = ["utility/setvalue.js", "utility/managetable.js"];
$prefix = "../js/src/";
foreach ($attend_scripts as &$toPrefix) {
  $toPrefix = $prefix . $toPrefix;
}
echo <<<__WINLOAD
<script>
window.onload = () => {
}
</script>
<body>
__WINLOAD;
echoHeader("Add Student");
echo ShowAttendanceMenu("Add Student");
echo <<<__TITLE
<div id="title" class="title-box">
        <h1 id="title-text">Add Student</h1>
    </div>
__TITLE;

$add_student = new user_class();
$messages = [];
if (
  !empty($_POST['fname']) or
  !empty($_POST['lname']) or
  !empty($_POST['email'])
) {
  $messages = $add_student->createFromForm(
    filter_var($_POST['fname'], FILTER_SANITIZE_STRING),
    filter_var($_POST['lname'], FILTER_SANITIZE_STRING),
    filter_var($_POST['email'], FILTER_SANITIZE_STRING)
  );
}
echo <<<__ADDFORM
    <form id="addForm" class="form-box" method="post">
        <label for="first">First</label>
        <input type="text" id="first" name="fname" value="$add_student->fname" placeholder="First Name">
        <label for="last">Last</label>
        <input type="text" id="last" name="lname"value="$add_student->lname" placeholder="Last Name">
        <label for "email">Email</label>
        <input type="email" id="email" name="email" value="$add_student->email" placeholder="studentname@ahesi.edu.gh">
        <button id="addStudentSubmit" type="submit" value="Submit">Submit</button>
__ADDFORM;
foreach ($messages as $index => $message) {
  switch ($message->status) {
    case 0:
      $msgText = new HTMLTag("div", $message->message, "msg" . $index, [
        "info-msg",
      ]);
      echo $msgText->getHTML();
      break;
    case 1:
      $msgText = new HTMLTag("div", $message->message, "msg" . $index, [
        "error-msg",
      ]);
      echo $msgText->getHTML();
      break;
    default:
      # code...
      break;
  }
}
echo <<<__CLOSE
</form>
</body>
</html>
__CLOSE;

