<?php

/*Here we create the tables and put in them some initial information:
users
photos
likes
comments
filters 
*/

function create_users_table($conn)
{
$conn->query("CREATE TABLE IF NOT EXISTS users (
	id INT PRIMARY KEY AUTO_INCREMENT,
	login VARCHAR(255) UNIQUE,
	mail VARCHAR(255) UNIQUE,
	groupe VARCHAR(20),
	password VARCHAR(255),
	token VARCHAR(255))");
}


function	create_photos_table($conn)
{
$conn->query("CREATE TABLE IF NOT EXISTS photos (
	id_photo INT PRIMARY KEY AUTO_INCREMENT,
	date_upload INT,
	link VARCHAR(255) UNIQUE,
	id_user INT,
    views INT DEFAULT 0,
	FOREIGN KEY (id_user) REFERENCES users(id)
)");
}


function	create_likes_table($conn)
{
$conn->query("CREATE TABLE IF NOT EXISTS likes (
	id_user INT,
	FOREIGN KEY (id_user) REFERENCES users(id),
	id_photo INT,
	FOREIGN KEY (id_photo) REFERENCES photos(id_photo) ON DELETE CASCADE
)");
}


function	create_comments_table($conn)
{
$conn->query("CREATE TABLE IF NOT EXISTS comments (
	id_comment INT PRIMARY KEY AUTO_INCREMENT,
	id_user INT,
	FOREIGN KEY (id_user) REFERENCES users(id),
	id_photo INT,
	FOREIGN KEY (id_photo) REFERENCES photos(id_photo) ON DELETE CASCADE,
	comments VARCHAR(1000) CHARACTER SET UTF8
)");
}

function	create_filters_table($conn)
{
$conn->query("CREATE TABLE IF NOT EXISTS filters (
	id_filter INT PRIMARY KEY AUTO_INCREMENT,
	path_filter VARCHAR(255) UNIQUE
)");
}

// Populare tabele

function	add_users($conn)
{
$conn->query("LOAD DATA LOCAL INFILE 'C:/wamp64/www/Camagru_test/config/users.csv'
IGNORE INTO TABLE `users`
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\r\n'
IGNORE 1 LINES (login,mail,groupe,password,token)");
}


function	add_pictures($conn)
{
	$conn->query("LOAD DATA LOCAL INFILE 'C:/wamp64/www/Camagru_test/config/photos.csv'
	INTO TABLE `photos`
	FIELDS TERMINATED BY ',' 
	LINES TERMINATED BY '\r\n'
	IGNORE 1 LINES (link,id_user,date_upload, views)");
}

function	add_likes($conn)
{
	$conn->query("LOAD DATA LOCAL INFILE 'C:/wamp64/www/Camagru_test/config/likes.csv'
	INTO TABLE `likes`
	FIELDS TERMINATED BY ','
	LINES TERMINATED BY '\r\n'
	IGNORE 1 LINES (id_user,id_photo)");
}

function	add_comments($conn)
{
	$conn->query("LOAD DATA LOCAL INFILE 'C:/wamp64/www/Camagru_test/config/comments.csv'
	INTO TABLE `comments`
	CHARACTER SET UTF8
	FIELDS TERMINATED BY ','
	LINES TERMINATED BY '\r\n'
	IGNORE 1 LINES (id_user,id_photo,comments)");
}

function	add_filters($conn)
{
	$conn->query("LOAD DATA LOCAL INFILE 'C:/wamp64/www/Camagru_test/config/masks.csv'
	INTO TABLE `filters`
	CHARACTER SET UTF8
	FIELDS TERMINATED BY ','
	LINES TERMINATED BY '\r\n'
	IGNORE 1 LINES (path_filter)");
}

?>