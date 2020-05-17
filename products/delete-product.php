<?php
include_once('db-connect.php');

if(empty($_GET["id"]))
{

}
else
{
    $id = $_GET["id"];
    $query = mysqli_query($connection, "DELETE FROM product WHERE product_id=$id");
}

?>