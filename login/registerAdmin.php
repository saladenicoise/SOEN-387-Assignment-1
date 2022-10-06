<?php

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
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="login.css">
    <title>Register User Account</title>
    <script src="../js/signup.js"></script>
    <script src="../js/printStat.js"></script>
</head>

<?php
if(!$statusSet) : ?>
<body class="login">
<?php else : ?>
    <body class="login" onload="printStatus('<?php echo $statusVal;?>')">
<?php endif; ?>
<div class="login-page">   
    <form name="signupForm" method="POST" action="registerAdminScript.php">
        <h1>Register Admin Account Page</h1>
        <input id="username" TYPE='text' Name='username' maxlength="20" placeholder="Username" required>
        <input id="email" type="email" name='email' placeholder="Email" required>
        <input id="password" type='password' name="password" placeholder="Password" required>
        <input id="id" type='text' name="id" placeholder="Employment ID" required>
        <input id="fName" type='text' name="fName" placeholder="First Name" required>
        <input id="lName" type='text' name="lName" placeholder="Last Name" required>
        <input id="address" type='text' name="address" placeholder="Address" required>
        <input pattern="(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}" id="phone_number" type='text' name="phone_number" placeholder="Phone Number ###-###-####" required>
        <input id="dob" type='date' name="dob" placeholder="Date of Birth" required>
        <input type="hidden" id="isAdmin" name="isAdmin" value="1">
        <input type="hidden" id="isDefault" name="isDefault" value="0">
        <p id="message"></p>
        <p class="status-message" id='statusBox'></p>
        <button class="sub-button" id="submit" type="submit">Submit</button>
        <button class="res-button" type="reset">Reset</button>
        <br>
        <a class="link" href="../index.html">Main Page</a>
    </form>
</did>
</body>

</html>