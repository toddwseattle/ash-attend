<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Attendance Sessions</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="module" src="../js/manage_sessions.js"></script>
  <link rel="stylesheet" href="../css/attend.css">
</head>
<body>
<form action="" class="form-box" id="gen-form">
    <div class="field-group" id="start-group">
        <label for="start">Monday of Start Week</label>
        <input type="date" name="start" id="start">
    </div>
    <div class="field-group" id="start-group">
        <label for="start">Class Start Time </label>
        <input type="time" name="classtime" id="classtime">
    </div>
    <div class="field-group" id="label-group">
        <label id="label-description" for="description">Class Name</label>
        <input type="text" name="description" id="description">
    </div>
    <div class="field-group">
        <label id="label-repeat" for="repeat">Class Length (Weeks)</label>
        <input type="number" name="repeat" id="repeat">
    </div>
    <div class="field-group" id="day-group">
    <div class="short-column">
        <p>Days:</p>
    </div>
    <div class="short-column">
            <label id="monday-label" for="Monday">Mon</label>
            <input type="checkbox" name="Monday" id="Monday"/>
            </div>
        <div class="short-column">
            <label id="tuesday-label" for="tuesday">Tues</label>
            <input type="checkbox" name="Tuesday" id="Tuesday"/>
        </div>
         <div class="short-column">
            <label id="wednesday-label" for="Wednesday">Wed</label>
            <input type="checkbox" name="Wednesday" id="Wednesday"/>
        </div>
        <div class="short-column">
            <label id="thursday-label" for="Thursday">Thur</label>
            <input type="checkbox" name="Thursday" id="Thursday"/>
            </div>
        <div class="short-column">
            <label id="friday-label" for="Friday">Fri</label>
            <input type="checkbox" name="Friday" id="Friday"/>
            </div>
    </div>
    <button type="button" id="generate">Generate Sessions</button>
    <div id="sessions-"></div>
    <div class="radio-box" style="display:none" id="form-errors"></div>
    <div  class="inner-form" style ="display:none" id="sessions-to-create">
        <!-- style ="display:none" -->
    <p>Now that you've generated class sessions, mark the ones you would like to keep</p>
    </div>
    <button type="submit" id="submit">Finalize Sessions</button>

</form>
</body>
</html>