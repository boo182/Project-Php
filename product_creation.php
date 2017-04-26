<?php
session_start();
include_once('class_category.php');
include_once('class_product.php');
include_once('fantastic_library.php');
$product1 = new product();
$category1 = new category();
$flag = 0;

if(isset($_SESSION['email']) && check_if_admin($_SESSION['email']) != 0)
{
	header("Location: index.php");
	exit();
}


?>

<!DOCTYPE html>
<html>
<head>
<title>NEW PRODUCT MANAGEMENT</title>
<link rel="stylesheet" type="text/css" href="style_login.css">
</head>



<body>
<h1>NEW PRODUCT MANAGEMENT</h1>

	<form method="post">
	<p>
		<div><label for="category_name"> NEW PRODUCT:</label></div>
			<input type="text" name="product_name">
	</p>
	<p>
		<div><label for="category_name"> NEW PRODUCT PRICE (in €):</label></div>
			<input type="number" name="product_price">
	</p>

	<p>
		<div><label for="product_id"> NEW PRODUCT CATEGORY ID:</label></div>
			<select name="product_id">

			<?php
				$category1->display_category();
			?>
			</select>
	</p>

	<p>
		<input type="submit" name="send_product" value="Validate">
		<input type="submit" name="back" value="Back">
	</p>

		
	</form>


<?php


if(isset($_POST['send_product']))
{
	if(check_name($_POST['product_name'])!=0)
	{
		echo "Invalid name";
		$flag = 1;
	}
	else if(is_int($_POST['product_price']))
	{
		echo "Invalide Price";
		$flag = 1;
	}	
	
	if($flag == 0)
	{

		$product1->add_product($_POST['product_name'], $_POST['product_id'], $_POST['product_price']);
		echo $_POST['product_name']." added successfully";
	}
}

if(isset($_POST['back']))
{
	header("Location: settings_admin.php");
	exit();
}




?>

	
