<?php

session_start();

if ($_SESSION["admin"] != 1) { //If we already logged in, and we're not admin, redirect to main page
    require_once('../../config/config.php');
    header("Location: " . PATH_MAIN_PAGE . "?stat=notA");
    exit();
}

$statusSet = isset($_GET['stat']);
$statusVal = "";
if ($statusSet) {
    $statusVal = $_GET['stat'];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../../styles/style.css">

    <title>Create Course</title>
    <style>
        body {
        }

        h2 {
            font-family: arial, sans-serif;
            color: blue
        }

        input {
            background-color: white;
            color: black;
            font-weight: bold
        }
    </style>
    <script src="../../business/js/printStat.js"></script>
</head>


<?php
if (!$statusSet) : ?>
<body class="createCourse">
<?php else : ?>
<body class="createCourse" onload="printStatus('<?php echo $statusVal; ?>')">
<?php endif; ?>

<h2>Create Course</h2>
<form method="post" action="../../data/courses/createCourseScript.php">
    <div>
        <p>Course Code
            <label>
                <input name="course_code" type="text" size="10" required/>
            </label><br/></p>
        <p>Course Title
            <label>
                <input name="title" type="text" size="40" required/>
            </label>
        </p><br/>
        <p>Semester
            <label for="semester"></label><select id="semester" name="semester" required>
                <option value="Fall">Fall</option>
                <option value="Winter">Winter</option>
                <option value="Summer">Summer</option>
            </select>
        </p>

        <p>Days of Course<br/>
            <label for="days"></label><select id="days" name="days[]" size="5" multiple="multiple" required>
                <option value="M">Monday</option>
                <option value="T">Tuesday</option>
                <option value="W">Wednesday</option>
                <option value="R">Thursday</option>
                <option value="F">Friday</option>
            </select>
        </p>
        <br/>

        <p>
            Time
            <label for="time"></label><input type="time" id="time" name="time" required>
        </p>

        <p>
            Instructor
            <label for="instructor"></label><input type="text" id="instructor" name="instructor" required>
        </p>
        <p>
            Room
            <label for="room"></label><input type="text" id="room" name="room" required>
        </p>
        <br/>
        <p>
            Start Date
            <label for="start_date"></label><input type="date" id="start_date" name="start_date" required>
            <br/>
            End Date
            <label for="end_date"></label><input type="date" id="end_date" name="end_date" required>
        </p>
        <br/>


        <input type="submit" value="Create Course"/>
        <p class="status-message" id='statusBox'></p>
    </div>
</form>
<br>
<hr>
<button onclick="location.href='../../presentation/mainPage/mainPage.php'">Main Page</button>
</body>
</html>
