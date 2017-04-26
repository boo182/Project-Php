<?php

session_start();
include_once('fantastic_library.php');
include_once('class_user.php');


?>


<!DOCTYPE html>
<html>
<head>
<title>Login</title>
</head>

<body>

<h2>User login</h2>
<!--block of login forms & remember me-->
<form method="post">

<p>
<label for="email">Email:</label>
<div>
<input type="text" name="email" > 
</div>
</p>

<p>
<label for="password">Password:</label>
<div>
<input type="password" name="password" >
</div>
</p>

<p>
<div>
<input type="checkbox" name="remember_me">
<label for="checkbox">Remember me:</label>
</div>
</p>

<p>
<input type="submit" name="login" value="Login">
<input type="submit" name="register" value="Register">
</p>

<p>
forgot <a href="google.com">password</a>
</p>
<?php

// block of verification of user login and password. 
if(isset($_POST['login']))
{
	$test_login=check_login($_POST['email'], $_POST['password']); // verfi du password
	
	if($test_login == 1)
	{
		echo "Invalid user or pass";
	}
	else
	{
		
		header("Location: index.php");
		exit();
	}
}
// block of registration with redirection to inscription.php
if(isset($_POST['register']))
{
header("Location: inscription.php");
	exit();
}

?>

</form>
</body>
</html>
