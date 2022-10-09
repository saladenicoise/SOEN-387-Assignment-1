<?php

$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once('../../config/config.php');
    require_once(PATH_PW_UTILS);

    // Use extract method to set variables by default from post
    extract($_POST);

    $course_code = test_input($_POST['course_code']);
    $id = test_input($_POST['id']);
    $semester = test_input($_POST['semester']);

    $conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if($conn)
    {
        // TODO: Store id in session & remove this section (optional later)
        $SQL = $conn->prepare("SELECT id FROM `student` WHERE id=?"); //Ensure student actually exists
        $SQL->bind_param('i', $id);
        $SQL->execute();
        $SQL->store_result();
        $result = $SQL->num_rows;
        $SQL->close();
        if($result <= 0) { //Student does not exist
            header("Location: ".PATH_ADD_COURSE."?stat=addCourseES");
            exit();
        }

        $SQL = $conn->prepare("SELECT course_code, semester FROM `course` WHERE course_code=? AND semester=?"); //Ensure course actually exists
        $SQL->bind_param('ss', $course_code, $semester);
        $SQL->execute();
        $SQL->store_result();
        $result = $SQL->num_rows;
        $SQL->close();
        if($result <= 0) { //Course does not exist
            header("Location: ".PATH_ADD_COURSE."?stat=addCourseEC");
            exit();
        }

        $SQL = $conn->prepare("SELECT course_code, id, semester FROM `registrar` WHERE course_code=? AND id=? AND semester=?"); //Ensure registrar doesn't actually exists
        $SQL->bind_param('sis', $course_code, $id, $semester);
        $SQL->execute();
        $SQL->store_result();
        $result = $SQL->num_rows;
        $SQL->close();
        if($result >= 1) { //Registrar already exists
            header("Location: ".PATH_ADD_COURSE."?stat=addCourseER");
            exit();
        }

        $SQL = $conn->prepare("SELECT id FROM `registrar` WHERE id=?"); //Ensure max number of registered courses not reached
        $SQL->bind_param('i', $id);
        $SQL->execute();
        $SQL->store_result();
        $result = $SQL->num_rows;
        $SQL->close();

        // Business layer to check if max number of courses reached
        require_once('../../business/courses/addCourseBusiness.php');
        addCourseBusiness($result);

        $SQL = $conn->prepare("INSERT INTO `registrar` (course_code, id, semester) VALUES (?, ?, ?)");
        if (!$SQL) {
            $errorMessage = "Prepare failed: (" . $conn->errno . ") " . $conn->error;
        }
        else
        {
            //Insert into registrar
            $SQL->bind_param('sis', $course_code, $id, $semester);
            $SQL->execute();
            $SQL->close();
            $conn->close();
            header("Location: ".PATH_LOGIN."?stat=success");
        }
    }
    else {
        header("Location: ".PATH_ADD_COURSE."?stat=addCourseD");
    }
}
