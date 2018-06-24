<?php


function connexion_check_password($mail, $password)
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru_test");
		$requete = $bdd->prepare("SELECT * FROM `users` WHERE `mail` LIKE :mail");
		$requete->bindParam(':mail', $mail);
		$requete->execute();
		$code = $requete->fetch(PDO::FETCH_ASSOC);
		if (in_array($password, $code) == TRUE)
		{
			$_SESSION['connexion-good-password'] = "OK";
			return ($code);
		}
		else {
			$_SESSION['connexion-good-password'] = "KO";
		}
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}


function send_reinit_password_mail($token, $mail, $submit)
{
	$name = "Camagru";
	$message = "Dear member" . ",\r\n\r\n" .
	"As you have forgotten your password.\r\n\r\n" .
	"see here how to get another one: \r\n\r\n" .
	"http://localhost/camagru_test/scripts/password_reset/reset_my_password.php?token=".$token." \r\n\r\n" .
	"Bye !";
	$from = 'From: Camagru';
	$to = $mail;
	$subject = mb_encode_mimeheader('Get a password to access Camagru', "UTF-8");
	$body = "From: $name\r\nTo: $to\r\nMessage:\r\n\r\n$message";
	if ($submit)
	{
		if (mail ($to, $subject, $body, $from) == FALSE)
		{
			die();
		}
	}
}



function	check_old_pass($old_pass, $flag)
{

	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru_test");
		$requete = $bdd->prepare("SELECT `password` FROM `users` WHERE `id` LIKE :id");
		$requete->bindParam(':id', $_SESSION['id']);
		$requete->execute();
		$code = $requete->fetch(PDO::FETCH_ASSOC);

		if ($old_pass == $code['password'])
		{
			$_SESSION[$flag] = "OK";
			return ($code);
		}
		else {
			$_SESSION[$flag] = "KO";
		}
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}


function check_form($flag, $text, $data)
{
	if (isset($data) && $data != NULL)
	{
		$_SESSION[$flag."-".$text] = "OK";
	}
	else
	{
		$_SESSION[$flag."-".$text] = "KO";
	}
}

function check_regex_mail($data)
{
	if (filter_var($data, FILTER_VALIDATE_EMAIL) == FALSE)
	{
		$_SESSION['flag-regex-mail'] = "KO";
	}
	else {
		$_SESSION['flag-regex-mail'] = "OK";
	}
}

function check_regex_password($data, $flag)
{
	if (preg_match("/(?=.{6,})(?=.*\d)(?=.*[a-zA-Z])/", $data) != 1)
	{
		$_SESSION[$flag] = "KO";
	}
	else {
		$_SESSION[$flag] = "OK";
	}
}

function check_exists_username($identifiant)
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru_test");
		$requete = $bdd->prepare("SELECT * FROM `users` WHERE `login`= :login");
		$requete->bindParam(':login', $identifiant);
		$requete->execute();
		$result = $requete->rowCount();
		if ($result  > 0){
			$_SESSION['flag-user-exists'] = "KO";
		}
		else {
			$_SESSION['flag-user-exists'] = "OK";
		}
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}

function check_exists_mail($mail)
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru_test");
		$requete = $bdd->prepare("SELECT * FROM `users` WHERE `mail`= :mail");
		$requete->bindParam(':mail', $mail);
		$requete->execute();
		$result = $requete->rowCount();
		return ($result);
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}

function check_same_password($pass1, $pass2, $flag)
{
	if ($pass1 != $pass2)
	{
		$_SESSION[$flag] = "KO";
	}
	else {
		$_SESSION[$flag] = "OK";
	}
}

function send_confirmation_mail($identifiant, $mail, $submit)
{
	$name = "Camagru";
	$message = "Dear " . $identifiant . ",\r\n\r\n" .
	"Thanks for joining Camagru\r\n\r\n" .
	"You can connect here: \r\n\r\n" .
	"http://localhost/camagru_test/scripts/login/login.php \r\n\r\n" .
	"Bye!";
	$from = 'From: Camagru';
	$to = $mail;
	$subject = mb_encode_mimeheader('Your subcription to Camagru', "UTF-8");
	$body = "From: $name\r\nTo: $to\r\nMessage:\r\n\r\n$message";

	if ($submit)
	{
		if (mail ($to, $subject, $body, $from) == FALSE)
		{
			die();
		}
	}
}

?>