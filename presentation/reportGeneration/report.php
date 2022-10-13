<?php

header_remove();
#error_reporting(0);
session_start();
require_once('../../config/config.php');
require_once(PATH_REPORT_UTILS);
// Can only generate reports if the user is admin
if (isset($_SESSION["admin"]) && $_SESSION["admin"] != 0) { // Checks if user is admin (session loggin is true by default since it is generated at the same time as admin session token)
    $statusSet = isset($_GET['stat']);
    $statusVal = "";
    if($statusSet) {
        $statusVal = $_GET['stat'];
    }
} else {
    header("location: ../mainPage/mainPage.php?stat=notA");
    exit();
}

$replaceLogin = 0;
if(isset($_SESSION['login'])) {
    $replaceLogin = 1;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/style.css?v=1.1">
    <link rel="stylesheet" href="../../styles/login.css?v=1.1">
    <link rel="stylesheet" href="../../styles/navBarStyle.css?version=1.1">
    <script src="../../business/js/printStat.js"></script>
    <title>Generate Reports</title>
</head>
<?php
if(!$statusSet) : ?>
<body class="login">
<?php else : ?>
    <body onload="printStatus('<?php echo $statusVal;?>')" class="login">
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
    <div class="double-form-container">
        <div id="courseToStudents" class="login-style-page">
            <form name="courseToStudentsForm" method="POST" action="../../data/reportGeneration/courseToStudentsScript.php">
                <h2>All students taking a specified class</h2>
                <p>Will auto-download a file upon report generation completion</p>
                <p class="status-message" id='statusBox'></p>
                <label for="courses">Course:</label>
                <select id="courses" name="courses" required>
                    <?php
                        $courseList = getAllCourses(); //Returns a list of all the courses currently found in the database
                        foreach ($courseList as $course) { //Array row-by-row
                            echo "<option value='" . $course . "'>" . $course . "</option>";
                        }
                    ?>
                </select>
                <br><br>
                <button type="submit">Generate Report</button>
            </form>
        </div>
        <div id="studentToCourses" class="login-style-page">
            <form name="studentToCoursesForm" method="POST" action="../../data/reportGeneration/studentToCoursesScript.php">
                <h2> All courses taken by a student</h2>
                <p>Will auto-download a file upon report generation completion</p>
                <p class="status-message" id='statusBox'></p>
                <label for="sid">Student ID: </label><input id="sid" TYPE='text' Name='sid' placeholder="Student ID" required>
                <br><br>
                <button type="submit">Generate Report</button>
            </form>
        </div>
    </div>
</body>

</html>