<?php
session_start();
include_once('class_category.php');
include_once('fantastic_library.php');

if(isset($_SESSION['email']) && check_if_admin($_SESSION['email']) != 0)
{
	header("Location: index.php");
	exit();
}


?>

<!DOCTYPE html>
<html>
<head>
<title>NEW CATEGORY</title>
</head>



<body>
<h1>NEW CATEGORY FORM</h1>

	<form method="post">
	<p>
		<div><label for="category_name"> NEW CATEGORY:</label></div>
			<input type="text" name="category_name">
	</p>

	<p>
		<div><label for="category_id"> NEW CATEGORY ID:</label></div>
			<input type="number" name="category_id">	
	</p>
	<p>
		<div><label for="category_image"> NEW CATEGORY IMAGE URL:</label></div>
			<input type="text" name="category_image">	
	</p>


	<p>
		<input type="submit" name="send_category" value="Validate">
		<input type="submit" name="back" value="Back">
	</p>

		
	</form>

<?php


if(isset($_POST['send_category']))
{
	if(check_name($_POST['category_name'])!=0)
	{
		echo "Invalid name";
		$flag = 1;
	}
	else if(!filter_var($_POST['category_image'], FILTER_VALIDATE_URL))
	{
		echo "Invalid URL";
	}
}

if(isset($_POST['back']))
{
	header("Location: settings_admin.php");
	exit();
}




?>

	
