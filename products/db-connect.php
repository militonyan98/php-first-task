<?php
$servername   = "localhost";
$database = "products";
$username = "root";
$db_password = "";

// Create connection
$connection = mysqli_connect($servername, $username, $db_password, $database);
// Check connection
if (mysqli_connect_errno()){
   die("Connection failed: " . mysqli_connect_error());
}