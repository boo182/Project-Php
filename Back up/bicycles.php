<?php
session_start();
include_once('fantastic_library.php');?>

<h1>Bicycles to be sold</h1>

<article>
<form method="post">
<input type="text" name="query">
<input type="submit" name="search" value="Find">
<?php



if(!isset($_POST['search']))
{
	$bdd = connect_db("localhost", "root", "root", "3306", "pool_php_rush");
 	$query = $bdd->query("SELECT * FROM products WHERE category_id = '4'");
 	$res = $query->fetchall(PDO::FETCH_ASSOC);

 foreach ($res as $key => $value) 
    {
        ?>
        <h2><?php echo $value['name']?></h2>
        <p><?php echo $value ['price']?>€</p>
        <?php
    }

}
else if(isset($_POST['search']))
{

	find_it($_POST['query'], 4);

}
?>
</form>
</article>