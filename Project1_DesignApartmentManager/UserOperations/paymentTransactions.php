<!--- 
-Author: Abuzer Fatih KARALAR
-Version: 22.12.2020
--->
<?php
session_start();
require_once '../dbconnection/dbconnect.php'; //Database connection
if ($_SESSION['type']!="user") {
	header('location: ../nopermission.php');
}else{
	$username=$_SESSION['username'];
	$userSql="SELECT * FROM users WHERE username='$username'";
	$userQuery=mysqli_query($connect,$userSql);
    $rowUser=mysqli_fetch_assoc($userQuery);     //Name of logged resident comes from the database and pritns to the page.
    $userID=$rowUser['userID'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Payment Transactions</title>
	<link rel="stylesheet" href="../Css/paymentTransactions.css">
</head>

<body>

	<header> <p id="userName">User:<?php echo ucfirst($rowUser['name'])." ".strtoupper($rowUser['surname']); //It prints the name of logged admin.?></p>
		<i><h5>Outstanding debt: <?php echo $rowUser['rentDebt']."₺"; ?></h5></i>
		<a href="../index.php" title="Homepage"> <img src="../Logos/logo.png" width="100px" height="100px"></a> 
		<a href="../options.php?userID=<?php echo $userID ?>" title="Edit Informations"> <input id="options" name='options' type="image" src="../Logos/options.png" width="30px" height="30px"> </a>
		<a href="../Login/userLogout.php" title="Logout"><input id="logout" name='logout' type="image" src="../Logos/logout.png" width="40px" height="48px"></a>
		<a href="paymentHistory.php?userID=<?php echo $userID ?>" title="Payment History"><input id="history" type="image" name="history" src="../Logos/history.png" width="35px" height="35px"></a>
	</header>
	<?php 

		if (isset($_POST['submit'])) {   //If submit button clikced then this block works.
			$userID=$rowUser['userID'];
			$amount=$_POST['amount'];
			$username=$_POST['username'];
			$password=md5($_POST['password']);
			$currentDate=date("Y/m/d"); 
			$details=$_POST['details'];
			$newRentDebt=$rowUser['rentDebt']-$amount;
			$errorMessage= "<b><p style='color:green; text-transform: uppercase;font-weight: 500; text-align: center;'>Payment successfully completed</p></b>";


			if ($_SESSION['type']=="user") { //If logged user is  resident then resident can pay.Also the resident can type an amount to pay.
				if ($username==$rowUser['username']&&$password==$rowUser['password']) { //If username and password are correct then the residen can pay.

					if($rowUser['rentDebt']!=0){
						if ($newRentDebt>=0) { // Debt can not be negative.


							$sql = "INSERT INTO paymenthistory (paymentID, userID, amount, details, currentdate) VALUES ( 'NULL', '$userID', '$amount',  '$details' , '$currentDate')";
							$result=mysqli_query($connect, $sql);

							$userSql="UPDATE users SET rentDebt='$newRentDebt' WHERE userID='$userID'";
							$userQuery=mysqli_query($connect,$userSql);
						}else{
							$errorMessage= "<p style='color:red;  text-transform: uppercase;font-weight: 300; text-align: center;'>Invalid Payment Amount</p>";
						}

					}
					else{
						$errorMessage= "<p style='color:red;  text-transform: uppercase;font-weight: 300; text-align: center;'>You have no debt </p>";
					}


				}else{
					$errorMessage= "<p style='color:red;  text-transform: uppercase;font-weight: 300; text-align: center;'>Wrong password or username! </p>";
				}
			}
		}
		?>
		<!--- Form for payment --->
		<form class="paymentForm" method="post">
			<?php echo $errorMessage; ?>
			<img id="logo" src="../Logos/logo.png" height="50%" width="50%">
			<h1>Payment</h1>
			<input id="amount" title="Please enter amount" type="number" name="amount" placeholder="Amount" step="0.001" min="0" max="<?php echo $rowUser['rentDebt']; ?>" required>
			<textarea id="details" name="details" placeholder="Details of Payment" required></textarea>
			<input  type="text" title="Enter your username" name="username" placeholder="Username" required>
			<input  type="password" title="Enter your password" name="password" placeholder="Password" required>
			<input type="submit" name="submit" value="Pay">


		</form>
	</body>

	</html>