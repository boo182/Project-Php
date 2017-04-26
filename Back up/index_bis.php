<?php
session_start();
include_once('class_user.php');
include_once('class_admin.php');
include_once('fantastic_library.php');

if(empty($_SESSION['username']))
 {
  header('Location: login.php');
  exit();
 }
 if($_SESSION['admin'] == 0)
 {
  $user1= new user();
  $_SESSION['user'] = $user1;
  
  ?><h3><?php echo"Hello ".$user1->getName()." ready to spend money"?></h3><?php
 }
 else if($_SESSION['admin'] == 1)
 {
  $admin1= new admin();
  ?><h3><?php echo"Hello ".$admin1->getName()." ready to manage this website?"?></h3><?php
 }

?>

<!DOCTYPE html>
<html>
<head>
<title>Inscription of Fantastic Two</title>
<link rel="stylesheet" type="text/css" href="test.css">
</head>



<body>
<form method="post">
<ul>
  <li><a href="home">Home</a></li>
  <li><a href="settings_admin.php">Settings</a></li>
  <li><a href="contacts.php">Contacts</a></li>
  <li style="float:right"><a class="active" href="login.php">Logout</a></li>
</ul>



<input type="submit" name="logout" value="Logout">
<input type="submit" name="settings" value="Settings">


<main>
<p class="center">

<a href="trucks.php">
<div class="container">
<div id="div1"><p>trucks </p>
<img src="truck.jpeg" alt="trucks" style="width:480px;height:180px;">
<div class="overlay">
<div class="text">Trucks</div>
</div>
</div>
</div>
</a>

<a href="cars.php">
<div class="container">
<div id="div2"> <p>cars</p>
<img src="cars.jpeg" alt="cars" style="width:440px;height:200px;">
<div class="overlay">
<div class="text">Cars</div>
</div>
</div>
</div>
</a>

<a href="motocycles.php">
<div class="container">
<div id="div3"><p>motos</p>
<img src="moto.jpeg" alt="Motos" style="width:420px;height:200px;">
<div class="overlay">
<div class="text">Motos</div>
</div>
</div>
</div>
</a>

<a href="bicycles.php">
<div class="container">
<div id="div4"><p>Velo</p>
<img src="velo.jpeg" alt="Velos" style="width:410px;height:200px;">
<div class="overlay">
<div class="text">velos</div>
</div>
</div>
</div>
</a>
</p>
</main>
<?php
if(isset($_POST['logout']))
{
  logout();

}
if(isset($_POST['settings']))
{
  header("Location: user_settings.php");
  exit();
}
?>
</form>
</body>
</html>

