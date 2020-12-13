<?php 
session_start();
require_once 'dbconnection/dbconnect.php';
if (isset($_SESSION['username'])) {
	header('location:AdminOperations/adminHomepage.php');
}



 ?>
<!DOCTYPE html>
<html>
<head>
	<title>İndex</title>
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