<?php

function addCourseBusiness($result)
{
    if($result >= 5) { //Max number of registered courses reached
        require_once('../../config/config.php');
        header("Location: ".PATH_MAIN_PAGE."?stat=addCourseEM");
        exit();
    }
}
