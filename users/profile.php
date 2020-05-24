<?php
include_once('db-connect.php');
session_start();

if(isset($_SESSION['id'])){
    $id=$_SESSION['id'];
    $userInfo=mysqli_query($connection, "SELECT u.`user_id`, f_name, l_name, gender, email, image_name FROM user as u LEFT JOIN profile_picture as p on u.`user_id`=p.`user_id` WHERE u.`user_id`=$id");
    if(!$userInfo)
        echo mysqli_error($connection);
    $userInfo=mysqli_fetch_assoc($userInfo);
}

$_SESSION['user_id']=$userInfo['user_id'];
$_SESSION['first_name']=$userInfo['f_name'];
$_SESSION['last_name']=$userInfo['l_name'];
$_SESSION['gender']=$userInfo['gender'];
$_SESSION['email']=$userInfo['email'];

?>


<!DOCTYPE html>
<html>    
    <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        
    </head>
    <body style="margin: 20px; padding: 30px;">  
        <h3>Personal Information | <?= $userInfo['f_name']." ".$userInfo['l_name']?></h3>        
        <table class="table">
            <thead class="thead-light">
                <tr>
                   
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Avatar</th>
                    <th>Gender</th>
                    <th>Email</th>
                </tr>
                <?php if($userInfo){?>
                  
                    <td><?= $userInfo['f_name']; ?></td>
                    <td> <?= $userInfo['l_name']; ?></td>
                    <td><div style="width: 100px;"><img class="img-thumbnail" src="<?=$userInfo['image_name']?>"></div></td> 
                    <td> <?= $userInfo['gender']; ?></td>
                    <td><?= $userInfo['email']; ?></td>
                    
            <?php } ?>
            </thead>
        </table>
        <form class="form-group" method="post" action="update-profile.php" enctype="multipart/form-data">
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="fileToUpload" id="fileToUpload">
                <label class="custom-file-label">Choose Avatar...</label>
            </div>
            <br></br>
            <button type="submit" name="submit" value="Submit" class="btn btn-primary">Change Avatar</button>
        </form>
    </body>
</html> 