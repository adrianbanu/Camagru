<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
 ?>
 
<nav>
    <a href="/camagru_test/index.php">Home</a>
    <a href="/camagru_test/scripts/gallery/gallery.php?page=1">Galleries</a>
    <a href="/camagru_test/scripts/works/works.php">Works</a> 
    
    <?php
        if (isset($_SESSION['connected']) && $_SESSION['connected'] == "OK") //from verify_login
        {
            echo "<a href='/camagru_test/scripts/account/my_account.php'><div>My account</div></a>";

            //for admin
            if ($_SESSION['groupe'] == 'admin')
            {
                echo "<a href='/camagru_test/scripts/admin/admin.php'><div>Administration</div></a>";
            }
            
            echo "<a href='/camagru_test/scripts/account/logout.php'><div>Logout</div></a>";
  
        }
        else
        {
            echo "<a href='/camagru_test/scripts/login/login.php'>Login</a>";
            echo "<a href='/camagru_test/scripts/signup/signup.php'>Sign up</a>";             
        }
    ?>

</nav>
