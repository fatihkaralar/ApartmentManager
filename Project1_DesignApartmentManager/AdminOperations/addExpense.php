<!--- 
-Author: Abuzer Fatih KARALAR
-Version: 20.12.2020
--->
<?php
session_start();
require_once '../dbconnection/dbconnect.php'; //Database connection
if ($_SESSION['type']!="admin") {
	header('location: ../nopermission.php');
}else{
	$usernameAdmin=$_SESSION['username'];
	$adminSql="SELECT * FROM admins WHERE username='$usernameAdmin'";
	$adminQuery=mysqli_query($connect,$adminSql);
    $rowAdmin=mysqli_fetch_assoc($adminQuery);     //Name of logged admin comes from the database and pritns to the page.
    $adminID=$rowAdmin['adminID'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Add Expense</title>
	<link rel="stylesheet" href="../Css/addExpense.css">
</head>

<body>

	<header> <p id="adminName">Admin:<?php echo $rowAdmin['name']; //It prints the name of logged admin.?></p>
		<a href="../index.php" title="Homepage"> <img src="../Logos/logo.png" width="100px" height="100px"></a> 
		<a href="../options.php?adminID=<?php echo $adminID ?>" title="Edit Informations"> <input id="options" name='options' type="image" src="../Logos/options.png" width="30px" height="30px"> </a>
		<a href="../Login/adminLogout.php" title="Logout"><input id="logout" name='logout' type="image" src="../Logos/logout.png" width="40px" height="48px"></a>
	</header>
	<?php 

		if (isset($_POST['submit'])) {   //If submit button clikced then this block works.
			$adminID=$rowAdmin['adminID'];
			$amount=$_POST['amount'];
			$details=$_POST['details'];
			$currentDate=date("Y/m/d"); 
			$errorMessage= "<b><p style='color:green; text-transform: uppercase;font-weight: 500; text-align: center;'>Expense added successfully</p></b>";

			if ($_SESSION['type']=="admin") { //If logged user is an admin then he can add expenses.The amount of expenses divides among all residents.And this block ınserts the expense informations to the expenses table of database.


				$sql = "INSERT INTO expenses (expenseID, amount, details, adminID, currentdate) VALUES ( 'NULL', '$amount', '$details',  '$adminID' , '$currentDate')";
				$result=mysqli_query($connect, $sql);
				$userListSql="SELECT*FROM users";
				$userListQuery=mysqli_query($connect,$userListSql);
				$count=mysqli_num_rows($userListQuery); //resident number of the apartment.

				while ($userListRow=mysqli_fetch_assoc($userListQuery)) { // The expense amount is added to all users
					$userID=$userListRow['userID'];
					$addedAmount=($amount/$count);
					$sqlupdate = "INSERT INTO debts (debtID,userID,amount,details,isPaid) VALUES ('NULL','$userID','$addedAmount','$details','0')";
					$result=mysqli_query($connect, $sqlupdate);

				}


			}
		}
		?>
		<!--- Form for adding a new expense --->
		<form class="addExpenseForm" method="post">
			<?php echo $errorMessage; ?>
			<img id="logo" src="../Logos/logo.png" height="50%" width="50%">
			<h1>Add new expense</h1>
			<input id="amount" type="number" name="amount" placeholder="Amount" step="0.001" min="0" required>
			<textarea id="details" name="details" placeholder="Details of Expense" required></textarea>
			<input type="submit" name="submit" value="Add">


		</form>
	</body>

	</html>