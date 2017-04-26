<?php


#fonction de connnexion à la DB
const ERROR_LOG_FILE="error.log";
function connect_db($host, $username, $passwd, $port, $db)
 {
 	$dsn = "mysql:host=".$host.";dbname=".$db.";port=".$port;
	$user_name = $username;
	$password = $passwd;
 	
	try
    {
	   $dbh = new PDO($dsn, $user_name, $password);
    }
    catch (PDOException $e)
    {	
	   echo "PDO ERROR: ".$e->getMessage()." storage in ".ERROR_LOG_FILE."\n";
	   file_put_contents (ERROR_LOG_FILE, $e->getMessage());
	   return false;
    }

 	return $dbh;

 }



#to check if name field is ok
function check_name($name)
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

//Verification de la validité de l'email entré par l'user
function check_email($mail)
{
	if (empty($mail) || !preg_match("#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i", $mail))
	{
		return 1;
	}
	else
	{
		return 0;
	}

}

//verification de la concordance du pass et de sa confirmation
function check_pass($pass, $pass_conf)
{
	if((strlen($pass) < 3 || strlen($pass) > 20) || ($pass != $pass_conf))
	{	
		return 1;
	}
	else
	{
		return 0;
	}

}

//envoi du formaulaire vers la db
function send_db($name, $mail, $pass)
{

	$hash = password_hash($pass, PASSWORD_BCRYPT);	
	$bdd = connect_db("localhost", "root", "root", "3306", "pool_php_rush");
	$query = $bdd->exec("INSERT INTO users  VALUES ('', '$name', '$hash','$mail', FALSE )");
}

//envoi de la base de donnée vers la db en mode admin
function send_db_admin($name, $mail, $pass, $admin)
{

	$hash = password_hash($pass, PASSWORD_BCRYPT);	
	$bdd = connect_db("localhost", "root", "root", "3306", "pool_php_rush");
	$query = $bdd->exec("INSERT INTO users VALUES ('', '$name', '$hash','$mail', '$admin')");
}

//verification de l'utilisateur connecté, renvoie 1 si pas d'user connecté
function check_login($email, $pass)
{
	$bdd = connect_db("localhost", "root", "root", "3306", "pool_php_rush");
	$query=$bdd->query("SELECT password, email, username, admin  FROM users WHERE email = '$email'");
	$hash = $query->fetch(PDO::FETCH_ASSOC); 
	
	if(password_verify($pass, $hash['password']))
	{
		$_SESSION['email'] = $hash['email'];
		$_SESSION['username'] = $hash['username'];
		$_SESSION['admin'] = $hash['admin'];
		$_SESSION['password'] = $hash['password'];
		

		return 0;
	}
	else 
	{
		return 1;
	}

}

//fonction logout qui détruit la session et renvoie vers la page login
function logout()
{
	if($user1)
	{
		unset($user1);
	}
	else if($admin1)
	{
		unset($admin1);
	}
	
	unset($_SESSION['username']);
	session_destroy();
	header('Location: login.php');
}

//verification de l'existence d'un user existant dans la db. Renvoie 1 en cas d'existence de l'user
function if_exist($email)
{
	$bdd = connect_db("localhost", "root", "root", "3306", "pool_php_rush");
	$query=$bdd->query("SELECT email FROM users WHERE email = '$email'");
	$check_query = $query->fetch(PDO::FETCH_ASSOC); 
	
	if($check_query == FALSE)
	{	
		return 0;
	}
	else
	{
		return 1;
	}
}
 //verification de la valeur admin dans la db pour un user donné renvoie 0 en cas de concordance
function check_if_admin($email)
{

	$bdd = connect_db("localhost", "root", "root", "3306", "pool_php_rush");
	$query=$bdd->query("SELECT admin FROM users WHERE email = '$email' ");
	$admin_query = $query->fetch(PDO::FETCH_ASSOC); 

	if ($admin_query['admin'] == 1)
	{ 
        return 0;
	}
    else
    {
        return 1;
    }
}	

//envoie du formulaire vers la db en mode admin	
function send_changes_admin($name, $mail, $user,$pass, $id)
{
	$hash = password_hash($pass, PASSWORD_BCRYPT);
	$bdd = connect_db("localhost", "root", "root", "3306", "pool_php_rush");
	$bdd->exec("UPDATE users SET username = '$name', email = '$mail', password = '$hash' where id = '$id'");
	
}
//fonction de moteur de recherche interne au site
function find_it($word, $cat_id)
{    
    $bdd = connect_db("localhost", "root", "root", "3306", "pool_php_rush");
  	$query = $bdd->query("SELECT * FROM products WHERE name COLLATE UTF8_GENERAL_CI LIKE '%$word%' AND category_id = '$cat_id'");
  	$res = $query->fetchall(PDO::FETCH_ASSOC); 
  	

    foreach ($res as $key => $value) 
    {
        ?>
        <h2><?php echo $value['name']?></h2>
        <p><?php echo $value ['price']?>€</p>
        <?php
    }
}


?>