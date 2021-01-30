<?php 
session_start();
require_once '../dbconnection/dbconnect.php';
if ($_SESSION['type']!="admin") {
	header('location: ../nopermission.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Remove User</title>
</head>
<body>
	<?php 
	$userID=$_GET['userID'];
	$debtSql="SELECT amount FROM debts WHERE userID='$userID' AND isPaid=0";
	$debtQuery=mysqli_query($connect,$debtSql);
	$debtRow=mysqli_fetch_assoc($debtQuery);

	if ($_GET['removeUser']=="ok"&&$_SESSION['type']=="admin") {
            //Only admins can remove a user.
		if (!isset($debtRow['amount'])) { 
			// Users with debts cannot be removed
			$removeHistorySql="DELETE FROM paymenthistory WHERE userID='$userID'";
			$removeHistoryQuery=mysqli_query($connect,$removeHistorySql);
			$removeDebtSql="DELETE FROM debts WHERE userID='$userID'";
			$removeDebtQuery=mysqli_query($connect,$removeDebtSql);
			$removeSql="DELETE FROM users WHERE userID='$userID'";
			$removeQuery=mysqli_query($connect,$removeSql);
			header('location:userList.php?isRemoved=true');
		}else{

			header('location:userList.php?error=debtError');
		}
	}else{
		echo "You don't have permission to remove a user";
	}



	?>



</body>
</html>