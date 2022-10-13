<?php

session_start();
require_once('../../config/config.php');
if ($_SESSION["admin"] != 1) { //If we already logged in, and we're not admin, redirect to main page
    header("Location: " . PATH_MAIN_PAGE . "?stat=notA");
    exit();
}

$statusSet = isset($_GET['stat']);
$statusVal = "";
if ($statusSet) {
    $statusVal = $_GET['stat'];
}

$replaceLogin = 0;
if(isset($_SESSION['login'])) {
    $replaceLogin = 1;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../../styles/style.css?v=1.1">
    <link rel="stylesheet" href="../../styles/login.css?v=1.1">
    <link rel="stylesheet" href="../../styles/navBarStyle.css?version=1.1">
    <title>Create Course</title>
    <script src="../../business/js/printStat.js"></script>
</head>


<?php
if (!$statusSet) : ?>
<body class="login">
<?php else : ?>
<body class="login" onload="printStatus('<?php echo $statusVal; ?>')">
<?php endif; ?>
    <ul class="navi">
        <li class="navBar"><a class="navbarElement" href="../../presentation/mainPage/mainPage.php">Main Page</a></li>
        <?php
        if($replaceLogin != 1) : ?>
        <li class="navBar" style="float: right;"><a class="navbarElement" href="../../presentation/login/login.php">Login</a></li>
        <?php else: ?>
        <li class="navBar" style="float: right;"><a class="navbarElement" href="../../business/login/logoutScript.php">Logout</a></li>
        <?php endif; ?>
    </ul>
    <div class="login-style-page">
    <form method="post" action="../../data/courses/createCourseScript.php">
        <h1>Create Course</h1>
        <label for="course_code"></label><input id="course_code" name="course_code" type="text" size="10" pattern="([A-Z]{4})+(-){1}([0-9]){3,4}" placeholder="Course Code (TEXT-###)"required/>
        <label for="title"></label><input id="title" name="title" type="text" size="40" required placeholder="Course Title"/>
        <label for="semester"></label><select id="semester" name="semester" required>
            <option value="" disabled selected>Semester</option>
            <option value="Fall">Fall</option>
            <option value="Winter">Winter</option>
            <option value="Summer">Summer</option>
        </select>
        <label for="days"></label><select id="days" name="days[]" size="6" multiple="multiple" required>
            <option value="" disabled selected>Days of Course</option>
            <option value="M">Monday</option>
            <option value="T">Tuesday</option>
            <option value="W">Wednesday</option>
            <option value="R">Thursday</option>
            <option value="F">Friday</option>
        </select>
        <label for="time"></label><input type="time" id="time" name="time" value="08:45"required>
        <label for="instructor"></label><input type="text" id="instructor" name="instructor" placeholder="Instructor" required>
        <label for="room"></label><input type="text" id="room" name="room"  placeholder="Room" required>
        <p class="status-message" id='statusBox'></p>
        <button class="sub-button" type="submit">Submit</button>
        <button class="res-button" type="reset">Reset</button>
        <br>
    </form>
</div>
</body>
</html>
