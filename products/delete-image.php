<?php
include_once('db-connect.php');

if(empty($_GET["id"])){
    echo json_encode(["error" => true,  "msg" => "Wrong ID"]);
}
else{
    $id = $_GET["id"];
    $imageName=mysqli_query($connection, "SELECT image_name FROM product_images WHERE image_id=$id");
    $imageName=mysqli_fetch_assoc($imageName)['image_name'];
    if(file_exists($imageName)){
        unlink($imageName);
    }
    $deleteImageQuery = mysqli_query($connection, "DELETE FROM product_images WHERE image_id=$id");
    if($deleteImageQuery){
        echo json_encode(["error" => false, "msg" => "Success"]);
    }
    else{
        echo json_encode(["error" => true,  "msg" => "sql error"]);
    }
}

?>