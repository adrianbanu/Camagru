<?php
session_start();
if ($_SESSION['groupe'] != 'admin')
{

	echo "<meta http-equiv='refresh' content='0,url=../account/my_account.php'>";
	exit();
}
else {

	include '../functions/admin_user_management.php';

	if (isset($_GET['id']) && $_GET['id'] != NULL && is_numeric($_GET['id']))
	{
		$id = htmlentities($_GET['id']);
		$suppress_id_exists = check_if_id_exists($id);
		$suppress_admin = check_if_not_admin($id);
		if ($suppress_id_exists > 0 && $suppress_admin == 0)
		{
			suppress_user($id);
		}
	}
	echo "<meta http-equiv='refresh' content='0,url=user_management.php'>";
}


 ?>