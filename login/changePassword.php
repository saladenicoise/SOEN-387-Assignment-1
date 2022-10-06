<?php
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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="login.css">
    <title>Change User Default Password</title>
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
    <form name="changeDefaultPassword" method="POST" action="changePasswordScript.php">
        <h1>Change Default Password</h1>
        <input id="oldpassword" TYPE='password' Name='oldpassword' maxlength="16" placeholder="Old Password" required>
        <input class="password" id="password" TYPE='password' Name='password' maxlength="16" minlength="8" placeholder="Password" required>
        <input class="top-margin" id="reConfirmPassword" TYPE='password' Name='reConfirmPassword' maxlength="16" minlength="8" placeholder="Confirm" required oninput="checkPassword()">
        <p id="message"></p>
        <p class="status-message" id='statusBox'></p>
        <button class="sub-button" id="submit" type="submit">Submit</button>
        <button class="res-button" type="reset">Reset</button>
        <input type="hidden" id="email" name="email" value='<?php echo "$emailVal";?>'>
        <br>
        <a class="link" href="../index.html">Main Page</a>
    </form>
</did>
</body>

</html>