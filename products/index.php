<?php
  session_start();
?>

<!DOCTYPE HTML>  
<html>


    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>


    <body style="margin: 20px; padding: 30px;">  
        <form class="form-group" method="post" action="logic.php" enctype="multipart/form-data">
            <div class="form-row align-items-center justify-content-center">
                <div class="col-auto">
                <h2 class="text-center text-primary">Enter Product Info:</h2><br>
                    <input type="text" name="pName" class="form-control" placeholder="Product name">
                    <span class="error"><?= empty($_SESSION['pNameErr'])?"":"*".$_SESSION['pNameErr'];?></span>
                    <br><br>
                    <input type="text" name="description" class="form-control" placeholder="Description">
                    <span class="error"><?= empty($_SESSION['descriptionErr'])?"":"*".$_SESSION['descriptionErr'];?></span>
                    <br><br>
                    <input type="number" min="0" name="price" class="form-control" placeholder="Price">
                    <span class="error"><?= empty($_SESSION['priceErr'])?"":"*".$_SESSION['priceErr'];?></span>
                    <br><br>
                    <input type="number" min="0" name="quantity" class="form-control" placeholder="Quantity">
                    <span class="error"><?= empty($_SESSION['quantityErr'])?"":"*".$_SESSION['quantityErr'];?></span>
                    <br><br>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="fileToUpload[]" id="fileToUpload" multiple>
                        <label class="custom-file-label">Choose file...</label>
                        <span class="error"><?= empty($_SESSION['imageErr'])?"":"*".$_SESSION['imageErr'];?></span>
                    </div>
                    <!-- <script type="text/javascript">
                        $('.custom-file-input').change(function (e) {
                            var files = [];
                            for (var i = 0; i < $(this)[0].files.length; i++) {
                                files.push($(this)[0].files[i].name);
                            }
                            $(this).next('.custom-file-label').html(files.join(', '));
                        });
                    </script> -->

                    <br></br>
                    <button type="submit" name="submit" value="Submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>

    <?php
    session_unset();
    ?>

    </body>
</html>