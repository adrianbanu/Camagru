<?PHP session_start();
	if (isset($_SESSION['id']) && $_SESSION['id'])
	{
		header('Location: ../account/my_account.php');
		exit();
	}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign up</title>
    <link rel="stylesheet" type="text/css" href="../../css/header.css">
    <link rel="stylesheet" type="text/css" href="../../css/login.css">
</head>

<body background = "../../img/fundal2.jpg" >
<?php
   include '../../header.php';
?>

<h2>Sign up</h2><br/>

<form method="post" action="verify_signup.php">
   
    <div class="imgcontainer">
        <img src="../../img/login.jpg" alt="Avatar" class="avatar">
    </div>

    <div class="container">

        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter username" name="uname" required>           

        <label for="mail"><b>Email</b></label>
        <input type="text" placeholder="Enter email" name="mail" required>

        <label for="password1"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password1" required>

        <label for="password2"><b>Repeat password</b></label>
        <input type="password" placeholder="Re-enter Password" name="password2" required>

        <button type="submit" name="submit" value="Signup">Signup</button>

    </div>

    <div class="container">
        <button type="reset" value="Reset" class="cancelbtn " style="margin:0 auto; display:block ;">Cancel</button>
    </div>
    
</form><br/><br/>

<div class="container">
    <?PHP
        include "../../errors.php";
        error_inscription();
        delete_error_inscription();

    ?>
</div>

</body>

<?php
    include '../../footer.php';
?>

</html>