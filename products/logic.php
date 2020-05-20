<?php
session_start();

include_once('db-connect.php');
//include_once('upload.php');

$pName = $description = $price = $quantity = "";
$pNameErr = $descriptionErr = $priceErr = $quantityErr = $imgErr = "";
$errorMsg = "";
$target_dir = "images/";
$countFiles = count($_FILES["fileToUpload"]["name"]);
$imageNames = [];
$imageErr = "";
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



if($valid){
  $target_id = "";
  if(empty($_POST['product_id'])){
    $dbConnect=mysqli_query($connection, "INSERT INTO product (product_name, `description`, price, quantity) VALUES('$pName', '$description', '$price', '$quantity')");
    if($dbConnect){
      $target_id=mysqli_insert_id($connection);

    }
  }
  else{
    $product_id=$_POST['product_id'];
    $dbConnect=mysqli_query($connection, "UPDATE product SET product_name='$pName', `description`='$description', price='$price', quantity='$quantity' WHERE product_id='$product_id'");
    if($dbConnect){
      $target_id=$product_id;
    }
  }
  $errorMsg = $errorMsg."Performing query";
  if($dbConnect){
    $errorMsg = $errorMsg."Query performed";
    header('Location: product-list.php');
  }
  else {
    $errorMsg = $errorMsg."query error performed"."\r\n".mysqli_error($connection);
    header('Location: error-page.php');
  }
  $errorMsg .= "count".$countFiles;

  $uploadedFile = 0;

  for($i=0; $i<$countFiles; $i++){
    echo ("in for loop");
    if(!is_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i])){
      continue;
    }
    $target_file = $target_dir.basename($_FILES["fileToUpload"]["name"][$i]);
    $isUploaded = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $target_file = $target_dir.basename((microtime(true)*10000).".".$imageFileType);
    if(isset($_POST["fileToUpload"])){
        echo("fileUpload is set");
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
          $uploadedFile ++;
          $errorMsg .= "uploaded file".$target_file;
          $queryImg=mysqli_query($connection, "INSERT INTO product_images(image_name, product_id) values ('$target_file', '$target_id')");
            echo "The file ".basename( $_FILES["fileToUpload"]["name"][$i])." has been uploaded.";
        }
        else {
            $imageErr=$imageErr."Sorry, there was an error uploading your file.";
        }
    }
    
}
  if(($queryImg || $uploadedFile==0) && empty($imageErr)){
    $errorMsg = $errorMsg."Query performed";
    header('Location: product-list.php');
  }
  else if(!empty($imageErr)){
    if(empty($_POST['product_id'])){
      header('Location: index.php');
    }
    else {
      header('Location: edit-page.php?id='.$target_id);
    }
  }
  else {
    $errorMsg = $errorMsg."query error performed"."\r\n".mysqli_error($connection).$target_id;
    header('Location: error-page.php');
  }
}
else if(empty($_POST['product_id'])){
  header('Location: index.php');
}
else {
  header('Location: edit-page.php?id='.$target_id);
}

$_SESSION['error'] = $errorMsg;
$_SESSION['imageErr'] = $imageErr;

}

function checkData($data) {
  global $connection;
  $data = mysqli_real_escape_string($connection, htmlspecialchars($data));
  return $data;
}