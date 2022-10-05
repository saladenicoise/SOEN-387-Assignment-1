<?PHP
header_remove();
session_start();
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

$uname = "";
$pword = "";
$errorMessage = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    require_once('configure.php'); 
    $servername = DB_SERVER;
    $username = DB_USER;
    $password = DB_PASS;
    $dbname = DB_NAME;

        $uname = test_input($_POST['username']);
        $pword = $_POST['password'];

        $conn = new mysqli($servername, $username, $password, $dbname);
    
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $SQL = $conn->prepare("SELECT * FROM `useraccounts` WHERE username=?");
        $SQL->bind_param('s', $uname); //Binds the parameter $uname to the query
	    $SQL->execute(); //Executes the query
	    $SQL->store_result(); //Stores the results of the query
        $result = $SQL->num_rows; //Get the result of the query, the rows which return true aka 1 row where the uname was the same as the given username
        $SQL->close();
        if ($result === 1) { //Makes sure the user actually exists
            //Checks if default password, if so redirect them to changePass
            $SQL = $conn->prepare("SELECT default_password, email FROM `useraccounts` WHERE username=?");
            $SQL->bind_param('s', $uname);
            $SQL->execute();
            $SQL->store_result();
            $isDefault = 0;
            $email = "";
            $SQL->bind_result($isDefault, $email);
            if($isDefault === 1) {
                header('Location: ./changePassword.php?email='. base64_encode($email));
                exit();
            }
            $stmt = $conn->prepare("SELECT password, is_admin FROM `useraccounts` WHERE username=?");
            $stmt->bind_param('s', $uname);
            $stmt->execute();
            $stmt->store_result();
            $hash = "";
            $isAdmin = 0;
            $stmt->bind_result($hash, $isAdmin); //Gets the hash of the password, never the ACTUALL PASSWORD!!!!
            $fetchRes = $stmt->fetch();
            $stmt->close();
            if (password_verify($pword, $hash) && $fetchRes) { //Does the password match the hash of the password
                $_SESSION["login"] = "1";
                if ($isAdmin === 1) {
                    $_SESSION["admin"] = "1";
                }
                $errorMessage = "You have been logged in!";
                header('Location: ../mainPage/mainPage.php');
                exit();
            }else{
                $errorMessage = "Login FAILED";
                header('Location: ./login.php?stat=loginF');
                exit();
            }

        }else{
            $errorMessage = "Username or Password is invalid! Please try again!       ";
            header('Location: ./login.php?stat=loginF');
        }
}
?>