<?php
session_start();
include_once("class_user.php");
include_once("fantastic_library.php");


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
<link rel="stylesheet" type="text/css" href="style_login.css">
</head>



<body>
<h1>CHANGE YOUR SETTINGS</h1>
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
	<label>Enter your password:</label>
	</div>
	<input type="password" name="password">
	</p>

	<input type="submit" name="send" value="Change">
	<input type="submit" name="index" value="Home">
	<?php
	
	
	if(isset($_POST['send']) && $flag == 0)
	{
		$pass_check = $user1->check_pass($_POST['password']);
		if($pass_check == 0)
		{
			$user1->send_changes($_POST['name'], $_POST['email'], $_SESSION['username']);
			echo "Settings succesfully modified";
		}
		else
		{
			echo "invalid Password";
		}
		
	}
	if(isset($_POST['index']))
	{
		header("Location: index.php");
		exit();
	}



	?>
	</form>



</body>
</html>
