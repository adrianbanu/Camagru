<?php
session_start();
if ($_SESSION['login'] == NULL || !($_SESSION['login']))
{
	echo "<meta http-equiv='refresh' content='0,url=../../index.php'>";
	exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Change password</title>
    <link rel="stylesheet" type="text/css" href="../../css/login.css">
    <link rel="stylesheet" type="text/css" href="../../css/header.css">
</head>

<body background = "../../img/fundal2.jpg" >
	<?php
	include '../../header.php';
	include '../../errors.php';
	?>
<h2>Change password</h2><br/>

<div class="container">

    <form method="post" action="check_change_password.php">
   
        <label for="old_pass">Old password:</label>
        <input type="password" name="old_pass" id="old_pass" required>        

        <label for="pass1">New password:</label>
        <input type="password" name="pass1" id="pass1" required>

        <label for="pass2">Re-enter new password:</label>
        <input type="password" name="pass2" id="pass2" required>

        <button type="submit" name="submit" value="Signup">Submit</button>

    </form><br/><br/>

</div>
	
<div class="container">	
    <?php
        error_change_password();
        if (isset($_SESSION['flag-password-changed']) && $_SESSION['flag-password-changed'] == "OK")
            echo "<meta http-equiv='refresh' content='0,url=my_account.php'>";
        delete_error_change_password();
    ?>

</div>	
	
</body>
<?php
    include '../../footer.php';
 ?>
</html>
