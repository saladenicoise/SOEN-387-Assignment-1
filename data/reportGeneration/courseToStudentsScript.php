<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once('../../config/config.php');

    $conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $date = date('d-m-y-s');
    $file = "report_studentList". $date .".txt";
    $txt = fopen($file, "w") or die("Unable to generate report file!");

    $course = $_POST["courses"];
    $courseCode = substr($course, 0, strpos($course, "--"));
    $courseSemester = substr($course, strlen($courseCode)+2, strpos($course, ":")-(strlen($courseCode)+2));

    fwrite($txt, "The following students are registered for " . $course . ": \n");
    $SQL = $conn->prepare("SELECT id FROM `registrar` WHERE course_code=? AND semester=?");
    $SQL->bind_param("ss", $courseCode, $courseSemester);
    $SQL->execute();
    $result = $SQL->get_result(); //mysqli_result object
    $SQL->close();
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $SQL = $conn->prepare("SELECT * FROM `student` WHERE id=?");
        $SQL->bind_param("s", $row["id"]);
        $SQL->execute();
        $studentRes = $SQL->get_result();
        $student = $studentRes->fetch_array(MYSQLI_ASSOC);
        fwrite($txt, $student["id"] . " | Name: " . $student["first_name"] . " " . $student["last_name"] . " | Address: " . $student["address"] . " | Email: " . $student["email"] . " | Phone: " . $student["phone_number"] . " | Date Of Birth: " . $student["date_of_birth"] . "\n");
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
    unlink("report_studentList". $date .".txt");
}

?>