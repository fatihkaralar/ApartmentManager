 <!--- 
-Author: Abuzer Fatih KARALAR
-Version: 29.11.2020
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
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Add Residents</title>
	<link rel="stylesheet" href="../Css/addUsers.css">
</head>

<body>

	<header> <p id="adminName">Admin:<?php echo $rowAdmin['name']; //It prints the name of logged admin.?></p>
     <a href="../index.php"> <img src="../Logos/logo.png" width="100px" height="100px"></a> 
     <a href="../options.php"> <input id="options" name='options' type="image" src="../Logos/options.png" width="30px" height="30px"> </a>
     <a href="../Login/adminLogout.php"><input id="logout" name='logout' type="image" src="../Logos/logout.png" width="30px" height="45px"></a>




     <?php 
     

	if (isset($_POST['submit'])) { //Check if submit button clicked.
		$name=$_POST['name'];
		$surname=$_POST['surname'];
		$aptNo=$_POST['aptNo'];
		$rentDebt=0;
		$status=$_POST['status'];
		$mail=test_input($_POST["mail"]);
		$username=strtolower($name).strtolower($surname);
		$password=md5(strtolower($surname));
		$errorMessage="";
		
    // check if e-mail address is well-formed
		if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
			$errorMessage = "<p style='color:red;  text-transform: uppercase;font-weight: 300; text-align: center;'>Invalid email format </p>";
		}else{

			$sql="SELECT*FROM users WHERE username='$username'";
			$query=mysqli_query($connect,$sql);
			$countUsername=mysqli_num_rows($query); //Check if username already exist.
			$sqlMail="SELECT*FROM users WHERE mail='$mail'";
			$queryMail=mysqli_query($connect,$sqlMail);
            $countMail=mysqli_num_rows($queryMail);//Check if mail already exist.
            $sqlApt="SELECT*FROM users WHERE aptNo='$aptNo'";
            $queryApt=mysqli_query($connect,$sqlApt);
            $countApt=mysqli_num_rows($queryApt);//Check if Apt. No already exist.
            
            if ($countUsername!=0) {
            	$errorMessage="<p style='color:red;  text-transform: uppercase;font-weight: 300; text-align: center;'>The user already exist! </p>";
            }else{
            	$row=mysqli_fetch_assoc($query);

            	if($countApt!=0||$countMail!=0){//If mail or apt. number that comes from form  exists in the database,then ıt prints an error message and ıt does not add to the database.

            		$errorMessage="<p style='color:red;  text-transform: uppercase;font-weight: 300; text-align: center;'>Mail or apt. number  already exists! </p>";
            	}else{
            		if (isset($_SESSION['username'])) {
            			
                      
                      $sql = "INSERT INTO users (userID, username, password, name, surname, aptNo, status, mail,rentDebt,phoneNumber) VALUES ( 'NULL', '$username', '$password', '$name', '$surname' , '$aptNo', '$status', '$mail',$rentDebt,'NULL')";
                      $result=mysqli_query($connect, $sql);
                      if ($result==0) {
                         $errorMessage="<p style='color:red;  text-transform: uppercase;font-weight: 300; text-align: center;'> User could not added </p>";
                     }else{
                         $errorMessage="<p style='color:lightgreen;  text-transform: uppercase;font-weight: 300; text-align: center;'> User added successfully. </p>";
                     }
                 }

             }
         }
     }
 }
//Email verification function.
 function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>


<!--- Form for adding a new resident --->
<form class="addUsersForm" method="post">
   <?php echo $errorMessage; ?>
   <h1>Add new resident</h1>
   <input id="name" type="text" name="name" placeholder="Name " required>
   <input id="surname" type="text" name="surname" placeholder="Surname" required>
   <input id="aptNo" type="number" name="aptNo" placeholder="Apartment number" required>
   <input id="mail" type="Mail" name="mail" placeholder="Mail" required>
   <label for="status"></label>
   <select name="status" id="status" required>
      <option value="" disabled selected hidden>Status</option>
      <option value="Owner" >Owner</option>
      <option value="Tenant">Tenant</option>
      <input type="submit" name="submit" value="Add">


  </form>
</body>

</html>