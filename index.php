<?php
$replaceLogin = 0;
if(isset($_SESSION['login'])) {
    $replaceLogin = 1;
}
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css?version=1.1">
    <link rel="stylesheet" href="./styles/navBarStyle.css?version=1.1">
    <title>Please Log In</title>
</head>

<body class="main">
    <ul class="navi">
        <li class="navBar"><a class="navbarElement" href="./presentation/mainPage/mainPage.php">Main Page</a></li>
        <?php
        if($replaceLogin != 1) : ?>
        <li class="navBar" style="float: right;"><a class="navbarElement" href="./presentation/login/login.php">Login</a></li>
        <?php else: ?>
        <li class="navBar" style="float: right;"><a class="navbarElement" href="./business/login/logoutScript.php">Logout</a></li>
        <?php endif; ?>
    </ul>  
    <div class="center-screen">
        <h1>Welcome To The Registry System</h1>
        <div class="center-child">
            <p>Please log in to continue</p>
        </div>
    </div>
</body>

</html>
