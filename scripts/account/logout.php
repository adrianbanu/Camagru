<?PHP
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../../css/header.css">
    <title>Logout</title>
</head>

<body background = "../../img/fundal2.jpg" >
	<?php
  	$current_page = "logout";
	include '../../header.php';
	?>
	<div class="center">
		<h2>Bye <?PHP if(isset($_SESSION['login'])) echo $_SESSION['login'];?> !</h2><br/>

		<p class="text" style="text-align:center;">You are being redirected to the home page...</p><br/>
	</div>
</body>
</html>

<?PHP
session_destroy();

	echo "<meta http-equiv='refresh' content='5,url=../../index.php'>";
	include '../../footer.php';
?>
