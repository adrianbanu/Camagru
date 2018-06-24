<?php
    session_start();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="css/header.css">
    
</head>

<body background = "img/fundal2.jpg" >
    
    <?php include "header.php";?>
    
        <div id="text_home">
            This is a small web application allowing you to make basic photo and video editing using your webcam and some predefined images. Enjoy!<p></p>
            <img src="img/Nice_to_meet_you.jpg" alt="Hello Kitty" id = "poza">
        </div>
    

        <?php include "footer.php";?>

    
</body>
</html>