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
</head>

<body>
<p>To create user or category:
<form method="post">
	<input type="submit" name="create_user" value="New User">
	<input type="submit" name="create_category" value="New Category">

</form> 
</p>
	<ul>
<?php
	$admin1->display_delete_user();

	if(isset($_POST['create_user']))
	{
		header("Location: admin_registration.php");
		exit();
	}
	else if (isset($_POST['create_category']))
	{
		header("Location: category_adding.php");
		exit();
	}
?>
	</ul>

<form action="index.php">
	<input type="submit" name="index" value="Back">
</form>
	
</body>
</html>
