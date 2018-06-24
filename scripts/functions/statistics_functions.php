<?php


function	get_most_viewed_photo()
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru_test");
		$requete = $bdd->prepare("SELECT (SELECT MAX(views) from `photos`) as `nr_views`, `id_photo` from `photos` where `views` = (SELECT MAX(views) from `photos`) LIMIT 1");
		$requete->execute();
		$result = $requete->fetchAll(PDO::FETCH_ASSOC);
		return ($result);
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}

function	get_nb_users()
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru_test");
		$requete = $bdd->prepare("SELECT * FROM `users` WHERE `login` != 'admin'");
		$requete->execute();
		$result = $requete->rowCount();
		return ($result);
	}
	catch (PDOException $e) {
		print "Error1 : ".$e->getMessage()."<br/>";
		die();
	}
}

function	get_nb_photos()
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru_test");
		$requete = $bdd->prepare("SELECT * FROM `photos`");
		$requete->execute();
		$result = $requete->rowCount();
		return ($result);
	}
	catch (PDOException $e) {
		print "Error2 : ".$e->getMessage()."<br/>";
		die();
	}
}

function	get_nb_comments()
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru_test");
		$requete = $bdd->prepare("SELECT * FROM `comments`");
		$requete->execute();
		$result = $requete->rowCount();
		return ($result);
	}
	catch (PDOException $e) {
		print "Error3 : ".$e->getMessage()."<br/>";
		die();
	}
}

function	get_nb_like()
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru_test");
		$requete = $bdd->prepare("SELECT * FROM `likes`");
		$requete->execute();
		$result = $requete->rowCount();
		return ($result);
	}
	catch (PDOException $e) {
		print "Error4 : ".$e->getMessage()."<br/>";
		die();
	}
}

function	get_most_liked_user()
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru_test");
		$requete = $bdd->prepare("SELECT `users`.`login`, COUNT(*) as `nb_likes`
		FROM `users`
		INNER JOIN `photos` ON `photos`.`id_user` = `users`.`id`
		INNER JOIN `likes` ON `likes`.`id_photo` = `photos`.`id_photo`
		GROUP BY `users`.`id`
		ORDER BY `nb_likes` DESC");
		$requete->execute();
		$result = $requete->fetchAll(PDO::FETCH_ASSOC);
		return ($result);
	}
	catch (PDOException $e) {
		print "Error5 : ".$e->getMessage()."<br/>";
		die();
	}
}


function	get_most_commented_user()
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru_test");
		$requete = $bdd->prepare("SELECT `users`.`login`, COUNT(*) as `nb_comments`
		FROM `users`
		INNER JOIN `photos` ON `photos`.`id_user` = `users`.`id`
		INNER JOIN `comments` ON `comments`.`id_photo` = `photos`.`id_photo`
		GROUP BY `users`.`id`
		ORDER BY `nb_comments` DESC");
		$requete->execute();
		$result = $requete->fetchAll(PDO::FETCH_ASSOC);
		return ($result);
	}
	catch (PDOException $e) {
		print "Error6 : ".$e->getMessage()."<br/>";
		die();
	}
}

function	get_most_photo_user()
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru_test");
		$requete = $bdd->prepare("SELECT `users`.`login`, COUNT(*) as `nb_photos`
		FROM `users`
		INNER JOIN `photos` ON `photos`.`id_user` = `users`.`id`
		GROUP BY `users`.`id`
		ORDER BY `nb_photos` DESC");
		$requete->execute();
		$result = $requete->fetchAll(PDO::FETCH_ASSOC);
		return ($result);
	}
	catch (PDOException $e) {
		print "Error7 : ".$e->getMessage()."<br/>";
		die();
	}
}


function	get_most_liked_photo()
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru_test");
		$requete = $bdd->prepare("SELECT `photos`.`id_photo`, COUNT(*) as `nb_likes_photo`
		FROM `photos`
		INNER JOIN `likes` ON `likes`.`id_photo` = `photos`.`id_photo`
		GROUP BY `photos`.`id_photo`
		ORDER BY `nb_likes_photo` DESC");
		$requete->execute();
		$result = $requete->fetchAll(PDO::FETCH_ASSOC);
		return ($result);
	}
	catch (PDOException $e) {
		print "Error8 : ".$e->getMessage()."<br/>";
		die();
	}
}




function	get_most_commented_photo()
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru_test");
		$requete = $bdd->prepare("SELECT `photos`.`id_photo`, COUNT(*) as `nb_comments_photo`
		FROM `photos`
		INNER JOIN `comments` ON `comments`.`id_photo` = `photos`.`id_photo`
		GROUP BY `photos`.`id_photo`
		ORDER BY `nb_comments_photo` DESC");
		$requete->execute();
		$result = $requete->fetchAll(PDO::FETCH_ASSOC);
		return ($result);
	}
	catch (PDOException $e) {
		print "Error9 : ".$e->getMessage()."<br/>";
		die();
	}
}


 ?>
