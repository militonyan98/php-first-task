<?php
$target_dir = "images/";
$countFiles = count($_FILES["fileToUpload"]["name"]);
$imageNames = [];
$imageErr = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    for($i=0; $i<$countFiles; $i++){
        $target_file = $target_dir.basename($_FILES["fileToUpload"]["name"][$i]);
        $isUploaded = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $target_file = $target_dir.basename((microtime(true)*10000).".".$imageFileType);
        if(isset($_POST["fileToUpload"])){
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"][$i]);
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
    
        if ($_FILES["fileToUpload"]["size"][$i] > 200000){
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
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file)) {
                array_push($imageNames, $target_file);
                echo "The file ".basename( $_FILES["fileToUpload"]["name"][$i])." has been uploaded.";
            }
            else {
                $imageErr=$imageErr."Sorry, there was an error uploading your file.";
            }
        }
    }
    
}