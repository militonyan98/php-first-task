<?php
include_once('db-connect.php');
  
    if(!empty($_GET['image_id'])&&!empty($_GET['product_id'])){
        $product_id = $_GET['product_id'];
        $image_id = $_GET['image_id'];
        $productQuery = mysqli_query($connection, "UPDATE product_images SET isAvatar=0 WHERE product_id=$product_id;");
        $avatarQuery = mysqli_query($connection, "UPDATE product_images SET isAvatar=1 WHERE image_id=$image_id");
        if($productQuery && $avatarQuery){
            echo json_encode(["error" => false, "msg" => "Success"]);
            return;
        }
        else{
            echo json_encode(["error" => true,  "msg" => "sql error".mysqli_error($connection)]);
            return;
        }
    }
    else{
        echo json_encode(["error" => true,  "msg" => "Wrong ID"]);
        return;
    }

    echo json_encode(["error" => true,  "msg" => "unknown error"]);

?>