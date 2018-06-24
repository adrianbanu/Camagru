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


<title>Manage users</title>
</head>

<body background = "../../img/fundal2.jpg" >
	<?php
        $current_page = "admin";
        include '../../header.php';
        include '../functions/admin_user_management.php';
	?>
	<div id="text_home">
		<h2>User's list</h2><br/>
		<?php
		$data = get_list_users();
		if (count($data) == 1)
		{
			echo "<p class='text' style='text-align:center;'>There are no users so far!</p>";
		}
		else {
			echo "<table cellspacing='0'>";
			foreach ($data as $user)
			{
				echo "<tr>";
				echo "<td>";
				echo $user['login'];
				echo "</td>";
				echo "<td>";
				echo $user['mail'];
				echo "</td>";
				echo "<td>";

				//admin must be named Adi13
				if ($user['login'] != 'Adi13')
                {
					echo "<a href='delete_user.php?id=".$user['id']."'>Delete</a>"; 
				}
				echo "</td>";

				echo "</tr>";
			}
			echo "</table>";
		}
		?>
		<br/>
	</div>
</body>

<?php
    include '../../footer.php';
?>
</html>
