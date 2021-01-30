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
    $debtID=$_GET['debtID'];
    $debtSql="SELECT sum(amount) AS total FROM debts WHERE userID='$userID' AND isPaid=0";
    $debtQuery=mysqli_query($connect,$debtSql);
    $debtRow=mysqli_fetch_assoc($debtQuery);

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
		<i><h5>Outstanding debt: <?php
		if (!isset($debtRow['total'])) {
			echo "0₺";
		}else{

			echo $debtRow['total']."₺";
		} ?></h5></i>
		<a href="../index.php" title="Homepage"> <img src="../Logos/logo.png" width="100px" height="100px"></a> 
		<a href="../options.php?userID=<?php echo $userID ?>" title="Edit Informations"> <input id="options" name='options' type="image" src="../Logos/options.png" width="30px" height="30px"> </a>
		<a href="../Login/userLogout.php" title="Logout"><input id="logout" name='logout' type="image" src="../Logos/logout.png" width="40px" height="48px"></a>
		
	</header>
	<?php 

		if (isset($_POST['submit'])) {   //If submit button clikced then this block works.
			$userID=$rowUser['userID'];

			$username=$_POST['username'];
			$password=md5($_POST['password']);
			$currentDate=date("Y/m/d"); 
			$debtSql="SELECT*FROM debts WHERE debtID='$debtID'";
			$debtQuery=mysqli_query($connect,$debtSql);
			$debtRow=mysqli_fetch_assoc($debtQuery);
			$amount=$debtRow['amount'];
			$details=$debtRow['details'];
			
			
			


			if ($_SESSION['type']=="user") { //If logged user is  resident then resident can pay.Also the resident can type an amount to pay.
				if ($username==$rowUser['username']&&$password==$rowUser['password']) { //If username and password are correct then the residen can pay.


					$sqlUpdate="UPDATE  debts SET isPaid=1 WHERE debtID='$debtID'";
					$updateResult=mysqli_query($connect,$sqlUpdate);
					$sql = "INSERT INTO paymenthistory (paymentID, userID,debtID, amount, details, currentdate) VALUES ( 'NULL', '$userID','$debtID', '$amount',  '$details' , '$currentDate')";
					$result=mysqli_query($connect, $sql);


						header('Location: paymentTransactions.php?userID='.$userID.'&error=noerror');//No error message will be sent if the payment is completed successfully
					}else{
					header('Location: paymentTransactions.php?userID='.$userID.'&error=wrongpassword&debtID='.$debtID);// If username or password is wrong,wrong password error will be sent.
				}
			}
		}
		?>
		<!--- Form for payment --->
		<form class="paymentForm" method="post" autocomplete="off">
			<?php  
			//The error is printed according to the error message from the form.
			if ($_GET['error']=="noerror") {
				$errorMessage= "<p style='color:green;  text-transform: uppercase;font-weight: 300; text-align: center;'>Payment successfully completed. </p>";
			}elseif ($_GET['error']=="wrongpassword") {

				$errorMessage= "<p style='color:red;  text-transform: uppercase;font-weight: 300; text-align: center;'>Wrong password or username! </p>";

			}

			echo $errorMessage;



			?>
			<img id="logo" src="../Logos/logo.png" height="50%" width="50%">
			<h1>Payment</h1>
			<input  type="text" title="Enter your username" autocomplete="off" name="username" placeholder="Username" required>
			<input  type="password" title="Enter your password" name="password" placeholder="Password" required>
			<input type="submit" name="submit" value="Pay">


		</form>
	</body>

	</html>