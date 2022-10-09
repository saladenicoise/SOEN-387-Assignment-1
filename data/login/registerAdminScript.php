<?php
header_remove();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once('../../config/config.php');
    require_once(PATH_PW_UTILS);

    $uname = test_input($_POST['username']);
    $pword = $_POST['password'];
    $email = test_input($_POST['email']);
    $eid = test_input($_POST['id']);
    $fName = test_input($_POST['fName']);
    $lName = test_input($_POST['lName']);
    $address = test_input($_POST['address']);
    $phone = test_input($_POST['phone_number']);
    $dob = $_POST['dob'];
    $isAdmin = $_POST['isAdmin'];
    $isDefault = $_POST['isDefault'];

    $conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if($conn) {
        $SQL = $conn->prepare("INSERT INTO `useraccounts` (username, password, email, is_admin, default_password) VALUES (?, ?, ?, ?, ?)");
        $SQL_ADMIN = $conn->prepare("INSERT INTO `administrator` (employment_id, first_name, last_name, address, email, phone_number, date_of_birth) VALUES (?, ?, ?, ?, ?, ?, ?)");
        if (!$SQL || !$SQL_ADMIN) {
            $errorMessage = "Prepare failed: (" . $conn->errno . ") " . $conn->error;
        }
        else
        {
            //Insert into useraccounts table
            $phash = password_hash($pword, PASSWORD_BCRYPT, ['cost' => 12]);
            $SQL->bind_param('sssii', $uname, $phash, $email, $isAdmin, $isDefault);
            $SQL->execute();
            $SQL->close();
            //Insert into admin table
            $SQL_ADMIN->bind_param('issssss', $eid, $fName, $lName, $address, $email, $phone, $dob);
            $SQL_ADMIN->execute();
            $SQL_ADMIN->close();
            $conn->close();
            header("Location: ".PATH_LOGIN);
        }
    }
}
