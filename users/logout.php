<?php
session_start();
session_unset();
if(empty($_SESSION['id'])){
    header("Location: login.php");
}