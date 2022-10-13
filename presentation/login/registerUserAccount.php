<?php
session_start();

require_once('../../config/config.php');
if (isset($_SESSION["login"]) && $_SESSION["login"] == 1) { //If we already logged in, check for admin
    if (!isset($_SESSION["admin"]) && $_SESSION["admin"] != 1) {//Are we not admin? Yes -> Redirect, elese -> do nothing
        header("Location: ".PATH_MAIN_PAGE."?stat=notA");
        exit();
    }
}else{
    header("Location: ".PATH_INDEX."?stat=notL");
    exit();
}

$statusSet = isset($_GET['stat']);
$statusVal = "";
if ($statusSet) {
    $statusVal = $_GET['stat'];
}

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
    <link rel="stylesheet" href="../../styles/style.css?v=1.1">
    <link rel="stylesheet" href="../../styles/login.css">
    <link rel="stylesheet" href="../../styles/navBarStyle.css?version=1.1">
    <title>Register User Account</title>
    <script src="../../business/js/signup.js"></script>
    <script src="../../business/js/printStat.js"></script>
</head>

<?php
if(!$statusSet) : ?>
<body class="login">
<?php else : ?>
    <body class="login" onload="printStatus('<?php echo $statusVal;?>')">
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
<div class="login-style-page">   
    <form name="signupForm" method="POST" action="../../data/login/registerUserAccountScript.php">
        <h1>Register User Account Page</h1>
        <label for="username"></label><input id="username" TYPE='text' Name='username' maxlength="20" placeholder="Username" required>
        <label for="email"></label><input id="email" type="email" name='email' placeholder="Email" required>
        <label for="id"></label><input id="id" type='text' name="id" min=8 max=10 placeholder="Student ID" required>
        <label for="fName"></label><input id="fName" type='text' name="fName" placeholder="First Name" required>
        <label for="lName"></label><input id="lName" type='text' name="lName" placeholder="Last Name" required>
        <label for="address"></label><input id="address" type='text' name="address" placeholder="Address" required>
        <label for="phone_number"></label><input pattern="(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}"
                                                 id="phone_number" type='text' name="phone_number" placeholder="Phone Number ###-###-####" required>
        <label for="dob">Date Of Birth:</label><input id="dob" type='date' name="dob" placeholder="Date of Birth" required>
        <p>A default password will be automatically generated</p>
        <p id="message"></p>
        <p class="status-message" id='statusBox'></p>
        <button class="sub-button" id="submit" type="submit">Submit</button>
        <button class="res-button" type="reset">Reset</button>
        <br>
    </form>
</div>
</body>

</html>
