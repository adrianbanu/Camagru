<?PHP session_start();
	if ($_SESSION['groupe'] != 'admin')
	{
		echo "<meta http-equiv='refresh' content='0,url=../account/my_account.php'>";
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../../css/header.css">
<title>Admin page</title>
</head>

<body background = "../../img/fundal2.jpg" >
	<?php
  	$current_page = "admin";
	include '../../header.php';
	?>
	<div id="text_home">
		<h2>Administration</h2><br/>

        <a href="user_management.php">Manage users</a><p></p>
		<a href="statistics.php">Statistics</a><br/>
	</div>
	
</body>

<?php
    include '../../footer.php';
 ?>
</html>