<!doctype html>
<html>
   <head>
       <title>My account</title>
       <link rel="stylesheet" type="text/css" href="../../css/header.css">
   </head>        

   <body background = "../../img/fundal2.jpg" >
        <?php
            $current_page = "my_account";
            include '../../header.php';
        ?>
        
        <h2> Hello, <?php echo $_SESSION['login'];?>!</h2>
        <br/><br/>
        
        <?php
            include '../functions/gallery_functions.php';
            include '../functions/photo_functions.php';
        
        echo "<div id=\"text_home\">"; // pentru formatare
        
        $got_photos = get_gallery_user($_SESSION['login']); 
		if ($got_photos == NULL) //if you have no works
		{
			echo "<p class='text'>You have no works yet.</p>";
			echo "<p class='text'>If you want to create some, <a href='../works/works.php'>go here</a></p><br><br>";
		}
        else
		{
			
            echo '<h3> My works</h3>';
            echo '<p><a href="../works/works-users.php?login='.$_SESSION['login'].'"> See all my works</a></p>';
            echo '<p>Most liked picture: ';
			$most_liked_picture = get_most_liked_picture($_SESSION['id']);
			if ($most_liked_picture == NULL)
			{
				echo "You have no liked picture";
			}
			else {
				echo "<br/><br/>";
				$max = $most_liked_picture[0]['nb_likes'];
				foreach ($most_liked_picture as $elem)
				{
					if ($elem['nb_likes'] == $max)
					$array_like[] = $elem;
				}
				foreach ($array_like as $photo_like)
				{
					if ($max > 1)
					{
						echo "<a href='../photo/photo.php?id_photo=".$photo_like['id_photo']."'>Click here</a> (".$max." likes)<br/>";
					}
					else {
						echo "<a href='../photo/photo.php?id_photo=".$photo_like['id_photo']."'>Click here</a> (".$max." like)<br/>";
					}
				}
			}
			echo '<p> Most commented picture : ';
			$most_commented_picture = get_most_commented_picture($_SESSION['id']);
			if ($most_commented_picture == NULL)
			{
				echo "You have no commnets on your works";
			}
			else {
				echo "<br/><br/>";
				$max = $most_commented_picture[0]['nb_comments'];
				foreach ($most_commented_picture as $elem)
				{
					if ($elem['nb_comments'] == $max)
					{
						$array_comments[] = $elem;
					}
				}
				foreach ($array_comments as $photo_comment)
				{
					if ($max > 1)
					{
						echo "<a href='../photo/photo.php?id_photo=".$photo_comment['id_photo']."'>Click here</a> (".$max." commentaires)<br/>";
					}
					else {
						echo "<a href='../photo/photo.php?id_photo=".$photo_comment['id_photo']."'>Click here</a> (".$max." commentaire)<br/>";
					}
				}
			}
			echo "<br/><br/>";
		}
        echo "</div>"; //pentru formatare
        ?>
        
        
        <div id="text_home">
        <h3>Manage account</h3>
        <p><a href="change_password.php">Change password </a></p>
        
        <?php
		if ($_SESSION['groupe'] != 'admin')
		{
			echo '<p class="text"><a href="close_account.php">Close account</a></p>';
		}
		if (isset($_SESSION['wish-to-suppress-account']) && $_SESSION['wish-to-suppress-account'] == "OK")
		{
			echo "<p class='text'>Do you really want to delete your account?</p>";
			echo "<form method='post' action='close_account.php'>";
			echo "<input type='submit' name='oui' value='Yes'/>\t";
			echo "<input type='submit' name='non' value='No'/><br/><br/>";
			echo "</form><br/><br/>";
		}
		if (isset($_SESSION['session-destroy']) && $_SESSION['session-destroy'] == "OK")
		{
			echo "<div id='inscription-ko'><p>Your account has been deleted.</p>";
			echo "<p>You will be redirected to the home page in 5 seconds.</p></div>";
			session_destroy();
			echo "<meta http-equiv='refresh' content='5,url=../../index.php'>";
		}
		?>
        </div>    
    
        
    <?php include "../../footer.php";?>
            
    </body>
            
</html>