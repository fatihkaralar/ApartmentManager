
<?php
session_start();
require_once '../dbconnection/dbconnect.php';
//If a user tries to access user login page without exit the system,here redirects the user to the user homepage.
if ($_SESSION['type']=="user") {
   header('location: ../UserOperations/userHomepage.php');
}elseif ($_SESSION['type']=="admin") {
 header('location:../AdminOperations/adminHomepage.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <!-- Imports login.css file-->
    <link rel="stylesheet" href="../Css/login.css">

</head>

<body>
     <?php 
 


$usernameForm=$_POST['username'];//It is username that came from login form.
$usernamePassword=$_POST['password'];// It is password that came from login form.
$loginSql="SELECT * FROM users WHERE username='$usernameForm'";
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
    $_SESSION['type']="user";
    header('location:../UserOperations/userHomepage.php');
  }
  else{
      //If username exists in database but password is wrong,then here will work.

   $errorMessage= "<p style='color:red;  text-transform: uppercase;font-weight: 300; text-align: center;'>Wrong password or username! </p>";
 }

}else{ //If username does not exist in database,then here will work.
   $errorMessage= "<p style='color:red;  text-transform: uppercase;font-weight: 300; text-align: center;'>Wrong password or username! </p>";
}

}else{

   $errorMessage= "<p style='color:red;  text-transform: uppercase;font-weight: 300; text-align: center;'>You have already logged in.Automatically exitting the system.!</p>";
  session_unset();
  session_destroy();
}

}


?>
    <!-- Login form 
    --It takes username and password from user.
-->
<div class="loginDiv">
    <form class="loginForm" action="" method="post">
        <?php echo  $errorMessage; ?>
        <img id="logo" src="../Logos/logo.png" height="50%" width="50%">

        <h1>Login</h1>
        <input id="username" type="text" name="username" placeholder="Username">
        <input id="password" type="password" name="password" placeholder="Password">
        <input type="submit" name="submit" value="Login">

    </form>
</div>
</body>

</html>