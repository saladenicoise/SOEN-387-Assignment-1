<?php
header_remove();
error_reporting(0);
session_start();
if (isset($_SESSION["login"]) && $_SESSION["login"] != 0) { // Checks if Session is up(user has logged in)
    header('Location: ../mainPage/mainPage.php');
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
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="login.css?v=1.1">
    <title>Login</title>
    <script src="../js/printStat.js"></script>
</head>

<?php
if(!$statusSet) : ?>
<body class="login">
<?php else : ?>
    <body class="login" onload="printStatus('<?php echo $statusVal;?>')">
<?php endif; ?>
<div class="login-page">    
    <form name="loginForm" method="POST" action="loginScript.php">
        <h1>Login</h1>
        <input id="username" TYPE='text' Name='username' maxlength="20" placeholder="Username" required>
        <input id="password" TYPE='password' Name='password' maxlength="16" minlength="8" placeholder="Password" required>
        <p class="status-message" id='statusBox'></p>
        <button class="sub-button" type="submit">Submit</button>
        <button class="res-button" type="reset">Reset</button>
        </br>
    <a class="link" href="../index.html">Main Page</a>
    </form>
</div>
</body>

</html>