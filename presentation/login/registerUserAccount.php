<?php
session_start();

if (isset($_SESSION["admin"]) && $_SESSION["admin"] != 0) { //If we already logged in, redirect to main page
    require_once('../../config/config.php');
    header("Location: ".PATH_MAIN_PAGE."?stat=notA");
    exit();
}

$statusSet = isset($_GET['stat']);
$statusVal = "";
if($statusSet) {
    $statusVal = $_GET['stat'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/style.css">
    <link rel="stylesheet" href="../../styles/login.css">
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
<div class="login-page">   
    <form name="signupForm" method="POST" action="../../data/login/registerUserAccountScript.php">
        <h1>Register User Account Page</h1>
        <label for="username"></label><input id="username" TYPE='text' Name='username' maxlength="20" placeholder="Username" required>
        <label for="email"></label><input id="email" type="email" name='email' placeholder="Email" required>
        <label for="id"></label><input id="id" type='number' name="id" placeholder="Student ID" required>
        <label for="fName"></label><input id="fName" type='text' name="fName" placeholder="First Name" required>
        <label for="lName"></label><input id="lName" type='text' name="lName" placeholder="Last Name" required>
        <label for="address"></label><input id="address" type='text' name="address" placeholder="Address" required>
        <label for="phone_number"></label><input pattern="(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}"
                                                 id="phone_number" type='text' name="phone_number" placeholder="Phone Number ###-###-####" required>
        <label for="dob"></label><input id="dob" type='date' name="dob" placeholder="Date of Birth" required>
        <p>A default password will be automatically generated</p>
        <p id="message"></p>
        <p class="status-message" id='statusBox'></p>
        <button class="sub-button" id="submit" type="submit">Submit</button>
        <button class="res-button" type="reset">Reset</button>
        <br>
        <a class="link" href="../../index.html">Main Page</a>
    </form>
</div>
</body>

</html>
