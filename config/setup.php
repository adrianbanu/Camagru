<?php

//session_start(); 
    
include 'database.php';
include 'database_functions.php';

    try {
        $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, [PDO::MYSQL_ATTR_LOCAL_INFILE => true]);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->query("CREATE DATABASE IF NOT EXISTS $DB_NAME");
        $conn->query("use $DB_NAME");
        create_users_table($conn);
		create_photos_table($conn);
        create_likes_table($conn);
        create_comments_table($conn);
        create_filters_table($conn);
        add_users($conn);
		add_pictures($conn);
		add_likes($conn);
		add_comments($conn);
		add_filters($conn);
        echo "Database created successfully<br>";
    }
    catch(PDOException $e)
    {
        echo "Error" . "<br>" . $e->getMessage();
    }

    $conn = null;
?>
