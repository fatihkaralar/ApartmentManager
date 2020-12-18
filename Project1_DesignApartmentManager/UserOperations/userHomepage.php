<?php 
require_once '../dbconnection/dbconnect.php';
session_start();
if (!isset($_SESSION['type'])) { //If someone access the user homepage without session,it is redirected to the login page.
header('location: ../Login/userLogin.php');
}elseif ($_SESSION['type']=="admin") { //If an admin has somehow accessed the user page, it is redirected to the login page and the session is terminated.
	session_unset();
	session_destroy();
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>UserHomepage</title>
	<link rel="stylesheet"  href="../Css/userHomepage.css">
</head>
<body>
	<?php 
//Database operations for logged admin using SESSION
	$username=$_SESSION['username'];
	$homepageSql="SELECT * FROM users WHERE username='$username'";
	$homepageQuery=mysqli_query($connect,$homepageSql);
	$row=mysqli_fetch_assoc($homepageQuery);
	$name=ucfirst($row['name']); //The first character of name of the user will be uppercase
	$surname=strtoupper($row['surname']); //The surname of user will be uppercase.
	?>
	
	<header> User: <?php echo $name." ".$surname; //It prints the name of logged admin.?>
	<img src="../Logos/logo.png" width="100px" height="100px">
	<a href="../options.php"> <input id="options" name='options' type="image" src="../Logos/options.png" width="30px" height="30px"> </a>
	<a href="../Login/userLogout.php"><input id="logout" name='logout' type="image" src="../Logos/logout.png" width="30px" height="45px"></a>


</body>
</html>