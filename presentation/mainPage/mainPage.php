<?php

header_remove();
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
$replaceLogin = 0;
if(isset($_SESSION['login'])) {
    $replaceLogin = 1;
}
$isAdmin = 0;
if (isset($_SESSION["admin"]) && $_SESSION["admin"] == 1) {//Are we not admin? Yes -> Redirect, elese -> do nothing
    $isAdmin = 1;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/style.css?v=1.1">
    <link rel="stylesheet" href="../../styles/navBarStyle.css?version=1.1">
    <script src="../../business/js/printStat.js"></script>
    <script src="../../business/js/signup.js"></script>
    <title>Welcome, You are Logged In</title>
</head>

<?php
if(!$statusSet) : ?>
<body class="main">
<?php else : ?>
    <body onload="printStatus('<?php echo $statusVal;?>')" class="main">
<?php endif; ?>
    <ul class="navi">
        <li class="navBar"><a class="navbarElement" href="../../presentation/mainPage/mainPage.php">Main Page</a></li>
        <?php
        if($replaceLogin != 1) : ?>
        <li class="navBar" style="float: right;"><a class="navbarElement" href="../../presentation/login/login.php">Login</a></li>
        <?php else: ?>
        <li class="navBar" style="float: right;"><a class="navbarElement" href="../../business/login/logoutScript.php">Logout</a></li>
        <?php endif; ?>
    </ul>

<div class="button-center">
    <h1>Welcome <?php echo ($isAdmin == 1) ? "Admin" : "Student"; ?></h1>
    <?php
    if($isAdmin == 1) : ?>
        <button class="button-1" onclick="location.href='../../presentation/login/registerUserAccount.php'">Register New Student</button>
        <button class="button-1" onclick="location.href='../courses/createCourse.php'">Create Course</button>
        <button class="button-1" onclick="location.href='../../presentation/reportGeneration/report.php'">Generate Reports</button>
    <?php else: ?>
        <button class="button-1" onclick="location.href='../courses/addCourse.php'">Add Course</button>
        <button class="button-1" onclick="location.href='../courses/removeCourse.php'">Remove Course</button>
    <?php endif;?>
    <p class="status-message" id='statusBox'></p>
    </div>
</body>

</html>
