<?php

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

    <title>Add Course</title>
    <style type="text/css">
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
<body class="addCourse">
<?php else : ?>
<body class="addCourse" onload="printStatus('<?php echo $statusVal; ?>')">
<?php endif; ?>

<h2>Add Course</h2>
<form method="post" action="../../data/courses/addCourseScript.php">
    <div>
        <p>Course ID
            <input name="course_code" type="text" size="10" required/><br/></p>
        <p>Course Title
            <input name="title" type="text" size="40" required/>
        </p><br/>
        <p>Semester
            <select id="semester" name="semester" required>
                <option value="2">Fall</option>
                <option value="4">Winter</option>
                <option value="1">Summer</option>
            </select>
        </p>

        <p>Days of Course<br/>
            <select id="days" name="days[]" size="5" multiple="multiple" required>
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
            <input type="time" id="time" name="time" required>
        </p>

        <p>
            Instructor
            <input type="text" id="instructor" name="instructor" required>
        </p>
        <p>
            Room
            <input type="text" id="room" name="room" required>
        </p>
        <br/>
        <p>
            Start Date
            <input type="date" id="start_date" name="start_date" required>
            <br/>
            End Date
            <input type="date" id="end_date" name="end_date" required>
        </p>
        <br/>


        <input type="submit" value="Add Course"/>
        <p class="status-message" id='statusBox'></p>
    </div>
</form>
</body>
</html>
