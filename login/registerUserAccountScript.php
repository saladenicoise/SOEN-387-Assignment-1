<?php

    function test_input($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //Will generate a random 8 character password to be used as the default
    function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
    header_remove();
    $uname = "";
    $pword = "";
    $errorMessage = "";
    $isAdmin = 0;
    $dbEmail = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require_once('configure.php');
        $servername = DB_SERVER;
        $username = DB_USER;
        $password = DB_PASS;
        $dbname = DB_NAME;

        $uname = test_input($_POST['username']);
        $email = test_input($_POST['email']);
        $sid = test_input($_POST['id']);
        $fName = test_input($_POST['fName']);
        $lName = test_input($_POST['lName']);
        $address = test_input($_POST['address']);
        $phone = test_input($_POST['phone_number']);
        $dob = $_POST['dob'];
        
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if($conn) {
            $SQL = $conn->prepare("SELECT * FROM `useraccounts` WHERE email=?");
            ### Create both a user account with that email and a default password, plus a student account
            ### Admin accounts can only be created by DB admin
            $SQL->bind_param('s', $email);
            $SQL->execute();
            $SQL->store_result();
            $result = $SQL->num_rows;
            $SQL->close();
            if ($result > 0) {//Email already exists
                header('Location: ./registerUserAccount.php?stat=signupE');
                exit();
            } else {
                $SQL = $conn->prepare("SELECT * FROM `useraccounts` WHERE username=?");
                $SQL->bind_param('s', $uname);
                $SQL->execute();
                $SQL->store_result();
                $result = $SQL->num_rows;
                $SQL->close();
                if ($result > 0) {//User already exists
                    header('Location: ./registerUserAccount.php?stat=signupU');
                    exit();
                }
                $phash = randomPassword();
                // Creates a user account
                $SQL = $conn->prepare("INSERT INTO `useraccounts` (username, password, email, is_admin, default_password) VALUES (?, ?, ?, ?, ?)");
                $SQL_STUDENT = $conn->prepare("INSERT INTO `student` (id, first_name, last_name, address, email, phone_number, date_of_birth) VALUES (?, ?, ?, ?, ?, ?, ?)");
			    if (!$SQL || !$SQL_STUDENT) {
                    $errorMessage = "Prepare failed: (" . $conn->errno . ") " . $conn->error;
			    }
                else
                {
                    $isAdmin = 0;
                    $isDefault = 1;
                    //Insert into useraccounts
                    $SQL->bind_param('sssii', $uname, $phash, $email, $isAdmin, $isDefault);              
                    $SQL->execute();
                    $SQL->close();
                    //Insert into student table
                    $SQL_STUDENT->bind_param('sssssss', $sid, $fName, $lName, $address, $email, $phone, $dob);
                    $SQL_STUDENT->execute();
                    $SQL_STUDENT->close();
                    $conn->close();
                    $url = "\"localhost/SOEN_387_A1/login/changePassword.php?email=". base64_encode($email);
                    $mailMessage = "
                    <html>
                        <head>
                            <title>Password Reset Request</title>
                        </head>
                        <body>
                            <h2>Hello " . $fName . " " . $lName . "</h2>
                            <p>If you are receiving this message, it is because someone has created an account with your email and requires you to reset your password</p>
                            <p>Your current password is: ". $phash ." </p>
                            <p>To reset your password follow this link: <a href=" . $url . "target=\"_blank\">link</a></p>
                            <p>If you did not request this password reset, please ignore this email</p>
                            </br>
                            <p>Sincerely, the sentient server</p>
                        </body>
                    </html>
                    ";
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $to = $email;
                    $subject = "Password Change Request";
                    mail($to,$subject,$mailMessage,$headers);
                    header('Location: ./changePassword.php?email=' . base64_encode($email));
		 	    }
            }
        } else {
            header('Location: ./registerUserAccount.php?stat=singupD');
        }
    }
?>