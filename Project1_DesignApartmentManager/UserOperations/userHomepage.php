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
	<title>User Homepage</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
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
	$userID=$row['userID'];
	?>
	
	<header> User: <?php echo $name." ".$surname;  //It prints the name of logged admin.?>
	<i><h5>Outstanding debt: <?php echo $row['rentDebt']."₺"; ?></h5></i>
	<img src="../Logos/logo.png" width="100px" height="100px">
	<a href="../options.php?userID=<?php echo $userID ?>" title="Edit Informations"> <input id="options" name='options' type="image" src="../Logos/options.png" width="30px" height="30px"> </a>
	<a href="../Login/userLogout.php" title="Logout"><input id="logout" name='logout' type="image" src="../Logos/logout.png" width="40px" height="48px"></a>
</header>
<div class="row no-gutters" >
	<div class="col-md-6 no-gutters">
		<div class="leftside d-flex justify-content-center align-items-center"><a href="../UserOperations/adminList.php"><h1 style="color: white;">Show Admins</h1></a></div>

	</div>
	<div class="col-md-6 no-gutters">

		<div class="rightside d-flex justify-content-center align-items-center"><a href="../UserOperations/paymentTransactions.php"><h1 style="color: white;">Payment Transactions</h1></a></div>

	</div>

</div>

</body>
</html>