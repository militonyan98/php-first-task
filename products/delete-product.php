<?php
include_once('db-connect.php');

if(empty($_GET["id"])){
    echo json_encode(["error" => true,  "msg" => "Wrong ID"]);
}
else{
    $id = $_GET["id"];
    $query = mysqli_query($connection, "DELETE FROM product WHERE product_id=$id");
    if($query){
        echo json_encode(["error" => false, "msg" => "Success"]);
    }
    else{
        echo json_encode(["error" => true,  "msg" => "sql error"]);
    }
}

?>