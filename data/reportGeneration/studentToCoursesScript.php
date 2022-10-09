<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once('../../config/config.php');
    require_once('../../business/login/passwordUtils.php');

    $conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $date = date('d-m-y-s');
    
    $id = test_input($_POST["sid"]);
    
    $file = "report_courseList". $date . "-". $id . ".txt";
    $txt = fopen($file, "w") or die("Unable to generate report file!");
    fwrite($txt, "Student with ID " . $id . " is registered for the following courses:\n");
    $SQL = $conn->prepare("SELECT course_code, semester FROM `registrar` WHERE id=?");
    $SQL->bind_param("s", $id);
    $SQL->execute();
    $result = $SQL->get_result(); //mysqli_result object
    $SQL->close();
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) { //For every course
        $SQL = $conn->prepare("SELECT * FROM `course` WHERE course_code=? AND semester=?");
        $SQL->bind_param("ss", $row["course_code"], $row["semester"]);
        $SQL->execute();
        $courseResult = $SQL->get_result();
        $course = $courseResult->fetch_array(MYSQLI_ASSOC);
        fwrite($txt, "Course Code: " . $course["course_code"] . " | Title: " . $course["title"] . " | Semester: " . $course["semester"] . " | Days: " . $course["days"] . " | Time: " . $course["time"] . " | Instructor: " . $course["instructor"] . " | Room: " . $course["room"] . " | Start Date: " . $course["start_date"] . " | End Date: " . $course["end_date"] . "\n");
        $SQL->close();
    }
    fclose($txt);
    $conn->close();
    // Downloads Report File
    header('Content-Description: File Transfer');
    header('Content-Disposition: attachment; filename='.basename($file));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    header("Content-Type: text/plain");
    readfile($file);
    unlink("report_courseList". $date .".txt");
}

?>