<?php

session_start();

$statusSet = isset($_GET['stat']);
$statusVal = "";
if($statusSet) {
    $statusVal = $_GET['stat'];
}
$emailB64 = isset($_GET['email']);
$emailVal = "";
if($emailB64) {
    $emailVal = base64_decode($_GET['email']);
}

if (isset($_SESSION["admin"]) && $_SESSION["admin"] != 0) { //If we're admin, redirect to main page
    require_once('../../config/config.php');
    header("Location: " . PATH_MAIN_PAGE . "?stat=notS");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/style.css?v=1.1">
    <link rel="stylesheet" href="../../styles/login.css">
    <title>Change User Default Password</title>
    <script src="../../business/js/signup.js"></script>
    <script src="../../business/js/printStat.js"></script>
</head>

<?php
if(!$statusSet) : ?>
<body class="login">
<?php else : ?>
    <body class="login" onload="printStatus('<?php echo $statusVal;?>')">
<?php endif; ?>

<div class="login-page">   
    <form name="changeDefaultPassword" method="POST" action="../../data/login/changePasswordScript.php">
        <h1>Change Default Password</h1>
        <label for="oldpassword"></label><input id="oldpassword" TYPE='password' Name='oldpassword' maxlength="16" placeholder="Old Password" required>
        <label for="password"></label><input class="password" id="password" TYPE='password' Name='password' maxlength="16" minlength="8" placeholder="Password" required>
        <label for="reConfirmPassword"></label><input class="top-margin" id="reConfirmPassword" TYPE='password'
                                                      Name='reConfirmPassword' maxlength="16" minlength="8" placeholder="Confirm" required oninput="checkPassword()">
        <p id="message"></p>
        <p class="status-message" id='statusBox'></p>
        <button class="sub-button" id="submit" type="submit">Submit</button>
        <button class="res-button" type="reset">Reset</button>
        <input type="hidden" id="email" name="email" value='<?php echo "$emailVal";?>'>
        <br>
        <a class="link" href="../../presentation/mainPage/mainPage.php">Main Page</a>
    </form>
</div>
</body>

</html>
