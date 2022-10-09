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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="../../business/js/printStat.js"></script>
    <title>Generate Reports</title>
</head>

<body>
    <div id="courseToStudents">
        <h2>Report: All students taking a specified class</h2>
        <form name="courseToStudentsForm" method="POST" action="../../data/reportGeneration/courseToStudentsScript.php">
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
            <br>
            <button type="submit">Generate Report</button>
        </form>
    </div>
    <hr>
    <div id="studentToCourses">
        <h2>Report: All courses taken by a student</h2>
        <form name="studentToCoursesForm" method="POST" action="../../data/reportGeneration/studentToCoursesScript.php">
            <p class="status-message" id='statusBox'></p>
            <label for="sid">Student ID: </label><input id="sid" TYPE='text' Name='sid' placeholder="SudentID" required>
            <br>
            <button type="submit">Generate Report</button>
        </form>
    </div>
    <br>
    <hr>
    <button onclick="location.href='../../presentation/mainPage/mainPage.php'">Main Page</button>
</body>

</html>