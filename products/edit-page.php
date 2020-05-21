<?php
  session_start();
  
  include_once("db-connect.php");

  $dataAvailable = true;
  if(!empty($_GET['id'])){
        $id = $_GET['id'];
        $dbConnect=mysqli_query($connection, "SELECT * FROM product WHERE product_id='$id'");
        $row = mysqli_fetch_assoc($dbConnect);
        $selectImage=mysqli_query($connection, "SELECT * FROM product_images WHERE product_id='$id' ORDER BY isAvatar desc");

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

<!DOCTYPE HTML>  
<html>


    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script>
            function deleteProduct(id){
                $.ajax( "delete-image.php?id="+id )
                    .done(function(response) {
                        if(!response.error){
                            $('#row'+id).remove();
                        }
                        else{
                            alert(response.msg);
                        }
                    })
                .fail(function() {
                    alert("Something went wrong.")
                });
            }
        </script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#fileToUpload').on("input",function () {
                    var files = [];
                    for (var i = 0; i < $(this)[0].files.length; i++) {
                        files.push($(this)[0].files[i].name);
                    }
                    $("#file-names").html(files.join(', <br>'));
                    });
                })
        </script>

        <script>
            function setAvatar(image_id, product_id){
                $.ajax("set-avatar.php?image_id="+image_id+"&product_id="+product_id)
                    .done(function(response) {
                        if(!response.error){
                            alert('success');
                        }
                        else{
                            alert(response.msg);
                        }
                    })
                .fail(function() {
                    alert("Something went wrong.")
                });
            }
        </script>
    </head>


    <body style="margin: 20px; padding: 30px;">  
        <?php 
        if($dataAvailable){
        ?>
        <form class="form-group" method="post" action="logic.php" enctype="multipart/form-data">
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
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="fileToUpload[]" id="fileToUpload" multiple>
                        <label class="custom-file-label">Choose file...</label>
                        <span class="error"><?= empty($_SESSION['imageErr'])?"":"*".$_SESSION['imageErr'];?></span>
                    </div>
                    <span id="file-names"></span>
                    <table class="table">
                    <?php while($image = mysqli_fetch_assoc($selectImage)){
                        ?>
                            <tr id="row<?= $image['image_id']; ?>">
                                <td>
                                    <div style="height: 200px; width: 200px">
                                        <img src="<?= $image['image_name']?>" class="img-thumbnail">
                                        <?php if($image['isAvatar']==false){ ?>
                                        <button type="button" id="deleteBtn" onClick="deleteProduct(<?= $image['image_id']; ?>)" class="btn btn-danger">Delete</button>
                                        <button type="button" class="btn btn-info" onClick="setAvatar(<?= $image['image_id']?>,<?= $image['product_id'];?>)">Set As Avatar</button>
                                        <?php } else { ?>
                                            <h5 class="alert alert-info">Current Avatar</h2>
                                        <?php } ?>
                                        </div>
                                </td>
                                <td></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </table>
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