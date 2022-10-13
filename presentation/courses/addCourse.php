<?php

session_start();

require_once('../../config/config.php');
if (isset($_SESSION["admin"]) && $_SESSION["admin"] != 0) { //If we're admin, redirect to main page
    header("Location: " . PATH_MAIN_PAGE . "?stat=notS");
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
require_once(PATH_REPORT_UTILS);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../../styles/style.css?v=1.1">
    <link rel="stylesheet" href="../../styles/login.css?v=1.1">
    <link rel="stylesheet" href="../../styles/navBarStyle.css?version=1.1">
    <title>Add Course</title>
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
    <form method="post" action="../../data/courses/addCourseScript.php">
        <h2>Add Course</h2>
        <input id="id" name="id" type="number" min="8" size="10" placeholder="Student ID" required/>
        <label for="id"></label><select id="courses" name="courses" required>
            <option value="" disabled selected>Course</option>
            <?php
                $courseList = getAllCourses(); //Returns a list of all the courses currently found in the database
                foreach ($courseList as $course) { //Array row-by-row
                    echo "<option value='" . $course . "'>" . $course . "</option>";
                }
            ?>
        </select>
        <label for="semester"></label><select id="semester" name="semester" required>
            <option value="" disabled selected>Semester</option>
            <option value="Fall">Fall</option>
            <option value="Winter">Winter</option>
            <option value="Summer">Summer</option>
        </select>
        <p class="status-message" id='statusBox'></p>
        <button class="sub-button" type="submit">Submit</button>
        <button class="res-button" type="reset">Reset</button>
        <br> <!-- Padding -->
    </div>
</form>
</body>
</html>
