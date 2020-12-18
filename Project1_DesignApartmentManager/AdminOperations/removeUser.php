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
	$userSql="SELECT rentDebt FROM users WHERE userID='$userID'";
	$userQuery=mysqli_query($connect,$userSql);
	$userRow=mysqli_fetch_assoc($userQuery);

if ($_GET['removeUser']=="ok"&&$_SESSION['type']=="admin") {//Only admins can remove a user.
	if ($userRow['rentDebt']==0) {
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