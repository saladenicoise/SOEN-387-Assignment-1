<?php
$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once('../../config/config.php');
    require_once(PATH_PW_UTILS);

    // Use extract method to set variables by default from post
    extract($_POST);

    // Format days appropriately for DB
    $number_of_days = count($_POST['days']);
    $days = "";
    $daysArray = $_POST['days'];
    for ($i = 0; $i < $number_of_days; $i++) {
        $days = $days . $daysArray[$i];
    }

    $conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($conn) {
        $SQL = $conn->prepare("INSERT INTO course (course_code,title,semester,days,time,instructor,room,start_date,end_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        if (!$SQL) {
            $errorMessage = "Prepare failed: (" . $conn->errno . ") " . $conn->error;
        } else {
            //Insert into useraccounts table
            $SQL->bind_param('sssssssss', $course_code, $title, $semester, $days, $time, $instructor, $room, $start_date, $end_date);
            $isSuccess = $SQL->execute();
            $SQL->close();
            if ($isSuccess) {
                header("Location: " . PATH_CREATE_COURSE . "?stat=createCourseS");
            } else {
                header("Location: " . PATH_CREATE_COURSE . "?stat=createCourseD");
            }
        }
    }
}
?>


// query Products database
if ( !( $result = mysqli_query( $database,$query) ) )
{
print( "Could not execute query! <br/>" );
die( mysqli_error() . "</body></html>" );
} // end if
else
{
print("Book was inserted into the Database correctly");
}

