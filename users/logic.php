<?php
session_start();

include_once("db-connect.php");

$fname = $lname = $gender = $email = $emailErr = $password = $passwordConfirm = "";
$fnameErr = $lnameErr = $genderErr = $passwordErr = $passwordConfirmErr = "";
$errorMsg = "";
$valid = true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if(!isset($_POST["fname"])) {
    $valid = false;
    $fnameErr = "First name is required";
  } else {
    $fname = checkData($_POST["fname"]);
    if (!preg_match("/^[A-Za-z][A-Za-z\'\-]+([\ A-Za-z][A-Za-z\'\-]+)*/",$fname)) {
        $fnameErr = "Only letters and white space allowed";
      }
  }

  if(!isset($_POST["lname"])) {
    $valid = false;
    $lnameErr = "Last name is required";
  } else {
    $lname = checkData($_POST["lname"]);
    if (!preg_match("/^[A-Za-z][A-Za-z\'\-]+([\ A-Za-z][A-Za-z\'\-]+)*/",$lname)) {
        $lnameErr = "Only letters and white space allowed";
      }
  }

  if(!isset($_POST["gender"]) && $_POST["gender"]!="") {
    $valid = false;
    $genderErr = "Gender is required";
  } else {
    $gender = checkData($_POST["gender"]);
  }

  if(!isset($_POST["email"])) {
    $valid = false;
    $emailErr = "Email is required";
  } else {
    $email = checkData($_POST["email"]);
    $emailQuery = mysqli_query($connection, "SELECT email FROM user WHERE email='$email'");
    $emailQuery = mysqli_fetch_assoc($emailQuery);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) && empty($emailQuery['email'])) {
        $emailErr = "Invalid email format";
      }
  }

  if(!isset($_POST["password"])){
    $valid = false;
      $passwordErr = "Password is required";
  }
  else{
    $password = $_POST["password"];
  }

  if(!isset($_POST["passwordConfirm"])){
    $valid = false;
    $passwordConfirmErr = "Password confirmation is required";
  } 
  else{
    $passwordConfirm = $_POST["passwordConfirm"];
  }
  if(strcmp($passwordConfirm, $password)!==0){
    $valid=false;
        $passwordConfirmErr = "Passwords don't match";
  }

$_SESSION['fname'] = $fname;
$_SESSION['lname'] = $lname;
$_SESSION['gender'] = $gender;
$_SESSION['email'] = $email;
$_SESSION['fnameErr'] = $fnameErr;
$_SESSION['lnameErr'] = $lnameErr;
$_SESSION['genderErr'] = $genderErr;
$_SESSION['emailErr'] = $emailErr;
$_SESSION['passwordErr'] = $passwordErr;
$_SESSION['passwordConfirmErr'] = $passwordConfirmErr;



if($valid){

  $passwordHash = md5($password);
  $dbConnect=mysqli_query($connection, "INSERT INTO user (f_name, l_name, gender, email, `password`) VALUES('$fname', '$lname', $gender, '$email','$passwordHash')");
  $errorMsg = $errorMsg."performing query";
  if($dbConnect){
    $errorMsg = $errorMsg."query performed";
    header('Location: login.php');
  }
  else {
    $errorMsg = $errorMsg."query error performed"."\r\n".mysqli_error($connection);
    header('Location: error-page.php');
  };
}

else {
  header('Location: index.php');
}

$_SESSION['error'] = $errorMsg;

}

function checkData($data) {
  global $connection;
  $data = mysqli_real_escape_string($connection, htmlspecialchars($data));
  return $data;
}