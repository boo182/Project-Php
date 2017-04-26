<?php
include_once("class_user.php");
class admin extends user
{

function __construct()
{
	$this->name = "admin";
	$this->email = "admin@admin";
	$this->is_admin = 1;
}
//-*-*-*-*-*-*-*ADMIN MEtHODS-*-*-*-*--*-*//
function display_delete_user()
{
	$bdd = connect_db("localhost", "root", "root", "3306", "pool_php_rush");
	$query = $bdd->query("SELECT email, id, username, admin FROM users");
	$my_db = $query->fetchall(PDO::FETCH_ASSOC);
	$query2 = $bdd->query("SELECT id from users where admin = TRUE");
	$admin = $query2->fetchall(PDO::FETCH_ASSOC);
	
	$array_id = array();
	foreach ($admin as $key => $value)
	{
		array_push($array_id, $value['id']);
	}
	

			
	foreach ($my_db as $key => $value)
	{
		$id=$value['id'];
		?>
		<li>
		<div>
		
		<?php 
		echo $value['email'].": ".$value['username'];
		?>
			
			<a href="settings_admin.php?id=<?php echo $id ?>">
			<input type="submit" name="delete" value="delete">
			</a>
			<a href="admin_modify.php?id=<?php echo $id ?>">
			<input type="submit" name="modify" value="modify">
			</a>

			
		
		</div>

		</li><br>
		<?php

			
	}
	
	if(isset($_GET['id']) && in_array($_GET['id'], $array_id) == 0)
	{
		$to_del = $_GET['id'];	
		$bdd->query("DELETE FROM users WHERE id = '$to_del'");
		echo "User successfully deleted.";
	}
	else if (isset($_GET['id']))
	{
		echo "You can't delete an admin!";
	}

}
 


	


}





?>