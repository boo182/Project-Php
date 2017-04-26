<?php
session_start();
include_once("class_admin.php");
$admin1= new admin();

if(isset($_SESSION['email']) && check_if_admin($_SESSION['email']) != 0)
{
	header("Location: index.php");
	exit();
}


?>

<!DOCTYPE html>
<html>
<head>
<title>Inscription of Fantastic Two</title>
<link rel="stylesheet" type="text/css" href="style_login.css">
</head>

<body>
<p>
<form method="post">
	<input type="submit" name="create_user" value="New User">
	<input type="submit" name="create_category" value="New Category">
	<input type="submit" name="create_product" value="New Product">
	<input type="submit" name="display_products" value="Display Products">
	<input type="submit" name="display_user" value="Display User">

</form> 
</p>
	<ul>
<?php
	

	if(isset($_POST['create_user']))
	{
		header("Location: admin_registration.php");
		exit();
	}
	if (isset($_POST['display_user']))
	{
		
		$admin1->display_delete_user();
		
	}
	if(isset($_POST['display_products']))
	{
		$admin1->display_delete_products();

	}
	if (isset($_POST['create_category']))
	{
		header("Location: category_adding.php");
		exit();
	}
	if (isset($_POST['create_product']))
	{
		header("Location: product_creation.php");
		exit();
	}
?>
	</ul>

<form action="index.php">
	<input type="submit" name="index" value="Back">
</form>

	
</body>
</html>
