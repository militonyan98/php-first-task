<?php
  session_start();
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
        <form class="form-group" method="post" action="logic.php">
            <div class="form-row align-items-center justify-content-center">
                <div class="col-auto">
                <h2 class="text-center text-primary">Enter Product Info:</h2><br>
                    <input type="text" name="pName" class="form-control" placeholder="Product name">
                    <span class="error"><?= empty($_SESSION['pNameErr'])?"":"*".$_SESSION['pNameErr'];?></span>
                    <br><br>
                    <input type="text" name="description" class="form-control" placeholder="Description">
                    <span class="error"><?= empty($_SESSION['descriptionErr'])?"":"*".$_SESSION['descriptionErr'];?></span>
                    <br><br>
                    <input type="number" name="price" class="form-control" placeholder="Price">
                    <span class="error"><?= empty($_SESSION['priceErr'])?"":"*".$_SESSION['priceErr'];?></span>
                    <br><br>
                    <input type="number" name="quantity" class="form-control" placeholder="Quantity">
                    <span class="error"><?= empty($_SESSION['quantityErr'])?"":"*".$_SESSION['quantityErr'];?></span>
                    <br><br>
                    <button type="submit" name="submit" value="Submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>

    <?php
    session_unset();
    ?>

    </body>
</html>