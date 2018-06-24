<?PHP session_start();?>
<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" type="text/css" href="../../css/global.css">
    <link rel="stylesheet" type="text/css" href="../../css/header.css">


    <title>Password reset</title>
</head>

<body background = "../../img/fundal2.jpg" >
	<?php
	include '../../header.php';
	$token = $_GET['token'];
	?>
	<div  id="text_home">
		Create a new password<br/><br/>

		<form method="post" action="reset_my_password_check.php">
			Email : <br/>
			<input type="text" name="mail" required
			<?PHP if ($_SESSION['flag-mail-exists-reset-my-password'] == "KO")
			{echo "class='invalid'";}?>><br/><br/>
			
			New password : <br/>
			<input type="password" name="password1" required
			<?PHP if ($_SESSION['reset-password1'] == "KO" ||
			$_SESSION['reset-flag-regex-password'] == "KO")
			{echo "class='invalid'";}?>><br/><br/>
			
			Re-enter new password : <br/>
			<input type="password" name="password2" required
			<?PHP if ($_SESSION['reset-password2'] == "KO" ||
			$_SESSION['reset-same-password'] == "KO")
			{echo "class='invalid'";}?>><br/><br/>
			<input type="hidden" name="token" value="<?PHP echo $token;?>"> 
			<input type="submit" name="submit" value="Submit"/><br/><br/>
		</form><br/><br/>

		<?PHP
            include "../../errors.php";
            error_reset_password();
            if ($_SESSION['reinit-password-in-db'] == "OK")
            {
                echo "<meta http-equiv='refresh' content='5,url=../../index.php'>";
            }
            delete_error_reset_password();
		?>

	</div>
</body>

<?php
    include '../../footer.php';
?>

</html>