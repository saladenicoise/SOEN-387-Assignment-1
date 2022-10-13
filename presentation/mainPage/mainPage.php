<?php

header_remove();
error_reporting(0);
session_start();

if (isset($_SESSION["login"]) && $_SESSION["login"] != 0) { // Checks if Session is up(user has logged in)
    $statusSet = isset($_GET['stat']);
    $statusVal = "";
    if($statusSet) {
        $statusVal = $_GET['stat'];
    }
} else {
    header("location: ../login/login.php?stat=login");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/style.css?version=1">
    <script src="../../business/js/printStat.js"></script>
    <script src="../../business/js/signup.js"></script>
    <title>Welcome, You are Logged In</title>
</head>

<?php
if(!$statusSet) : ?>
<body>
<?php else : ?>
    <body onload="printStatus('<?php echo $statusVal;?>')">
<?php endif; ?>
<p>Welcome, You are Logged In</p>
<p class="status-message" id='statusBox'></p>
<button onclick="location.href='../../presentation/login/changePassword.php'">Change Password</button>
<button onclick="location.href='../../business/login/logoutScript.php'">Logout</button>
<br><br>
<button onclick="location.href='../courses/createCourse.php'">Create Course (Admin)</button>
<button onclick="location.href='../../presentation/reportGeneration/report.php'">Generate Reports (Admin)</button>
<br><br>
<button onclick="location.href='../courses/addCourse.php'">Add Course (Student)</button>
<button onclick="location.href='../courses/removeCourse.php'">Remove Course (Student)</button>
</body>

</html>
