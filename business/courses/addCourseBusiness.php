<?php

function maxRegisteredCourses($result)
{
    if($result >= 5) { //Max number of registered courses reached
        require_once('../../config/config.php');
        header("Location: ".PATH_MAIN_PAGE."?stat=addCourseEM");
        exit();
    }
}

function addCourseDateCheck($conn, $course_code, $semester)
{
    $SQL = $conn->prepare("SELECT course_code, semester FROM `course` WHERE course_code=? AND semester=? AND CURDATE()<=DATE_ADD(start_date, INTERVAL 7 DAY)"); //Ensure CURDATE()<=start_date+7
    $SQL->bind_param('ss', $course_code, $semester);
    $SQL->execute();
    $SQL->store_result();
    $result = $SQL->num_rows;
    $SQL->close();
    if($result <= 0) { //CURDATE()>start_date+7
        header("Location: ".PATH_ADD_COURSE."?stat=addCourseL");
        exit();
    }
}

function removeCourseDateCheck($conn, $course_code, $semester)
{
    $SQL = $conn->prepare("SELECT course_code, semester FROM `course` WHERE course_code=? AND semester=? AND CURDATE()<=end_date"); //Ensure CURDATE()<=end_date
    $SQL->bind_param('ss', $course_code, $semester);
    $SQL->execute();
    $SQL->store_result();
    $result = $SQL->num_rows;
    $SQL->close();
    if($result <= 0) { //CURDATE()>end_date
        header("Location: ".PATH_REMOVE_COURSE."?stat=removeCourseL");
        exit();
    }
}

function getStartDate($semester)
{
    if ($semester == FALL_DB_NAME) {
        return FALL_START_DATE;
    } else if ($semester == WINTER_DB_NAME) {
        return WINTER_START_DATE;
    } else if ($semester == SUMMER_DB_NAME) {
        return SUMMER_START_DATE;
    }

    return ""; // Should normally not come here
}

function getEndDate($semester)
{
    if ($semester == FALL_DB_NAME) {
        return FALL_END_DATE;
    } else if ($semester == WINTER_DB_NAME) {
        return WINTER_END_DATE;
    } else if ($semester == SUMMER_DB_NAME) {
        return SUMMER_END_DATE;
    }

    return ""; // Should normally not come here
}