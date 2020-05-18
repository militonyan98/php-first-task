<?php
session_start();

include_once('db-connect.php');
include_once('upload.php');

$pName = $description = $price = $quantity = "";
$pNameErr = $descriptionErr = $priceErr = $qunatityErr = "";

$errorMsg = "";
$valid = true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["pName"])) {
        $valid = false;
        $pNameErr = "Product name is required";
    } else {
        $pName = checkData($_POST["pName"]);
    }

    $description = checkData($_POST["description"]);

    if (empty($_POST["price"])) {
        $valid = false;
        $priceErr = "Price is required";
    } else {
        $price = checkData($_POST["price"]);
        if (!preg_match("/^[0-9]*$/",$price)){
            $priceErr = "Only numbers allowed";
        }
    }

    if (empty($_POST["quantity"])) {
        $valid = false;
        $quantityErr = "Quantity is required";
    } else {
        $quantity = checkData($_POST["quantity"]);
        if (!preg_match("/^[0-9]*$/",$quantity)){
            $quantityErr = "Only numbers allowed";
        }
    }

    $_SESSION['pName'] = $pName;
    $_SESSION['description'] = $description;
    $_SESSION['price'] = $price;
    $_SESSION['quantity'] = $quantity;
    $_SESSION['pNameErr'] = $pNameErr;
    $_SESSION['descriptionErr'] = $descriptionErr;
    $_SESSION['priceErr'] = $priceErr;
    $_SESSION['quantityErr'] = $quantityErr;
    $_SESSION['imageErr'] = $imageErr;


if($valid && empty($imageErr)){
  if(empty($_POST['product_id'])){
    $dbConnect=mysqli_query($connection, "INSERT INTO product (product_name, `description`, price, quantity) VALUES('$pName', '$description', '$price', '$quantity')");
    if($dbConnect){
      $latestInsertedID=mysqli_insert_id($connection);
      for($i=0; $i<count($imageNames); $i++){
          $queryImg=mysqli_query($connection, "INSERT INTO product_images(image_name, product_id) values ('$imageNames[$i]', '$latestInsertedID')");
      }
    }
  }
  else{
    $product_id=$_POST['product_id'];
    $dbConnect=mysqli_query($connection, "UPDATE product SET product_name='$pName', `description`='$description', price='$price', quantity='$quantity' WHERE product_id='$product_id'");
  }
  $errorMsg = $errorMsg."Performing query";
  if($dbConnect && $queryImg){
    $errorMsg = $errorMsg."Query performed";
    header('Location: product-list.php');
  }
  else {
    $errorMsg = $errorMsg."query error performed"."\r\n".mysqli_error($connection);
    header('Location: error-page.php');
  };
}
else if(empty($_POST['product_id'])){
  header('Location: index.php');
}
else {
  header('Location: edit-page.php');
}

$_SESSION['error'] = $errorMsg;

}

function checkData($data) {
  global $connection;
  $data = mysqli_real_escape_string($connection, htmlspecialchars($data));
  return $data;
}