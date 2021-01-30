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
	<title>Debts</title>
	<link rel="stylesheet" href="../Css/expensesList.css">

</head>

<body>

	<!-- This div includes logout button,options button and logo of website  -->
	<div class="upperBox"></div>
	<header> User:<?php echo ucfirst($rowUser['name'])." ".strtoupper($rowUser['surname']);  ?>
	<br>
	
	<a href="../index.php" title="Homepage"> <img src="../Logos/logo.png" width="100px" height="100px"></a>
	<a href="../options.php?userID=<?php echo $userID ?>" title="Edit Informations"> <input id="options" type="image" src="../Logos/options.png" width="30px" height="30px"> </a>
	<a href="../Login/userLogout.php" title="Logout"><input id="logout" type="image" src="../Logos/logout.png" width="40px" height="48px"></a>
	

</header>

</div>
<div id="expenses">

	<header id="title">Debts List</header>

	<table id="expenses">

		<tr>
			<th>Row Number</th>
			<th>Amount</th>
			<th>Details</th>
			<th>Pay</th>


		</tr>
		<?php 
		$debtsSql="SELECT*FROM debts WHERE userID='$userID' AND isPaid=0"; 
		$debtsQuery=mysqli_query($connect,$debtsSql);
		$counter=0;
        while ($debtsRow=mysqli_fetch_assoc($debtsQuery)) { //It lists all expenses and details for logged resident.
        	$counter++;
        	$debtID=$debtsRow['debtID'];
        	?>

        	<tr>
        		<td><?php echo $counter; ?></td>
        		<td><?php echo $debtsRow['amount']."₺"; ?></td>
        		<td><?php echo $debtsRow['details']; ?></td>
        		<td> <a href="paymentTransactions.php?userID=<?php echo $userID ?>&&debtID=<?php echo $debtID ?>"><button id="payButton">Pay the debts</button></a> </td>
        	</tr>


        	<?php 
        } 
        ?>

    </table>
</div>


</body>

</html>