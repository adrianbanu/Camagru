<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
 ?>
 
<!DOCTYPE html>
<html>
<head>
    <title>Get a new password</title>
    <link rel="stylesheet" type="text/css" href="../../css/header.css">

</head>

<body background = "../../img/fundal2.jpg" >
   <?php
        include '../../header.php';
    ?>
    
    <div id="text_home">
        Get a new password<br/><br />
        
        <form method = "post" action = "reset_password_check.php">
            Email : 
            <input type = "text" name = "mail"><br /><br />
            <input type="submit" name="submit" value="Submit"/><br/><br/>  
        </form><br/><br/>
        
        <?PHP
		  include "../../errors.php";
		  error_reset_password();
		  delete_error_reset_password();
		?>

    </div>        
</body>

<?php
    include '../../footer.php';
?>

</html>