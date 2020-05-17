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
  </head>


  <body style="margin: 20px; padding: 30px;">  

  <div class="main-content">
      <form class="form-group" method="post" action="logic.php">
          <div class="form-row align-items-center justify-content-center">
              <div class="col-auto">
              <h2 class="text-center text-primary">Enter Your Info:</h2><br>
                  <input type="text" name="fname" class="form-control" placeholder="First name">
                  <span class="error"><?php echo empty($_SESSION['fnameErr'])?"":"*".$_SESSION['fnameErr'];?></span>
                  <br><br>
                  <input type="text" name="lname" class="form-control" placeholder="Last name">
                  <span class="error"><?php echo empty($_SESSION['lnameErr'])?"":"*".$_SESSION['lnameErr'];?></span>
                  <br><br>
                  <select class="custom-select my-1 mr-sm-2" value="gender" name="gender">
                      <option value="0" selected>Gender</option>
                      <option value="Female">Female</option>
                      <option value="Male">Male</option>
                      <option value="Other">Other</option>
                  </select>
                  <span class="error"><?php echo empty($_SESSION['genderErr'])?"":"*".$_SESSION['genderErr'];?></span>
                  <br><br>
                  <input type="text" name="email" class="form-control" placeholder="Email">
                  <span class="error"><?php echo empty($_SESSION['emailErr'])?"":"*".$_SESSION['emailErr'];?></span>
                  <br><br>
                  <input type="password" name="password" class="form-control" placeholder="Password">
                  <span class="error"><?php echo empty($_SESSION['passwordErr'])?"":"*".$_SESSION['passwordErr'];?></span>
                  <br><br>
                  <input type="password" name="passwordConfirm" class="form-control" placeholder="Password Confirmation">
                  <span class="error"><?php echo empty($_SESSION['passwordConfirmErr'])?"":"*".$_SESSION['passwordConfirmErr'];?></span>
                  <br><br>

                  <button type="submit" name="submit" value="Submit" class="btn btn-primary">Submit</button>
              </div>
          </div>
      </form>
  </div>

  <?php
  session_unset();
  ?>

  </body>
</html>