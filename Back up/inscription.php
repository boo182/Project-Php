<?php
include_once("fantastic_library.php");

$flag = 0; //flag d'erreur lors du remplissage des données. 0 = pas d'erreur.
?>


<!DOCTYPE html>
<html>
<head>
<title>Inscription of Fantastic Two</title>
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
	$test_name = check_name($_POST['name']); //lors de l'envoi du formulaire test de validité du nom 
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
	if($test_mail == 1) //verification du format de l'entrée pour le mail
	{
		echo "Invalid email";
		$flag = 1;
	}
	else if($exist_mail == 1) //verification de l'existence de l'user dans la db
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
{	//verification de l'intégrité du pass et de sa confirmation
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
<!-- Boutons d'envoi de reset et de redirection-->
<p>
<input type="submit" name="send" value="Send">	
<input type="button" name="reset" value="Reset"> 
<input type="submit" name="login" value="Login"> 
</p>


<!--block of user creation, if successful-->
<?php
if(isset($_POST['send']) && $flag == 0 ) // verif du flag d'erreur et de l'envoi du form
{
	send_db($_POST['name'], $_POST['email'], $_POST['password']);
	echo "User successfully created";
}
else if(isset($_POST['send']) && $flag != 0) 
{
	echo "Registration failed";
}
if(isset($_POST['login'])) // redirection vers le login
{
	header("Location: login.php");
	exit();
}

?>
</form>


</body>
</html>
