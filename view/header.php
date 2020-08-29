
<?php function echoHeader($title = "Ashesi Class Attendance", $scripts = [])
{
  echo <<<__HEAD
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1024, initial-scale=1.0">
    <link rel="stylesheet" href="../css/attend.css">
__HEAD;
  echo "\n<title>" . $title . "</title>\n";
  foreach ($scripts as $s) {
    echo "<script src=\"" . $s . "\"></script>\n";
  }

  echo "</head>";
} ?>


