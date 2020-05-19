<?php
include_once('db-connect.php');

if(empty($_GET["id"])){
    echo json_encode(["error" => true,  "msg" => "Wrong ID"]);
    return;
}
else{
    $id = $_GET["id"];
    $query = mysqli_multi_query($connection, "DELETE FROM product WHERE product_id=$id; DELETE FROM product_images WHERE product_id=$id");
    if($query){
        echo json_encode(["error" => false, "msg" => "Success"]);
        return;
    }
    else{
        echo json_encode(["error" => true,  "msg" => "sql error".mysqli_error($connection)]);
        return;
    }
    return;
}

echo json_encode(["error" => true,  "msg" => "unknown error"]);

?>