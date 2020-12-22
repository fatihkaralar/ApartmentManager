<?php 
session_start();
require_once '../dbconnection/dbconnect.php';//Database connection
if (!isset($_SESSION['type'])) { //If someone access the user homepage without session,it is redirected to the login page.
	header('location: ../Login/adminLogin.php');
}elseif ($_SESSION['type']=="user") { //If a user has somehow accessed the admin page, it is redirected to the login page and the session is terminated.
	session_unset();
	session_destroy();

}
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
	$homepageSql="SELECT * FROM admins WHERE username='$username'";
	$homepageQuery=mysqli_query($connect,$homepageSql);
	$row=mysqli_fetch_assoc($homepageQuery);
	$adminID=$row['adminID'];
	?>
	
	<header> Admin:<?php echo $row['name']; //It prints the name of logged admin.?>
	<a href="../index.php" title="Homepage"><img src="../Logos/logo.png" width="100px" height="100px"></a>
	<a href="../options.php?adminID=<?php echo $adminID ?>" title="Edit Informations"> <input id="options" name='options' type="image" src="../Logos/options.png" width="30px" height="30px"> </a>
	<a href="../Login/adminLogout.php" title="Logout"><input id="logout" name='logout' type="image" src="../Logos/logout.png" width="40px" height="48px"></a>
	<a href="addExpense.php" title="Add New Expense"><input id="addExpense" name='addExpense' type="image" src="../Logos/addexpense.png" width="45px" height="45px"></a>
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