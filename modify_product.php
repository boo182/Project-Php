<?php

session_start();
include_once("class_admin.php");
include_once("fantastic_library.php");
$admin1= new admin();
$flag = 0;


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Modify Products</title>
	<link rel="stylesheet" type="text/css" href="style_login.css">
</head>
<body>
<h1>MODIFY PRODUCTS</h1>
<form method="post">

<div class="center">
	<p id="buttons">
	
	<p>
		<div><label for="name"> Product name modification:</label></div>
			<input type="text" name="prod_name">
	</p>
	<p>
		<div><label for="name"> New price:</label></div>
			<input type="number" name="price">
	</p>
<p>
	<div><label for="category"> New category: </label></div>
			<select name="category"> 
				<option>1</option>
				<option>2</option>
				<option>3</option>
				<option>4</option>

			</select>
</p>
<p>
	
			<input type="submit" name="modify_product" value="Validate">
			<input type="submit" name="back" value="Back">

</p>
			</body>
</html>

<?php
if (isset($_POST['modify_product']))
{

}

if(isset($_POST['modify_product']))
{
	if(check_name($_POST['prod_name'])!=0)
	{
		echo "Invalid name";
		$flag = 1;
	}
	else if(is_int($_POST['price']))
	{
		echo "Invalide Price";
		$flag = 1;
	}	
	
	if($flag == 0)
	{

		$admin1->change_products($_GET['id'], $_POST['prod_name'], $_POST['price'], $_POST['category']);
		echo $_POST['prod_name']." modified successfully";
	}
}

if(isset($_POST['back']))
{
	header("Location: settings_admin.php");
	exit();
}




?>











