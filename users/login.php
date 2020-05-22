<?php
  session_start();
?>

<!DOCTYPE HTML>  
<html>

  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  </head>


  <body style="margin: 20px; padding: 30px;">  

  <div class="main-content">
      <form class="form-group" method="post" action="login-logic.php">
          <div class="form-row align-items-center justify-content-center">
              <div class="col-auto">
              <h2 class="text-center text-primary">Log In</h2><br>
                  <input type="text" name="email" class="form-control" placeholder="Email">
                  <span class="error"><?php echo empty($_SESSION['emailError'])?"":"*".$_SESSION['emailError'];?></span>
                  <br><br>
                  <input type="password" name="password" class="form-control" placeholder="Password">
                  <span class="error"><?php echo empty($_SESSION['passwordError'])?"":"*".$_SESSION['passwordError'];?></span>
                  <br><br>

                  <button type="submit" name="submit" value="Submit" class="btn btn-primary">Log In</button>
              </div>
          </div>
      </form>
  </div>

  <?php
  
  ?>

  </body>
</html>