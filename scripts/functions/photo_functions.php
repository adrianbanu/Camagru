<?php


    function update_number_views($id_photo)
    {
        try{
            include '../../config/database.php';
            $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $bdd->query("USE camagru_test");     
            $requete = $bdd->prepare("UPDATE `photos` SET `views` = `views` + 1 WHERE `link` = :id_photo");
            $requete->bindParam(':id_photo', $id_photo);
            $requete->execute();    
        }
        catch (PDOException $e) {
			print "Error : ".$e->getMessage()."<br/>";
			die();
		}
    }


    function get_number_views($id_photo)
    {
        try{
        include '../../config/database.php';
        $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $bdd->query("USE camagru_test");     
        $requete = $bdd->prepare("SELECT `views` FROM `photos` WHERE `link`= :id_photo");
		$requete->bindParam(':id_photo', $id_photo);
		$requete->execute();
        $data = $requete->fetch();
        return ($data);
        }
        catch (PDOException $e) {
			print "Error : ".$e->getMessage()."<br/>";
			die();
		}
    }

	function	get_infos_user_photo($id_photo)
	{
		try{
			include '../../config/database.php';
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$bdd->query("USE camagru_test");
			$requete = $bdd->prepare("SELECT `link`, `login`, `mail` FROM `photos` INNER JOIN `users` ON users.id = photos.id_user WHERE `id_photo` LIKE :id_photo");
			$requete->bindParam(':id_photo', $id_photo);
			$requete->execute();
			$data = $requete->fetchAll(PDO::FETCH_ASSOC);
			return ($data);
		}
		catch (PDOException $e) {
			print "Error : ".$e->getMessage()."<br/>";
			die();
		}
	}

	function	get_nb_likes($id_photo)
	{
		try{
			include '../../config/database.php';
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$bdd->query("USE camagru_test");
			$requete = $bdd->prepare("SELECT * FROM `likes` WHERE `id_photo`= :id_photo");
			$requete->bindParam(':id_photo', $id_photo);
			$requete->execute();
			$result = $requete->rowCount();
			return ($result);
		}
		catch (PDOException $e) {
			print "Error : ".$e->getMessage()."<br/>";
			die();
		}
	}

	function	check_if_already_liked($id_photo, $id)
	{
		try{
			include '../../config/database.php';
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$bdd->query("USE camagru_test");
			$requete = $bdd->prepare("SELECT * FROM `likes` INNER JOIN `users` ON users.id = likes.id_user WHERE `id_photo`= :id_photo AND `id_user` = :id_user");
			$requete->bindParam(':id_photo', $id_photo);
			$requete->bindParam(':id_user', $id);
			$requete->execute();
			$result = $requete->rowCount();
			return ($result);
		}
		catch (PDOException $e) {
			print "Error : ".$e->getMessage()."<br/>";
			die();
		}
	}

	function	check_if_my_photo($id_photo, $id)
	{
		try{
			include '../../config/database.php';
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$bdd->query("USE camagru_test");
			$requete = $bdd->prepare("SELECT * FROM `photos` WHERE `id_photo`= :id_photo AND `id_user` = :id_user");
			$requete->bindParam(':id_photo', $id_photo);
			$requete->bindParam(':id_user', $id);
			$requete->execute();
			$result = $requete->rowCount();
			return ($result);
		}
		catch (PDOException $e) {
			print "Error : ".$e->getMessage()."<br/>";
			die();
		}
	}

	function	can_i_like_it($id_photo)
	{
		if (isset($_SESSION['login']))
		{
			$_SESSION['already_liked'] = check_if_already_liked($id_photo, $_SESSION['id']);
			$_SESSION['my_photo'] = check_if_my_photo($_GET['id_photo'], $_SESSION['id']);
			if ($_SESSION['already_liked'] != 0 || $_SESSION['my_photo'] != 0)
			{
				echo 'src="../../img/thumbs-up_grey.png"';
				if ($_SESSION['already_liked'] != 0)
				echo 'title="You already like this image!"';
				else if ($_SESSION['my_photo'] != 0)
				echo 'title="You cannot like your own image !"';
			}
			else {
				echo 'src="../../img/thumbs-up_go.png"';
				echo 'onmouseout="this.src=\'../../img/thumbs-up_go.png\'"';
				echo 'onclick="increment_like(this)"';
				$_SESSION['click-like'] = "OK";
				$_SESSION['id_photo'] = $id_photo;
			}
		}
		else {
			echo 'src="../../img/thumbs-up_grey.png"';
			echo 'title="You must be connected to like this image!"';
		}
	}


function	get_comments($id_photo)
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru_test");
		$bdd->query("SET NAMES UTF8");
		$requete = $bdd->prepare("SELECT `login`, `comments`, `id_comment` FROM `comments` INNER JOIN `users` ON users.id = comments.id_user WHERE `id_photo` LIKE :id_photo");
		$requete->bindParam(':id_photo', $id_photo);
		$requete->execute();
		$data = $requete->fetchAll(PDO::FETCH_ASSOC);
		return ($data);
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}

function	get_mail_user($login)
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru_test");
		$bdd->query("SET NAMES UTF8");
		$requete = $bdd->prepare("SELECT `mail` FROM `users` WHERE `login` LIKE :login");
		$requete->bindParam(':login', $login);
		$requete->execute();
		$data = $requete->fetchAll(PDO::FETCH_ASSOC);
		return ($data);
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}

function	send_comment_mail($identifiant, $id_photo, $submit, $mail)
{
		$name = "Camagru";
		$message = "<br/>Dear " . $identifiant . ",<br/><br/>" .
		"One of your works received a comment". "<br/>".
		"To consult it, go to <a href='http://localhost/camagru_test/scripts/photo/photo.php?id_photo=".$id_photo."'>to the following address</a>" . "<br/><br/>" .
		"Bye !";
		$headers  = 'MIME-Version: 1.0' . "\r\n";
     	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$headers .= 'From: Camagru';
		$to = $mail;
		$subject = 'New comment over one of your works';
		$body = "From: $name<br/>To: $to<br/>Message:<br/>$message";

		if ($submit)
		{
			if (mail ($to, $subject, $body, $headers) == FALSE)
			{
				die("error");
			}
		}
}


function	put_comments($comments)
{
if ($comments == NULL)
{
	echo "<br/><p id='text_home' style='text-align:center;'>There are no comments on this photo yet. Be the first !</p>";
}
else {
	echo "<br/>";
	foreach ($comments as $data)
	{

		if ((isset($_SESSION['login']) && isset($_SESSION['groupe'])) &&  ($data['login'] == $_SESSION['login'] || $_SESSION['groupe'] == 'admin'))
		{
			echo "<div id='comment' onmouseover=\"getElementById('".$data['id_comment'];
			echo "').style.display='block'\" onmouseout=\"getElementById('".$data['id_comment'];
			echo "').style.display='none'\" >";
			echo "<p class='text'>Posted by <a href='../works/works-users.php?login=".$data['login']."'>".$data['login']."</a></p>";
			echo "<p class='text'>".$data['comments']."</p>";
			echo "<a href='delete_comment.php?id-comment=".$data['id_comment']."' class='delete-comment' id='".$data['id_comment']."'>Delete</a>"; //de revenit
		}
		else {
			echo "<div id='comment'>";
			echo "<p class='text'>Posted by <a href='../works/works-users.php?login=".$data['login']."'>".$data['login']."</a></p>";
			echo "<p class='text'>".$data['comments']."</p>";
		}
		echo "</div>";
		echo "<br/>";
	}
}
}

function	check_if_picture_exists($id)
{
	if (isset($id) && $id != NULL && is_numeric($id))
	{
		try{
			include '../../config/database.php';
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$bdd->query("USE camagru_test");
			$requete = $bdd->prepare("SELECT * FROM `photos` WHERE `id_photo` = :id_photo");
			$requete->bindParam(':id_photo', $id);
			$requete->execute();
			$code = $requete->rowCount();
			if ($code == 0)
			{
				echo "<meta http-equiv='refresh' content='0,url=../gallery/gallery.php'>";
				exit();
			}
			else {
				$_SESSION['id_photo'] = $id;
			}
		}
		catch (PDOException $e) {
			print "Error : ".$e->getMessage()."<br/>";
			die();
		}
	}
	else {
		echo "<meta http-equiv='refresh' content='0,url=../gallery/gallery.php'>";
		exit();
	}
}

function	picture_belong_to_user($id)
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru_test");
		$requete = $bdd->prepare("SELECT * FROM `photos` WHERE `id_photo` = :id_photo AND `id_user` = :id_user");
		$requete->bindParam(':id_photo', $id);
		$requete->bindParam(':id_user', $_SESSION['id']);
		$requete->execute();
		$code = $requete->rowCount();
		return ($code);

}
catch (PDOException $e) {
	print "Error : ".$e->getMessage()."<br/>";
	die();
}
}


// like & comment

function	get_nb_likes_user($id)
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru_test");
		$requete = $bdd->prepare("SELECT `photos`.`link`, `photos`.`id_user` AS `Uploader`, `likes`.`id_photo` AS `id_photo`
			FROM `likes`
			INNER JOIN `photos` ON `photos`.`id_photo` = `likes`.`id_photo`
			WHERE `photos`.`id_user` = :id
			ORDER BY `likes`.`id_photo` ASC");
			$requete->bindParam(':id', $id);
			$requete->execute();
			$result = $requete->rowCount();
			return ($result);
		}
    catch (PDOException $e) {
        print "Error : ".$e->getMessage()."<br/>";
        die();
		}
}


function	get_most_liked_picture($id)
{
    try{
        include '../../config/database.php';
        $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $bdd->query("USE camagru_test");
        $requete = $bdd->prepare("SELECT `photos`.`id_photo`, `photos`.`link`, COUNT(*) as `nb_likes`
        FROM `likes`
        INNER JOIN `photos` ON `photos`.`id_photo` = `likes`.`id_photo`
        WHERE `photos`.`id_user` = :id
        GROUP BY `photos`.`id_photo`
        ORDER BY `nb_likes` DESC");
        $requete->bindParam(':id', $id);
        $requete->execute();
        $result = $requete->fetchAll(PDO::FETCH_ASSOC);
        return ($result);
    }
    catch (PDOException $e) {
        print "Error : ".$e->getMessage()."<br/>";
        die();
    }
}


function	get_nb_comments_user($id)
{
    try{
        include '../../config/database.php';
        $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $bdd->query("USE camagru_test");
        $requete = $bdd->prepare("SELECT `photos`.`link`, `photos`.`id_user` AS `Uploader`, `comments`.`id_photo` AS `id_photo`
            FROM `comments`
            INNER JOIN `photos` ON `photos`.`id_photo` = `comments`.`id_photo`
            WHERE `photos`.`id_user` = :id
            ORDER BY `comments`.`id_photo` ASC");
            $requete->bindParam(':id', $id);
            $requete->execute();
            $result = $requete->rowCount();
            return ($result);
        }
    catch (PDOException $e) {
        print "Error : ".$e->getMessage()."<br/>";
        die();
        }
}

function	get_most_commented_picture($id)
{
    try{
        include '../../config/database.php';
        $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $bdd->query("USE camagru_test");
        $requete = $bdd->prepare("SELECT `photos`.`id_photo`, `photos`.`link`, COUNT(*) as `nb_comments`
        FROM `comments`
        INNER JOIN `photos` ON `photos`.`id_photo` = `comments`.`id_photo`
        WHERE `photos`.`id_user` = :id
        GROUP BY `photos`.`id_photo`
        ORDER BY `nb_comments` DESC");
        $requete->bindParam(':id', $id);
        $requete->execute();
        $result = $requete->fetchAll(PDO::FETCH_ASSOC);
        return ($result);
    }
    catch (PDOException $e) {
        print "Error : ".$e->getMessage()."<br/>";
        die();
    }


}
		
		
?>
