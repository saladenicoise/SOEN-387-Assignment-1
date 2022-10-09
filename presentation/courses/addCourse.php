<?php

session_start();

if (isset($_SESSION["admin"]) && $_SESSION["admin"] != 0) { //If we're admin, redirect to main page
    require_once('../../config/config.php');
    header("Location: " . PATH_MAIN_PAGE . "?stat=notL");
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

    <title>Add Course</title>
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
<body class="addCourse">
<?php else : ?>
<body class="addCourse" onload="printStatus('<?php echo $statusVal; ?>')">
<?php endif; ?>

<h2>Add Course</h2>
<form method="post" action="../../data/courses/addCourseScript.php">
    <div>
        <p>Student ID
            <label>
                <input name="id" type="number" size="10" placeholder="Student ID" required/>
            </label><br/></p>
        <p>Course Code
            <label>
                <input name="course_code" type="text" size="10" placeholder="Course Code" required/>
            </label><br/></p>
        <br/>
        <p>Semester
            <label for="semester"></label><select id="semester" name="semester" required>
                <option value="Fall">Fall</option>
                <option value="Winter">Winter</option>
                <option value="Summer">Summer</option>
            </select>
        </p>
        <br/>


        <input type="submit" value="Add Course"/>
        <p class="status-message" id='statusBox'></p>
    </div>
</form>
</body>
</html>
