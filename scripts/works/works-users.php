<?PHP
session_start();
include '../../header.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>My works</title>
    <link rel="stylesheet" type="text/css" href="../../css/global.css">
    <link rel="stylesheet" type="text/css" href="../../css/header.css">
    <link rel="stylesheet" type="text/css" href="../../css/gallery.css">
</head>

<body background = "../../img/fundal2.jpg" >
	<?php
	include '../functions/gallery_functions.php';
	?>
	<div class="center">

			<?PHP
			$exists_or_not = check_if_login_exists(htmlentities($_GET['login']));
			if ($exists_or_not == 0)
			{
				echo "<meta http-equiv='refresh' content='0,url=../gallery/gallery.php'>";
			}
			else {
					$login = htmlentities($_GET['login']);
					echo "<h2>Works by ".$login."</h2><br/>";
					echo '<div class="gallery">';
					$data = get_gallery_user($login);
					$nb_values = count($data);
					if ($nb_values == 0)
					{
						if ($_SESSION['login'] == $login)
						{
						echo "<p class='text'>You have no works so far </p>
						<br/><p class='text'>If you want to make some <a href='works.php'>go here</a></p>";
						}
						else {
							echo "<p>".$login." has no works so far</p>";
						}
					}
					else {
						foreach ($data as $data1)
						{
							echo "<div class='photo'>";
							echo "<a href='../photo/photo.php?id_photo=".$data1['id_photo']."'><img src='../../".$data1['link']."'></a>";
							echo "</div>";
						}
						echo "</div>";
					}
			}
				echo "</div>";
			?>

</div>
</body>
<?php
include '../../footer.php';
 ?>
</html>
