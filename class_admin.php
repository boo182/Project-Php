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
//methode qui affiche les users iscrits, et qui peuvent etre delete ou modifier via cette fonction
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
			<form method="post" action="settings_admin.php?id=<?php echo $id ?>">
			<input type="submit" name="display_user" value="delete">
			</form>
			<form action="admin_modify.php?id=<?php echo $id ?>" method="post">
			<input type="submit" name="modify" value="modify">
			</form>

			
		
		</div>

		</li><br>
		<?php

			
	}
	//verification  si user = admin!
	//ne peut etre delete que les user non admin 
	if(isset($_GET['id']) && in_array($_GET['id'], $array_id) == 0)
	{
		$to_del = $_GET['id'];	
		$bdd->query("DELETE FROM users WHERE id = '$to_del'");
		return 0;
	}
	else if (isset($_GET['id']))
	{
		echo "You can't delete an admin!";
	}

}

function display_delete_products()
{
	
		
	$bdd = connect_db("localhost", "root", "root", "3306", "pool_php_rush");
	//verification  si user = admin!
	//ne peut etre delete que les user non admin
	if(isset($_GET['id']))
	{
		$to_del = $_GET['id'];	
		$bdd->query("DELETE FROM products WHERE id = '$to_del'");
		echo "Product successfully deleted.";
		
	}

	$query = $bdd->query("SELECT id, name, price, category_id FROM products");
	$my_db = $query->fetchall(PDO::FETCH_ASSOC);

			
	foreach ($my_db as $key => $value)
	{
		$id=$value['id'];
		?>
		<li>
		<div>
		
		<?php 
		echo $value['name'].": ".$value['price'];
		?>	
			<form method="post" action="settings_admin.php?id=<?php echo $id ?>">
			<input type="submit" name="display_products" value="delete">
			</form>
			<form method="post" action="modify_product.php?id=<?php echo $id ?>">
			<input type="submit" name="modify" value="modify">
			</form>
		</div>
		</li><br>
		<?php		
	}
	
	
	

 }
 public function change_products($id, $name, $price, $cat_id)
{
    $bdd = connect_db("localhost", "root", "root", "3306", "pool_php_rush");
    $query = $bdd->exec("UPDATE products SET name = '$name', price = '$price', category_id = '$cat_id' WHERE id = '$id'");

}
 


	


}





?>