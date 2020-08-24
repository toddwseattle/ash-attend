<?php
include_once "../settings/core.php";
include_once "../view/header.php";
echoHeader("Attendance Login");
?>
<body>
    <div id="title" class="title-box">
        <h1 id="title-text">Ashesi Web Development Attendance Login</h1>
    </div>
    <form id="loginForm" action="../login/login_proc.php" method="post" class="form-box">
        <label for="email">Enter your Email</label>
        <input type="text" id="email" name="u_mail" placeholder="your email@ashesi">
        <label for="password">Password</label>
        <input type="password" id="password" name="u_pass">
        <button id="loginSubmit" type="submit" value="Submit">Submit</button>
    </form>
</body>

