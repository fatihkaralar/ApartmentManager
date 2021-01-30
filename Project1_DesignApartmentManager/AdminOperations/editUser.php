<?php 
session_start();
require_once '../dbconnection/dbconnect.php';
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
	<title>Edit Residents</title>
	<link rel="stylesheet" href="../Css/addUsers.css">
</head>

<body>

	<header> <p id="adminName">Admin:<?php echo $rowAdmin['name']; //It prints the name of logged admin.?></p>
		<a href="../index.php" title="Homepage">	<img src="../Logos/logo.png" width="100px" height="100px"></a>
		<a href="../options.php?adminID=<?php echo $adminID ?>" title="Edit Informations"> <input id="options" name='options' type="image" src="../Logos/options.png" width="30px" height="30px"> </a>
		<a href="../Login/adminLogout.php" title="Logout"><input id="logout" name='logout' type="image" src="../Logos/logout.png" width="30px" height="45px"></a>
		
    </header>


    <?php 

    $userID=$_GET['userID'];
    $editedUserSql="SELECT*FROM users WHERE userID='$userID'";
    $editedUserQuery=mysqli_query($connect,$editedUserSql);
    $editedUserRow=mysqli_fetch_assoc($editedUserQuery);


	if (isset($_POST['submit'])) { //Check if submit button clicked.
		
		$aptNo=$_POST['aptNo'];
		$status=$_POST['status'];
		$mail=test_input($_POST["mail"]);
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
            
            if ($countUsername!=0&$username!=$editedUserRow['username']) {
            	$errorMessage="<p style='color:red;  text-transform: uppercase;font-weight: 300; text-align: center;'>The user already exist! </p>";
            }else{
            	$row=mysqli_fetch_assoc($query);

            	if($countApt!=0& $aptNo!=$editedUserRow['aptNo']){
            	//If apt. number that comes from form  exists in the database,then ıt prints an error message and ıt does not update the apt number of user.
            		$errorMessage="<p style='color:red;  text-transform: uppercase;font-weight: 300; text-align: center;'>This Apt No is being used by someone else!! </p>";

            	}
            	else if ($countMail!=0&$mail!=$editedUserRow['mail']) {
            		//If mail that comes from form  exists in the database,then ıt prints an error message and ıt does not update the mail of user.
            		$errorMessage="<p style='color:red;  text-transform: uppercase;font-weight: 300; text-align: center;'>This mail is being used by someone else! </p>";

            	}

            	else{
            		if ($_SESSION['type']=="admin") {
            			//

            			$sql = "UPDATE users SET aptNo='$aptNo' , mail='$mail' , status='$status' WHERE userID='$userID' ";
            			$result=mysqli_query($connect, $sql);
            			if ($result==0) {
            				$errorMessage="<p style='color:red;  text-transform: uppercase;font-weight: 300; text-align: center;'> User could not added </p>";
            			}else{
            				$errorMessage="<p style='color:lightgreen;  text-transform: uppercase;font-weight: 300; text-align: center;'> User edited successfully. </p>";
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
    $editedUserSql="SELECT*FROM users WHERE userID='$userID'";
    $editedUserQuery=mysqli_query($connect,$editedUserSql);
    $editedUserRow=mysqli_fetch_assoc($editedUserQuery);


    ?>


    <!--- Form for adding a new resident --->
    <form class="addUsersForm" method="post">
    	<?php echo $errorMessage; ?>
    	<h1>Edit resident</h1>
    	<input id="aptNo" title="Apartment number" type="number" name="aptNo" placeholder="Apartment number" max="120" min="1" value="<?php echo $editedUserRow['aptNo'] ?>"  required>
    	<input id="mail" type="Mail" name="mail" placeholder="Mail" value="<?php echo $editedUserRow['mail'] ?>" required>
    	<label for="status"></label>
    	<select name="status" id="status" required>
    		<option value="" disabled selected hidden>Status</option>
    		<option value="Owner" >Owner</option>
    		<option value="Tenant">Tenant</option>
    		<input type="submit" name="submit" value="Add">


    	</form>
    </body>

    </html>