<?php

header_remove();
error_reporting(0);
session_start();

if (isset($_SESSION["login"]) && $_SESSION["login"] != 0) { // Checks if Session is up(user has logged in)
    $statusSet = isset($_GET['stat']);
    $statusVal = "";
    if($statusSet) {
        $statusVal = $_GET['stat'];
    }
} else {
    require_once('./config/config.php');
    header("location: ".PATH_LOGIN."?stat=login");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="../../business/js/printStat.js"></script>
    <script src="../../business/js/signup.js"></script>
    <title>Temp Logged in Page</title>
</head>

<body>
	<p>Temp Home Page</p>
    <p class="status-message" id='statusBox'></p>
    <button onclick="location.href='../../presentation/login/login.php'">Login Page</button>
    <button onclick="location.href='../../presentation/login/registerUserAccount.php'">Register Page</button>
    <button onclick="location.href='../../presentation/login/changePassword.php'">Change Password Page</button>
    <button onclick="location.href='../../business/login/logoutScript.php'">Logout</button>
</body>

</html>
