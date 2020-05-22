<?php 

session_start();

include_once('db-connect.php');

$email = $emailError = $password = $passwordError = $errorMsg = "";
$valid=true;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST["email"])){
        $valid=false;
        $emailError = "Email is required";
    }
    else{
        $email = checkData($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Invalid email format";
        }
    }

    if(empty($_POST["password"])){
        $valid = false;
        $passwordError = "Password is required";
      }
    else{
        $password = $_POST["password"];
    }
}


$_SESSION['email'] = $email;
$_SESSION['password'] = $password;
$_SESSION['emailError'] = $emailError;
$_SESSION['passwordError'] = $passwordError;


if($valid){
    session_unset();
    $passwordHash = md5($password);
    $getUser = mysqli_query($connection, "SELECT `user_id`, `password` FROM user WHERE email = '$email'");
    echo mysqli_connect_error($connection);
    if($getUser){
        echo("in getUser if");
        $getUser = mysqli_fetch_assoc($getUser);
        if(empty($_SESSION['id'])){
            echo("session id is empty");
            if($passwordHash===$getUser['password']){
                echo("passwords match".'/n');
                echo($getUser['password'].'/n');
                echo($passwordHash);
                $_SESSION['id']=$getUser['user_id'];
                header('Location: profile.php');
            }
        }
        else{
            header('Location: profile.php');
        }
    }
    else{
        header('Location: error-page.php');
    }
}
else{
    header('Location: login.php');
}

function checkData($data) {
    global $connection;
    $data = mysqli_real_escape_string($connection, htmlspecialchars($data));
    return $data;
}