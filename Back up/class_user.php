<?php

include_once('fantastic_library.php');
//include_once('login.php');

class user
{

	protected $name;
	protected $email;
	protected $is_admin;
	protected $password;

	function __construct()
	{
		$this->name = $_SESSION['username'];
		$this->email = $_SESSION['email'];
		$this->is_admin = $_SESSION['admin'];
		$this->password = $_SESSION['password'];

	}
	

//*-*-*-*-*-*-*-*-*-*METHODS USER*-*-*-*-*-*-*-*-*-*//

public function settings_name_check($name)
{

	if(empty($name))
	{	
		return 1;
	}
	else if(strlen($name) < 2 || strlen($name) > 20)
	{
		return 1;
	}
	else
	{
		return 0;
	}

}
public function settings_mail_check($email)
{
	if (empty($email) || !preg_match("#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i", $email))
	{
		return 1;
	}
	else
	{
		return 0;
	}
}
public function check_pass($pass)
{
	
	if(!password_verify($pass, $this->password))
	{
		return 1;
	}
	else
	{
		return 0;
	}
}
public function send_changes($name, $mail, $user)
{
	$bdd = connect_db("localhost", "root", "root", "3306", "pool_php_rush");
	$bdd->exec("UPDATE users SET username = '$name', email = '$mail' where username = '$user'");
	$_SESSION['name'] = $name; 
	$_SESSION['email'] = $mail; 
}







//*-*-*-*-*-*-*-*-*-*FIN METHODS USER*-*-*-**-*-*-*-*//

//-*-*-*-*-*-*-*-*-*GETTER USER *-*-*-*-*-*-*-*-*-*//
function getName()
{
	return $this->name;
}
function getMail()
{
	return $this->email;
}
function getIsadmin()
{
	return $this->is_admin;
}
function getPass()
{
	return $this->password;
}
//*-*-*-*-*-*-*-*-*-*FIN GETTER USER -*-*-*-*-*-*-*-*//

//*-*-*-*-*-*-*-*-*-*SETTER USER-*-*-*-*-*-*-*-*-*-*//
function setName($name)
{
	 $this->name = $name;
}
function setMail($mail)
{
	$this->email = $mail;
}
function setIsadmin($admin)
{
	$this->is_admin = $admin;
}
//-*-*-*-*-*-*--*-*-*FIN GETTER SETTER-*-*-*-*-*-*-*-*//


}



?>