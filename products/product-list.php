<?php
include_once('db-connect.php');
$query = mysqli_query($connection, "SELECT * FROM product");
?>
<head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <title>Products</title>
        <script>
            function deleteProduct(id){
                $.ajax("delete-product.php?id="+id)
                    .done(function(response){
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
</head>
<body style = "margin: 20px; padding: 30px;">
    <div class="row">
        <div class="col-md-10"><h2 class="text-center" >Product List</h2></div>
        <div class="col-md-2"><a href="index.php" class="btn btn-info">Add Product</a></div>
    </div>
    <table class="table">
    <thead class="thead-light">
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Edit</th>
            <th>Delete</th>
        
        </tr>
    </thead>
    <?php while($row = mysqli_fetch_assoc($query)){
        ?>
            <tr id="row<?= $row ['product_id']; ?>">
                <td><?= $row ['product_id']; ?></td>
                <td> <?= $row ['product_name']; ?></td>
                <td> <?= $row ['description']; ?></td>
                <td><?= $row ['price']; ?>	</td>	   				   				  
                <td> <?= $row ['quantity']; ?></td>
                <td><a href="edit-page.php?id=<?= $row['product_id']?>" class="btn btn-secondary">Edit</a></td>
                <td><button id="deleteBtn" onclick="deleteProduct(<?= $row ['product_id']; ?>)" class="btn btn-danger">Delete</button> </td>
        </tr>
        <?php
    }
    ?>

    </table>
</body>