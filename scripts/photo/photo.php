<?PHP session_start();
    include '../functions/photo_functions.php';
    include '../../header.php';
    check_if_picture_exists($_GET['id_photo']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Photos</title>
    <link rel="stylesheet" type="text/css" href="../../css/header.css">
    <link rel="stylesheet" type="text/css" href="../../css/photo.css">
</head>

<body background = "../../img/fundal2.jpg" >
    

	<div class="center">

		<?php
		if (isset($_GET['id_photo']) && $_GET['id_photo'] != NULL && is_numeric($_GET['id_photo']))
		{
			$id = htmlentities($_GET['id_photo']);
		}
		else {
			echo "<meta http-equiv='refresh' content='0,url=../gallery/gallery.php'>";
			exit();
		}
		$data = get_infos_user_photo($id);//extrage informatiile: poza [0] din photo, login [1] si email [2] din users 
		echo "<div id='id_photo'>";
		echo "<img src='../../".$data[0]['link']."'/>";

		echo "</div>";
        
        update_number_views($data[0]['link']);
        $photo_views = get_number_views($data[0]['link']);

		echo "<p class='fake-link'>Photo by <a href='../works/works-users.php?login=".$data[0]['login']."'>".$data[0]['login']."</a></p>";
		$result = picture_belong_to_user($id);
		if ($result > 0 || (isset($_SESSION['groupe']) && $_SESSION['groupe'] == 'admin'))
		{
			echo "<a href='delete_picture.php?id-photo=".$id."' id='delete-picture' class='fake-link'>Delete this photo</a><br/>";
		}

		$nb_like = get_nb_likes($id);
		$_SESSION['login-target'] = $data[0]['login'];
		?>
		<div id="like-and-comment">
			<div id="like">
				<p class="text">I like it !</p>
				<div id="like-img"><img id="like"
					<?PHP
					can_i_like_it($id); //check to see if you already like or own the photo
					?>/>
				</div>
					<p class="text" id="compteur"><?PHP echo $nb_like;?></p>
					<form method="post" name="form_photo" action="update_nb_like_photo.php" id='hidden_data_photo'>
						<input name="hidden_data_photo" type="hidden"/>
					</form>
				</div>
				<?PHP
				if (isset($_SESSION['login']) && $_SESSION['login'])
				{
				echo '<div id="post-comment">';
					echo'<form method="post" action="post_comment.php">';
						echo '<fieldset>';
						echo '	<legend>Post a comment</legend>';
						echo '	<textarea  name="comment" maxlength="1000"></textarea>';
						echo '</fieldset>';
						echo "<input type='submit' name='submit' value='Send comment' class='fake-link'/>";
						include '../../errors.php';
						error_post_comment();
				echo '</div>';
				}
				?>
			</div>
			<div id="list-comments">
				<?php
					$comments = get_comments($id);
					put_comments($comments);
                    
				?>
			</div>
		</div>
		
		<div id="number-views">
		    Views: <?php echo $photo_views['views'] ;?>
		</div>
			<script src="photos_handle.js"></script>
			
            <!-- Go to www.addthis.com/dashboard to customize your tools -->
			<!-- Facebook, Twitter, Flip, Google+ and Others --> 
			<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5b294e97a4e5e77f"></script>
			
		</body>

		<?php
		include '../../footer.php';
		 ?>

		</html>
