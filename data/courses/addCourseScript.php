<?php

$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once('../../config/config.php');
    require_once(PATH_PW_UTILS);

    $id = test_input($_POST['id']);
    $courses = $_POST['courses'];

    $posOfSemesterDemark = strpos($courses, "--");
    $course_code = substr($courses, 0, $posOfSemesterDemark);
    $posOfTitleDemark = strpos($courses, ":");
    $semester = substr($courses, $posOfSemesterDemark+2, $posOfTitleDemark-($posOfSemesterDemark+2));
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

        // Business layer to check if CURDATE()<=start_date+7
        require_once('../../business/courses/addCourseBusiness.php');
        addCourseDateCheck($conn, $course_code, $semester);

        $SQL = $conn->prepare("SELECT course_code, id, semester FROM `registrar` WHERE course_code=? AND id=? AND semester=?"); //Ensure student isn't already signed up for this class
        $SQL->bind_param('sis', $course_code, $id, $semester);
        $SQL->execute();
        $SQL->store_result();
        $result = $SQL->num_rows;
        $SQL->close();
        if($result >= 1) { //Student is already signed up
            header("Location: ".PATH_ADD_COURSE."?stat=addCourseER");
            exit();
        }

        $SQL = $conn->prepare("SELECT id, semester FROM `registrar` WHERE id=? AND semester=?"); //Ensure max number of registered courses not reached
        $SQL->bind_param('is', $id, $semester);
        $SQL->execute();
        $SQL->store_result();
        $result = $SQL->num_rows;
        $SQL->close();

        // Business layer to check if max number of courses reached
        maxRegisteredCourses($result);

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
            header("Location: ".PATH_ADD_COURSE."?stat=addCourseS");
        }
    }
    else {
        header("Location: ".PATH_ADD_COURSE."?stat=addCourseD");
    }
}
