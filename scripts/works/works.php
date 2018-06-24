<?PHP session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Works</title>
    <link rel="stylesheet" type="text/css" href="../../css/global.css">
    <link rel="stylesheet" type="text/css" href="../../css/header.css">
    <link rel="stylesheet" type="text/css" href="../../css/montage.css">
    <link rel="stylesheet" type="text/css" href="../../css/gallery.css">
    
    
</head>

<body background = "../../img/fundal2.jpg">
	<?php
	include '../../header.php';
	echo '<div class="center">';

	if (!isset($_SESSION['login']))
	{
		echo '<div id = "ecran">';
        echo "<p class='text' style='text-align:center;'>This page is for members only.</p>";
		echo "<p class='text' style='text-align:center;'>To sign in <a href='../signup/signup.php'>go here.</a></p>";
		echo "<p class='text' style='text-align:center;'>To log in <a href='../login/login.php'>go here.</a></p>";
        
echo '<div id="footer2"> 
&copy; abanu 2018 - Camagru
</div>';
        echo '</div>'; //petru id ecran
        
        
	}
	else {

		include 'go-to-camera.php';
	}
    
    
    echo '</div>';
    
	?>
	
</body>



</html>
