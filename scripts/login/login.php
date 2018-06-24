<?PHP session_start();
	if (isset($_SESSION['login']) && $_SESSION['login']) 
	{
		header('Location: ../account/my_account.php');
		exit();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../../css/header.css">
    <link rel="stylesheet" type="text/css" href="../../css/login.css">
</head>

<body background = "../../img/fundal2.jpg" >
    <?php
        include '../../header.php';
    ?>
<h2>Login</h2>

<form method = "post" action="verify_login.php">
  <div class="imgcontainer">
    <img src="../../img/login.jpg" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label for="mail"><b>Email</b></label>
    <input type="text" placeholder="Enter email" name="mail" required>

    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required >
        
    <button type="submit" >Login</button>

  </div>

  <div class="container">
    <button type="reset" value="Reset" class="cancelbtn">Cancel</button>
    <span class="psw"><a href="../password_reset/reset_password.php">Forgot password?</a></span>
  </div>

   <?php
        include "../../errors.php";
        error_connexion();
        delete_error_connexion();
    ?>
    
</form>

<?php include "../../footer.php";?>

</body>
</html>