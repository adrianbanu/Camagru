<?PHP session_start();

if (isset($_POST['mail']) && $_POST['mail'] != NULL
&& isset($_POST['password1']) && $_POST['password1'] != NULL
&& isset($_POST['password2']) && $_POST['password2'] != NULL
&& isset($_POST['token']) && $_POST['token'] != NULL)
{
	include "../functions/reset_password.php";
	include "../functions/connect_functions.php";

	$mail = htmlentities($_POST['mail']);
	$password1 = htmlentities($_POST['password1']);
	$password2 = htmlentities($_POST['password2']);
	$token = htmlentities($_POST['token']);

	$return = check_exists_mail($mail);
	$_SESSION['flag-mail-exists-reset-my-password'] = ($return > 0) ? "OK" : "KO";

	check_form("reset", "password1", $password1);
	check_form("reset", "password2", $password2);
	check_regex_password($password1, "reset-flag-regex-password");
	check_same_password($password1, $password2, "reset-same-password");



	if ($_SESSION['flag-mail-exists-reset-my-password'] == "OK" &&
	$_SESSION['reset-password1'] == "OK" && $_SESSION['reset-password2'] == "OK" &&
	$_SESSION['reset-flag-regex-password'] == "OK" &&
	$_SESSION['reset-same-password'] == "OK")
	{
		check_token_reset_password($password1, $token, $mail);
		if ($_SESSION['reset-good-token'] == "OK"){
			$new_password = hash('sha512', $password1);

			try{
				include '../../config/database.php';
				$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
				$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$bdd->query("USE camagru_test");
				$requete = $bdd->prepare("UPDATE `users` SET `password` = :new_password, `token` = NULL WHERE `mail` LIKE :mail");
				$requete->bindParam(':new_password', $new_password);
				$requete->bindParam(':mail', $mail);
				$requete->execute();
				$_SESSION['reinit-password-in-db'] = "OK";

			}
			catch (PDOException $e) {
				print "Error : ".$e->getMessage()."<br/>";
				die();
			}

			echo "<meta http-equiv='refresh' content='0,url=reset_my_password.php'>";

		}
	}
}
//include "../../errors.php";
//error_reset_password();
echo "<meta http-equiv='refresh' content='0,url=reset_my_password.php?token=".$token."'>";
?>
