<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <link rel="stylesheet" href="../css/attend.css">
  <script type="module" src="../js/login_form.js"></script>
  <title>Attendance Login (Ashesi)</title>
</head> 
<body>
    <div id="title" class="title-box">
        <h1 id="title-text">Ashesi Web Development Attendance </h1>
    </div>
    <form id="loginForm" class="form-box">
        <label for="email">Enter your Email</label>
        <input type="text" id="email" name="email" placeholder="your email@ashesi">
        <button id="loginSubmit" name="u_login" type="submit" >Login</button>
        <div class="radio-box" id="form-errors"></div>
    </form>
</body>
</html>

