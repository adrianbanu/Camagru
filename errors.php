<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

function	error_connexion()
{
	if (isset($_SESSION['connexion-mail']) && $_SESSION['connexion-mail'] == "KO")
	   echo "<div id='inscription-ko'>Error : Enter an email address</div>";
	else if (isset($_SESSION['connexion-mail-exists']) && $_SESSION['connexion-mail-exists'] == "KO")
	   echo "<div id='inscription-ko'>Error : Unknown email address</div>";
    
	if (isset($_SESSION['connexion-password']) && $_SESSION['connexion-password'] == "KO")
	   echo "<div id='inscription-ko'>Error : Enter a password</div>";
    
	if (isset($_SESSION['connexion-good-password']) && $_SESSION['connexion-good-password'] == "KO")
	   echo "<div id='inscription-ko'>Error : Wrong password</div>";
}


function delete_error_connexion()
{
	$_SESSION['connexion-mail'] = NULL;
	$_SESSION['connexion-mail-exists'] = NULL;
	$_SESSION['connexion-password'] = NULL;
	$_SESSION['connexion-good-password'] = NULL;
}


function error_inscription()
{
	if (isset($_SESSION['inscription-identifiant']) && $_SESSION['inscription-identifiant'] == "KO")
	   echo "<div id='inscription-ko'>Error : You must enter a username</div>";
	else if (isset($_SESSION['flag-user-exists']) && $_SESSION['flag-user-exists'] == "KO")
	   echo "<div id='inscription-ko'>Error : This username is already taken</div>";
    
	if (isset($_SESSION['inscription-mail']) && $_SESSION['inscription-mail'] == "KO")
	   echo "<div id='inscription-ko'>Error : You must enter an email address</div>";
	else if (isset($_SESSION['flag-regex-mail']) && $_SESSION['flag-regex-mail'] == "KO")
	   echo "<div id='inscription-ko'>Error : please enter a valid email address</div>";
	else if (isset($_SESSION['flag-mail-exists']) && $_SESSION['flag-mail-exists'] == "KO")
	   echo "<div id='inscription-ko'>Error : This email address is already in use</div>";
    
	if (isset($_SESSION['inscription-password1']) && $_SESSION['inscription-password1'] == "KO")
	   echo "<div id='inscription-ko'>Error : You must enter a password</div>";
	else if (isset($_SESSION['flag-regex-password']) && $_SESSION['flag-regex-password'] == "KO")
	   echo "<div id='inscription-ko'>Error : Your password should be at least six letters long/div>";
    
	if (isset($_SESSION['inscription-password2']) && $_SESSION['inscription-password2'] == "KO")
	   echo "<div id='inscription-ko'>Error: Please copy your password</div>";
    
	if (isset($_SESSION['same-password']) && $_SESSION['same-password'] == "KO")
	   echo "<div id='inscription-ko'>Error: Please copy your password identically</div>";
    
	if (isset($_SESSION['flag-inscription']) && $_SESSION['flag-inscription'] == "OK"){
		echo "<div id='inscription-ok'><p>Your registration has been taken into account.</p>";
		echo "<p>You will receive a confirmation email in a few moments.</p></div>";
	}
}

function delete_error_inscription()
{
	$_SESSION['inscription-identifiant'] = NULL;
	$_SESSION['flag-user-exists'] = NULL;
	$_SESSION['inscription-mail'] = NULL;
	$_SESSION['flag-regex-mail'] = NULL;
	$_SESSION['flag-mail-exists'] = NULL;
	$_SESSION['inscription-password1'] = NULL;
	$_SESSION['flag-regex-password'] = NULL;
	$_SESSION['inscription-password2'] = NULL;
	$_SESSION['same-password'] = NULL;
	$_SESSION['flag-inscription'] = NULL;
}

function	error_reset_password()
{
	if (isset($_SESSION['flag-reset-password-mail-exists']) && $_SESSION['flag-reset-password-mail-exists'] == "KO")
	echo "<div id='inscription-ko'>Error : Unknown email adress</div>";
    
	if (isset($_SESSION['mail-reinit-password']) && $_SESSION['mail-reinit-password'] == "OK"){
		echo "<div id='inscription-ok'><p>Request granted.</p>";
		echo "<p>You will receive by email a re-initialization link.</p></div>";
	}
	if (isset($_SESSION['flag-mail-exists-reset-my-password']) && $_SESSION['flag-mail-exists-reset-my-password'] == "KO")
	   echo "<div id='inscription-ko'>Error : Unknown address</div>";
    
	if (isset($_SESSION['reset-password1']) && $_SESSION['reset-password1'] == "KO")
	   echo "<div id='inscription-ko'>Error : Please enter a password</div>";
	else if (isset($_SESSION['reset-flag-regex-password']) && $_SESSION['reset-flag-regex-password'] == "KO")
	   echo "<div id='inscription-ko'>Error : Your password must contain at least 6 characters including a number</div>";
    
	if (isset($_SESSION['reset-password2']) && $_SESSION['reset-password2'] == "KO")
	   echo "<div id='inscription-ko'>Error : Please copy your password</div>";
	else if (isset($_SESSION['reset-same-password']) && $_SESSION['reset-same-password'] == "KO")
	   echo "<div id='inscription-ko'>Error : Please copy your password identically</div>";
    
	if (isset($_SESSION['reset-good-token']) && $_SESSION['reset-good-token'] == "KO")
	   echo "<div id='inscription-ko'>Error : The reset link is wrong</div>";
    
	if (isset($_SESSION['reinit-password-in-db']) && $_SESSION['reinit-password-in-db'] == "OK"){
		echo "<div id='inscription-ok'><p>Your password has been reset.</p>";
		echo "<p>You will be redirected to the home page in 5 seconds.</p></div>";
	}
}

function	delete_error_reset_password()
{
	$_SESSION['flag-reset-password-mail-exists'] = NULL;
	$_SESSION['mail-reinit-password'] = NULL;
	$_SESSION['flag-mail-exists-reset-my-password'] = NULL;
	$_SESSION['reset-password1'] = NULL;
	$_SESSION['reset-flag-regex-password'] = NULL;
	$_SESSION['reset-password2'] = NULL;
	$_SESSION['reset-same-password'] = NULL;
	$_SESSION['reset-good-token'] = NULL;
	$_SESSION['reinit-password-in-db'] = NULL;
}

function	error_post_comment()
{
	if (isset($_SESSION['comment-send']) && $_SESSION['comment-send'] == "KO")
		echo "<br/><br/><div id='inscription-ko'>Error sending comment</div>";
	else if (isset($_SESSION['comment-send']) && $_SESSION['comment-send'] == "OK"){
		echo "<br/><br/><div id='inscription-ok'><p>Your comment has been sent!</p>";
		if ($_SESSION['login'] != $_SESSION['login-target'])
		{
			echo "<p>".$_SESSION['login-target']." will be informed by email</p></div>";
		}
		else {
			echo "</div>";
		}
	}
	$_SESSION['comment-send'] = NULL;
}



function	error_change_password()
{
	if (isset($_SESSION['change-pass-old_pass']) && $_SESSION['change-pass-old_pass'] == "KO")
		echo "<div id='inscription-ko'>Error: Please enter your old password</div>";
	else if (isset($_SESSION['flag-old-pass']) && $_SESSION['flag-old-pass'] == "KO")
		echo "<div id='inscription-ko'>Error: The password does not match</div>";
    
	if (isset($_SESSION['change-pass-pass1']) && $_SESSION['change-pass-pass1'] == "KO")
		echo "<div id='inscription-ko'>Error: You must enter your new password</div>";
	else if (isset($_SESSION['flag-regex-password']) && $_SESSION['flag-regex-password'] == "KO")
		echo "<div id='inscription-ko'>Error: Your password must contain at least 6 characters including one digit</div>";
    
	if (isset($_SESSION['change-pass-pass2']) && $_SESSION['change-pass-pass2'] == "KO")
		echo "<div id='inscription-ko'>Error: Please copy your new password</div>";
	else if (isset($_SESSION['same-password']) && $_SESSION['same-password'] == "KO")
		echo "<div id='inscription-ko'>Error: Please copy the password identically</div>";
    
	if (isset($_SESSION['flag-password-changed']) && $_SESSION['flag-password-changed'] == "OK"){
		echo "<div id='inscription-ok'><p>Your password has been changed!</p><br/>";
		echo "<p>You will be redirected to your personal space in 5 seconds.</p></div>";
	}
}

function delete_error_change_password()
{
	$_SESSION['change-pass-old_pass'] = NULL;
	$_SESSION['change-pass-pass1'] = NULL;
	$_SESSION['change-pass-pass2'] = NULL;
	$_SESSION['flag-regex-password'] = NULL;
	$_SESSION['same-password'] = NULL;
	$_SESSION['flag-old-pass'] = NULL;
	$_SESSION['flag-password-changed'] = NULL;
}

function	send_image_error()
{
	if (isset($_SESSION['send-image-error']) && $_SESSION['send-image-error'] == "KO")
	{
		echo "<div id='inscription-ko'>Error transferring the file</div>";
		$_SESSION['send-image-error'] = NULL;
	}
	if (isset($_SESSION['send-image-size']) && $_SESSION['send-image-size'] == "KO")
	{
		echo "<div id='inscription-ko'>Error: Your file is too large</div>";
		$_SESSION['send-image-size'] = NULL;
	}
	if (isset($_SESSION['send-image-extension']) && $_SESSION['send-image-extension'] == "KO")
	{
		echo "<div id='inscription-ko'>Error: The extension is invalid</div>";
		$_SESSION['send-image-extension'] = NULL;
	}
	if (isset($_SESSION['send-image-dimensions']) && $_SESSION['send-image-dimensions'] == "KO")
	{
		echo "<div id='inscription-ko'>Error: Invalid dimensions</div>";
		$_SESSION['send-image-dimensions'] = NULL;
	}
}

?>
