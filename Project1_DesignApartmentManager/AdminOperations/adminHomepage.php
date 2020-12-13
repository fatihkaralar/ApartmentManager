<?php 
session_start();
require_once '../dbconnection/dbconnect.php';//Database connection
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Homepage</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="../Css/adminHomepage.css">
</head>
<body>
	<?php 
//Database operations for logged admin using SESSION
	$username=$_SESSION['username'];
	$homepageSql="SELECT name FROM admins WHERE username='$username'";
	$homepageQuery=mysqli_query($connect,$homepageSql);
	$row=mysqli_fetch_assoc($homepageQuery);
	?>
	
	<header> Admin:<?php echo $row['name']; //It prints the name of logged admin.?>
	<img src="../Logos/logo.png" width="100px" height="100px">
	<a href="../options.php"> <input id="options" name='options' type="image" src="../Logos/options.png" width="30px" height="30px"> </a>
	<a href="../Login/adminLogout.php"><input id="logout" name='logout' type="image" src="../Logos/logout.png" width="30px" height="45px"></a>

</header>

<div class="row no-gutters" >
	<div class="col-md-6 no-gutters">
		<div class="leftside d-flex justify-content-center align-items-center"><a href="../AdminOperations/userList.php"><h1 style="color: white;">Show All Residents</h1></a></div>

	</div>
	<div class="col-md-6 no-gutters">

		<div class="rightside d-flex justify-content-center align-items-center"><a href="../AdminOperations/addUsers.php"><h1 style="color: white;">Add New Residents</h1></a></div>

	</div>

</div>

</body>
</html>