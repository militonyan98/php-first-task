<?php
  session_start();

  $dataAvailable = true;
  if(!empty($_GET['id'])){
      $id = $_GET['id'];
    $connection=mysqli_connect('localhost', 'root', '', 'products');
    $dbConnect=mysqli_query($connection, "SELECT * FROM product WHERE product_id='$id'");
    $row = mysqli_fetch_assoc($dbConnect);
    
    if(empty($row['product_id'])){
        $dataAvailable = false;
    }
    else{
        $product_id = $row['product_id'];
        $product_name = $row['product_name'];
        $description = $row['description'];
        $price = $row['price'];
        $quantity = $row['quantity'];
    }
}
else{
    $dataAvailable = false;
}
?>
<?php
  var_dump($_SESSION)
  ?>
<!DOCTYPE HTML>  
<html>


    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!-- <title>Products</title> -->
    </head>


    <body>  
        <?php 
        if($dataAvailable){
        ?>
        <form class="form-group" method="post" action="logic.php">
            <div class="form-row align-items-center justify-content-center">
                <div class="col-auto">
                <h2 class="text-center text-primary">Edit Product Info:</h2><br>
                    <input type="hidden" value="<?= $product_id?>" name="product_id">
                    <input type="text" value="<?= $product_name?>" name="pName" class="form-control" placeholder="Product name">
                    <span class="error"><?= empty($_SESSION['pNameErr'])?"":"*".$_SESSION['pNameErr'];?></span>
                    <br><br>
                    <input type="text" value="<?= $description?>" name="description" class="form-control" placeholder="Description">
                    <span class="error"><?= empty($_SESSION['descriptionErr'])?"":"*".$_SESSION['descriptionErr'];?></span>
                    <br><br>
                    <input type="number" value="<?= $price?>" name="price" class="form-control" placeholder="Price">
                    <span class="error"><?= empty($_SESSION['priceErr'])?"":"*".$_SESSION['priceErr'];?></span>
                    <br><br>
                    <input type="number" value="<?= $quantity?>" name="quantity" class="form-control" placeholder="Quantity">
                    <span class="error"><?= empty($_SESSION['quantityErr'])?"":"*".$_SESSION['quantityErr'];?></span>
                    <br><br>
                    <button type="submit" name="submit" value="Submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>

    <?php
        }
        else{
            echo("No data found.");
        }
    session_unset();
    ?>

    </body>
</html>