<?php
session_start();
include_once("fantastic_library.php");

if(isset($_SESSION['email']) && check_if_admin($_SESSION['email']) != 0)
{
	header("Location: index.php");
	exit();
}

$flag = 0;
?>


<!DOCTYPE html>
<html>
<head>
<title>Admin registration</title>
</head>


<body>

<h2>Registration form</h2>

<form method="post">
<!--block of forms: name, email, password and confirmation. As well as remember me-->
<p>
<div>
<label for="name">Name:</label>
<?php 
if(isset($_POST['send']))
{
	$test_name = check_name($_POST['name']);
	if($test_name == 1)
	{
		echo "Invalid Name";
		$flag = 1;
	}

}
?>
</div>
<input type="text" name="name" min="2" max="25"> 
</p>

<p>
<div>
<label for="email">Email:</label>

<!--block of email check-->
<?php
if(isset($_POST['send']))
{
	$exist_mail = if_exist($_POST['email']);
	$test_mail = check_email($_POST['email']);
	if($test_mail == 1)
	{
		echo "Invalid email";
		$flag = 1;
	}
	else if($exist_mail == 1)
	{
		echo "This email already exists!";
		$flag = 1;
	}
}
?>

</div>
<input type="text" name="email" > 
</p>

<p>
<div>
<label for="password">Password:</label>

<!--block of verification of password & pass confirmation-->
<?php
if(isset($_POST['send']))
{
	$test_pass = check_pass($_POST['password'],$_POST['confirm_password']);
	if($test_pass == 1)
	{
		echo "Invalid password or password confirmation";
		$flag = 1;
	}
}
?>

</div>
<input type="password" name="password"  min="3" max="25">
<div>
<label for="confirm_password">Confirm password:</label>
</div>
<input type="password" name="confirm_password"  min="3" max="25">
</p>

<p>
	<label for="admin">User becomes Admin</label>
	<input type="checkbox" name="admin">
</p>

<p>
<input type="submit" name="send" value="Send">	
<input type="button" name="reset" value="Reset">
<input type="submit" name="admin_settings" value="Back">
</p>


<!--block of user creation, if successful-->
<?php
if(isset($_POST['send']) && $flag == 0)
{
	if(isset($_POST['admin']) && $_POST['admin'] == 'on')
	{
		echo "User admin successfully created";
		send_db_admin($_POST['name'], $_POST['email'], $_POST['password'], TRUE);
	}
	else
	{
		echo "User successfully created";
		send_db($_POST['name'], $_POST['email'], $_POST['password']);
	}
	

	
}

else if(isset($_POST['send']) && $flag != 0)
{
	
	echo "Registration failed";
}
if(isset($_POST['admin_settings']))
{
	header("Location: settings_admin.php");
	exit();
}

?>
</form>


</body>
</html>
