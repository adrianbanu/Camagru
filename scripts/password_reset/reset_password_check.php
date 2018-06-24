<?PHP session_start();

	include "../functions/reset_password.php";
	include "../functions/connect_functions.php";

	$mail = htmlentities($_POST['mail']);

	$return = check_exists_mail($mail);
	if ($return > 0)
	{
		$_SESSION['flag-reset-password-mail-exists'] = "OK";
	}
	else {
		$_SESSION['flag-reset-password-mail-exists'] = "KO";
	}

	if ($_SESSION['flag-reset-password-mail-exists'] == "OK")
	{
		$token = rand(10,100000); // random number to append to link sent by email

		try{
			include '../../config/database.php';
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$bdd->query("USE camagru_test");
			$requete = $bdd->prepare("UPDATE `users` SET `token` = :token WHERE `mail` LIKE :mail");
			$requete->bindParam(':token', $token);
			$requete->bindParam(':mail', $mail);
			$requete->execute();

			send_reinit_password_mail($token, $mail, $_POST['submit']);
			$_SESSION['mail-reinit-password'] = "OK";

		}
		catch (PDOException $e) {
			print "Error : ".$e->getMessage()."<br/>";
			die();
		}
		echo "<meta http-equiv='refresh' content='0,url=reset_password.php'>";
	}
	else {
		echo "<meta http-equiv='refresh' content='0,url=reset_password.php'>";
		exit();
	}

?>
