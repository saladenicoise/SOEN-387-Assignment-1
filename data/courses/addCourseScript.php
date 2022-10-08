<?php
header_remove();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once('../../config/config.php');
    require_once(PATH_PW_UTILS);

    extract( $_POST );
    //$courseCode = test_input($_POST['courseCode']);
    //$title = test_input($_POST['title']);
    //$semester = test_input($_POST['semester']);

    $query="INSERT INTO course (course_code,title,semester,days,time,instructor,room,start_date,end_date)
        VALUES ('$course_code','$title','$semester','$days','$time','$instructor','$room','$start_date','$end_date')";

    print($query);

    $conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

     // Connect to MySQL
     if ( !( $database = mysqli_connect( "localhost", "root", "")))
        die( "Could not connect to database" );

    // open School database
    if ( !mysqli_select_db( $database ,"school" ) )
        die( "Could not open products database" );

     // query Products database
     if ( !( $result = mysqli_query( $database,$query) ) )
     {
        print( "Could not execute query!" );
        die( mysqli_error() . "" );
     }
    else
    {
        print("Course was inserted into the Database correctly");
    }

    mysqli_close( $database );
    }
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Search Results</title>
    <style type="text/css">
        body {
            font-family: arial, sans-serif;
            background-color: #F0E68C
        }

        table {
            background-color: #ADD8E6
        }

        td {
            padding-top: 2px;
            padding-bottom: 2px;
            padding-left: 4px;
            padding-right: 4px;
            border-width: 1px;
            border-style: inset
        }
    </style>
</head>
<body>
Test
</body>
</html>