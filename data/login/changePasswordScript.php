<?php

header_remove();
$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once('../../config/config.php');
    require_once(PATH_PW_UTILS);

    $oldPassword = test_input($_POST['oldpassword']);
    $newPassword = password_hash($_POST['password'], PASSWORD_BCRYPT, ['cost' => 12]);
    $email = test_input($_POST['email']);
    echo $email;

    $conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if($conn)
    {
        $SQL = $conn->prepare("SELECT * FROM `useraccounts` WHERE email=?"); //Ensure user actually exists
        $SQL->bind_param('s', $email);
        $SQL->execute();
        $SQL->store_result();
        $result = $SQL->num_rows;
        $SQL->close();
        if($result <= 0) { //Email does not exist
            header("Location: ".PATH_CHANGE_PW_SCRIPT."?stat=changePassE");
            exit();
        }
        $SQL = $conn->prepare("UPDATE `useraccounts` SET password=? WHERE email=?");
        $SQL->bind_param("ss", $newPassword, $email);
        $SQL->execute();
        $SQL = $conn->prepare("UPDATE `useraccounts` SET default_password=? WHERE email=?");
        $isDefault=0;
        $SQL->bind_param("is", $isDefault, $email);
        $SQL->execute();
        $SQL->close();
        $conn->close();
        header("Location: ".PATH_LOGIN."?stat=changePassS");
    }
    else 
    {
        $conn->close();
        header("Location: ".PATH_CHANGE_PW."?stat=changePassD&email=" . base64_encode($email));
    }
}
