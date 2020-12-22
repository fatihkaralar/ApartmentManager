<!-- *@Author Abuzer Fatih KARALAR
 *@Version 25.10.2020 
-->
<?php 
require_once 'dbconnection/dbconnect.php';
session_start();

if (!isset($_SESSION['type'])) {
	header('location: nopermission.php'); //If a user  access the option page without logged in ,the page redirects the user to the nopermission page.
} else if ($_SESSION['type']=="admin"&&!isset($_GET['adminID'])) { 
	header('location: ./AdminOperations/adminHomepage.php');
}elseif ($_SESSION['type']=="user"&&!isset($_GET['userID'])) {
	header('location: ./UserOperations/userHomepage.php');
}
//admins or users can access the options page just using the another pages.They can not access using searchbar




?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Informations</title>
	<link rel="stylesheet" href="./Css/options.css">
</head>

<body>
	<?php 
	$password=md5($_POST['password']);
	$password2=md5($_POST['password2']);
	$phoneNumber=$_POST['phone'];

	?>

	<?php if ($_SESSION['type']=="admin") {
		$adminID=$_GET['adminID'];
		$adminSql="SELECT*FROM admins WHERE adminID='$adminID'";
		$adminQuery=mysqli_query($connect,$adminSql);
		$rowAdmin=mysqli_fetch_assoc($adminQuery);
		$oldNumber=$rowAdmin['phoneNumber'];
		
		?>
		<header> <p id="adminName">Admin:<?php echo ucfirst($rowAdmin['name']); //It prints the name of logged admin.?></p>
			<a href="index.php" title="Homepage"> <img src="./Logos/logo.png" width="100px" height="100px"></a> 
			<a href="./Login/adminLogout.php" title="Logout"><input id="logout" name='logout' type="image" src="./Logos/logout.png" width="40px" height="48px"></a>

		</header>
	<?php }

	else{
		$userID=$_GET['userID'];
		$userSql="SELECT*FROM users WHERE userID='$userID'";
		$userQuery=mysqli_query($connect,$userSql);
		$rowUser=mysqli_fetch_assoc($userQuery);
		$oldNumber=$rowUser['phoneNumber'];


		?>
		<header> <p id="userName">User:<?php echo ucfirst($rowUser['name'])." ".strtoupper($rowUser['surname']); //It prints the name of logged admin.?></p>
			<a href="index.php" title="Homepage"> <img src="./Logos/logo.png" width="100px" height="100px"></a> 
			<a href="./Login/userLogout.php" title="Logout"><input id="logout" name='logout' type="image" src="./Logos/logout.png" width="40px" height="48px"></a>

		</header>
	<?php } ?>

	<?php 
	 //Selecting phone numbers from admins table
	$phoneNumberSql="SELECT phoneNumber FROM admins WHERE phoneNumber='$phoneNumber'";
	$phoneNumberQuery=mysqli_query($connect,$phoneNumberSql);
	$phoneNumberRow=mysqli_fetch_assoc($phoneNumberQuery);
	$countPhoneNumberAdmin=mysqli_num_rows($phoneNumberQuery);

	$phoneNumberUserSql="SELECT phoneNumber FROM users WHERE phoneNumber='$phoneNumber'";
	$phoneNumberUserQuery=mysqli_query($connect,$phoneNumberUserSql);
	$phoneNumberUserRow=mysqli_fetch_assoc($phoneNumberUserQuery);
	$countPhoneNumberUser=mysqli_num_rows($phoneNumberUserQuery);
	$totalCount=$countPhoneNumberUser+$countPhoneNumberAdmin;

	if ($_SESSION['type']=="admin") {
		


		if (isset($_POST['submit'])) {

			if ($password!=$password2) {
				$errorMessage="<p style='color:red;  text-transform: uppercase;font-weight: 300; text-align: center;'>Passwords does not match</p>";
			}elseif ($totalCount!=0&$phoneNumber!=$rowAdmin['phoneNumber']) {
				//If the number is exist in admins or user table and is not equals to the phoneNumber that comes from form,ıt means that this number is used by another admin or user.
				$errorMessage="<p style='color:red;  text-transform: uppercase;font-weight: 300; text-align: center;'>This number is already in use</p>";
			}else{


				$sql="UPDATE admins SET password='$password',phoneNumber='$phoneNumber' WHERE adminID='$adminID'";
				$query=mysqli_query($connect,$sql);
				$row=mysqli_fetch_assoc($query);
				$errorMessage="<p style='color:green;  text-transform: uppercase;font-weight: 300; text-align: center;'>Your informations changed successfully.</p>";
			}
		}
	}
	if ($_SESSION['type']=="user") {
		
        //Selecting phone numbers from users table
		

		if (isset($_POST['submit'])) {

			if ($password!=$password2) {
				$errorMessage="<p style='color:red;  text-transform: uppercase;font-weight: 300; text-align: center;'>Passwords does not match</p>";
			}elseif ($totalCount!=0&$phoneNumber!=$rowUser['phoneNumber']) {
			 //If the number is exist in admins or user table and is not equals to the phoneNumber that comes from form,ıt means that this number is used by another admin or user.
				$errorMessage="<p style='color:red;  text-transform: uppercase;font-weight: 300; text-align: center;'>This number is already in use</p>";
			}else{


				$sql="UPDATE users SET password='$password',phoneNumber='$phoneNumber' WHERE userID='$userID'";
				$query=mysqli_query($connect,$sql);
				$row=mysqli_fetch_assoc($query);
				$errorMessage="<p style='color:green;  text-transform: uppercase;font-weight: 300; text-align: center;'>Your informations changed successfully.</p>";
			  
			}
		}
	}



	?>



	
	<!--- Form for editing informations --->
	<form class="editInformationsForm" method="post">
		<?php echo $errorMessage;?>
		<h1>Edit Informations</h1>
		<input type="password" id="password" name="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
		<input type="password" id="password" name="password2" placeholder="Enter your password again" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
		<input type="tel" id="phone" name="phone" placeholder="xxx-xxx-xxxx" value="<?php echo $oldNumber?>" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" required><br><br>
		<input type="submit" name="submit" value="Add">




	</form>
</body>

</html>