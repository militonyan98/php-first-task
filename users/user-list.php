<?php

include_once("db-connect.php");
$query = mysqli_query($connection, "SELECT * FROM user");
?>

<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body style = "margin: 20px; padding: 30px;">
<div class="row">
        <div class="col-md-10"><h2 class="text-center" >User List</h2></div>
        <div class="col-md-2"><a href="index.php" class="btn btn-info">Back</a></div>
    </div>
    <table class="table table-hover">
    <thead class="thead-light">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Gender</th>
            <th>Email</th>
        
        </tr>
    </thead>
    <?php while($row = mysqli_fetch_assoc($query)){
        ?>
            <tr id="<?= $row ['user_id']; ?>">
                <td><?= $row ['user_id']; ?></td>
                <td> <?= $row ['f_name']; ?></td>
                <td> <?= $row ['l_name']; ?></td>
                <td><?= $row ['gender']; ?>	</td>	   				   				  
                <td> <?= $row ['email']; ?></td>
        </tr>
        <?php
    }
    ?>

    </table>
</body>