<?php
include_once('db-connect.php');
session_start();

if(empty($_SESSION['id'])){
    header("Location: login.php");
}
if(isset($_SESSION['id'])){
    $id=$_SESSION['id'];
    $userInfo=mysqli_query($connection, "SELECT `user_id`, f_name, l_name, gender, email, avatar FROM user WHERE `user_id`=$id");
    if(!$userInfo)
        echo mysqli_error($connection);
    $userInfo=mysqli_fetch_assoc($userInfo);

    
}
//$_SESSION['id']=$userInfo['id']; 
?>


<!DOCTYPE html>
<html>    
    <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        
    </head>
    <body style="margin: 20px; padding: 30px;">  
        <div class="row">
        <div class="col-md-10"><h3>Personal Information | <?= $userInfo['f_name']." ".$userInfo['l_name']?></h3></div>
        <div class="col-md-2"><a href="logout.php" class="btn btn-info">Log Out</a></div>
        </div>
        <br></br>
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
                    <td><div style="width: 100px;"><img class="img-thumbnail" src="<?=$userInfo['avatar']?>"></div></td> 
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
