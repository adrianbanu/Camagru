<?php
session_start();

//testare - ca sa evit undefined index
$_SESSION['send-image-error'] = "XXX";
$_SESSION['send-image-size'] = "XXX";
$_SESSION['send-image-extension'] = "XXX";    

if ($_FILES['image']['error'] > 0 || !(isset($_POST['submit'])) || !(isset($_FILES['image'])))
{
	$_SESSION['send-image-error'] = "KO";
}

if (isset($_SESSION['send-image-error']) && $_SESSION['send-image-error'] != "KO")
{
	if ($_FILES['image']['size'] > 2097152)
	{
		$_SESSION['send-image-size'] = "KO";
	}
}

if (isset($_SESSION['send-image-size']) && $_SESSION['send-image-size'] != "KO")
{
	$extensions = array('png');
	$extension_upload = strtolower(substr(strchr($_FILES['image']['name'], '.'), 1));
	if (!(in_array($extension_upload, $extensions)))
	{
		$_SESSION['send-image-extension'] = "KO";
	}
}

if (isset($_SESSION['send-image-extension']) && $_SESSION['send-image-extension'] != "KO")
{
	$maxwidth = 800;
	$maxheight = 600;
	$image_sizes = getimagesize($_FILES['image']['tmp_name']);
	if ($image_sizes[0] > $maxwidth || $image_sizes[1] > $maxheight)
	{
		$_SESSION['send-image-dimensions'] = "KO";
	}
	$date_upload = time(); //in loc de mktime

	$nom = '../../img/galerie/' . $date_upload . $_SESSION['id'] . '.'. $extension_upload;
	$result = move_uploaded_file($_FILES['image']['tmp_name'], $nom);
	if ($result)
	{
		$_SESSION['print_file_uploaded'] = "<img src='".$nom."' style='display:none;' id='uploaded_file' />";

	}

}

echo "<meta http-equiv='refresh' content='0,url=works.php'>";


?>
