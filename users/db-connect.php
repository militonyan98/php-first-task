<?php
$servername   = "localhost";
$database = "users";
$username = "root";
$db_password = "";

$connection = mysqli_connect($servername, $username, $db_password, $database);
if (mysqli_connect_errno()){
   die("Connection failed: " . mysqli_connect_error());
}