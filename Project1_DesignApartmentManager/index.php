<?php 
session_start();
require_once 'dbconnection/dbconnect.php';

//If an admin logged in before and did not exit the system then here redirect the admin to the admin homepage,if a user logged in before and did not exit the system then here redirects the user to user homepage.
if ($_SESSION['type']=="admin") {
	header('location:AdminOperations/adminHomepage.php');
}elseif ($_SESSION['type']=="user") {
	header('location:UserOperations/userHomepage.php');
}



?>
<!DOCTYPE html>
<html>
<head>
	<title>İndex</title>
	<!-- Boostrap used to design this page. -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="Css/index.css">

</head>
<body>


	<div class="row no-gutters" >
		<div class="col-md-6 no-gutters">
			<div class="leftside d-flex justify-content-center align-items-center"><a href="Login/adminLogin.php"><h1 style="color: white;">ADMIN LOGIN</h1></a></div>

		</div>
		<div class="col-md-6 no-gutters">

			<div class="rightside d-flex justify-content-center align-items-center"><a href="Login/userLogin.php"><h1 style="color: white;">USER LOGIN</h1></a></div>

		</div>

	</div>


</body>
</html>