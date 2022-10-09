<?php
    function getAllCourses() {
        require_once('../../config/config.php');
        $conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if($conn)
        {
            $SQL = $conn->prepare("SELECT course_code, title, semester FROM `course`"); //Ensure user actually exists
            $SQL->execute();
            $courseArray = array();
            $result = $SQL->get_result(); //mysqli_result object
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                array_push($courseArray, $row["course_code"] . "--" . $row["semester"] . ": " . $row["title"]);
            }
            $SQL->close();
        }
        return $courseArray;
    }

?>