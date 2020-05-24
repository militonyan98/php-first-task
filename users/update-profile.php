<?php

session_start();
include_once('db-connect.php');

$imageErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    // if(is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])){

    // }
    $target_dir = "profile-pictures/";
    $target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
    $isUploaded=1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $target_file = $target_dir.basename((microtime(true)*10000).".".$imageFileType);
    if(isset($_POST["fileToUpload"])){
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check === false){
        $imageErr=$imageErr."File is not an image.";
        $isUploaded = 0;
        }
        else{
            $imageErr=$imageErr."File is an image.";
        }
    }
    if (file_exists($target_file)){
        $imageErr=$imageErr."Sorry, file already exists.";
        $isUploaded = 0;
    }
    if ($_FILES["fileToUpload"]["size"] > 200000){
        $imageErr=$imageErr."Sorry, your file is too large.";
        $isUploaded = 0;
    }
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif" ) {
        $imageErr=$imageErr."Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $isUploaded = 0;
    }

    if ($isUploaded == 0){
        $imageErr=$imageErr."Sorry, your file was not uploaded.";
    }
    else{
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          $errorMsg .= "uploaded file".$target_file;
          $target_id = $_SESSION['id'];
          $queryDelete = mysqli_query($connection, "DELETE FROM profile_picture WHERE `user_id`='$target_id'");
          $queryImg=mysqli_query($connection, "INSERT INTO profile_picture(image_name, `user_id`) values ('$target_file', '$target_id')");
          header("Location: profile.php");
            echo "The file ".basename($_FILES["fileToUpload"]["name"])." has been uploaded.";
        }
        else {
            $imageErr=$imageErr."Sorry, there was an error uploading your file.";
        }
    }
      
}