<!-- *@Author Abuzer Fatih KARALAR
 *@Version 25.10.2020 
-->
<?php 
session_start();
require_once '../dbconnection/dbconnect.php'; //database connection
//If an admin tries to access admin login page without exit the system,here redirects the admin to the admin homepage.
if ($_SESSION['type']=="admin") {
  header('location: ../AdminOperations/adminHomepage.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <!-- Imports login.css file-->
  <link rel="stylesheet" href="../Css/login.css">

</head>

<body>
  <?php 
  
$usernameForm=$_POST['username'];//It is username that came from login form.
$usernamePassword=$_POST['password'];// It is password that came from login form.
$loginSql="SELECT * FROM admins WHERE username='$usernameForm'";
$loginQuery=mysqli_query($connect,$loginSql);
$count=mysqli_num_rows($loginQuery);
$errorMessage="";
//If the username that types from user is exist in the database then the website checks username and password correctness.
if (isset($_POST['submit'])) {
  //If a user have already logged in, the system does not let the user to login again.
  if (!isset($_SESSION['username'])) {



    if ($count>0) {
  $row=mysqli_fetch_assoc($loginQuery);//It fetches a result row as an associative array.
  if (md5($usernamePassword)==$row['password']&&$usernameForm==$row['username']) {
    $_SESSION['username']=$usernameForm;
    $_SESSION['type']="admin";
    header('location:../AdminOperations/adminHomepage.php');
  }
  else{
      //If username exists in database but password is wrong,then here will work.

   $errorMessage= "<p style='color:red;  text-transform: uppercase;font-weight: 300; text-align: center;'>Wrong password or username! </p>";
 }

}else{ //If username does not exist in database,then here will work.
 $errorMessage= "<p style='color:red;  text-transform: uppercase;font-weight: 300; text-align: center;'>Wrong password or username! </p>";
}

}else{//If an admin logged in before and another admin tries to logged into the system, this block terminates the session,if we don't do this ,some admin can access the another admin's accounts using their own password and usernames.
session_unset();
session_destroy();
header('location:adminLogin.php?error=true');

}

}


?>
    <!-- Login form 
    --It takes username and password from user.
  -->
  <div class="loginDiv">
    <form class="loginForm"  method="post">
    	<?php 
      if ($_GET['error']=="true") {
       $errorMessage= "<p style='color:red;  text-transform: uppercase;font-weight: 300; text-align: center;'>A user or admin is already logged into the system.
       The session ended automatically!</p>";
     }
     echo  $errorMessage;
     ?>
     <img id="logo" src="../Logos/logo.png" height="50%" width="50%">

     <h1>Admin Login</h1>
     <input id="username" type="text" name="username" placeholder="Username" required>
     <input id="password" type="password" name="password" placeholder="Password" required>
     <input type="submit" name="submit" value="Login">
   </form>
 </div>


</body>


</html>