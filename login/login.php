<?php
include_once "../view/header.php";
echoHeader("Attendance Login");
echo <<<__LOGIN
<body>
    <div id="title" class="title-box">
        <h1 id="title-text">Ashesi Web Development Attendance Login</h1>
    </div>
    <form id="loginForm" class="login-box">
        <label for "email">Enter your Email</label>
        <input type="text" id="email" name="email" placeholder="your email@ashesi">
        <button id="loginSubmit" type="submit" value="Submit">Submit</button>
    </form>
</body>
__LOGIN;

