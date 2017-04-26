<?php
session_start();
include_once("class_admin.php");
include_once("fantastic_library.php");
$admin1= new admin();


$flag = 0;
if(isset($_SESSION['username']))
{
	$user1= new user();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>USER SETTINGS</title>
</head>



<body>
<h1>CHANGE SETTINGS</h1>

	<form method="post">

	<p>
	<div>
	<label for="name">New Name:</label>
	<?php
	if(isset($_POST['send']))
	{
		$test_name = $user1->settings_name_check($_POST['name']);
		if($test_name == 1)
		{
			echo "Invalid Name";
			$flag = 1;
		}
	}
	?>
	</div>
	<input type="text" name="name">
	</p>
	<p>
	<div>
	<label>New Email:</label>
	<?php
	if(isset($_POST['send']))
	{

		$boo = $user1->settings_mail_check($_POST['email']);
	
		if($boo == 1)
		{
			echo "Invalid email";
			$flag = 1;
		}
	}

	?>
	</div>
	<input type="text" name="email">
	</p>
	
	<p>
	<div>
	<label>Enter new password:</label>
	</div>
	<input type="password" name="password">
	</p>

	<input type="submit" name="send" value="Change">
	<input type="submit" name="back" value="Back">
	<?php
	
	
	if(isset($_POST['send']) && $flag == 0)
	{
			send_changes_admin($_POST['name'], $_POST['email'], $_SESSION['username'], $_POST['password'], $_GET['id']);
			echo "Settings succesfully modified";
	}
	
	if(isset($_POST['back']))
	{
		header("Location: settings_admin.php");
		exit();
	}



	?>
	</form>



</body>
</html>
