
<?php
session_start();
require_once '../dbconnection/dbconnect.php';
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

    <!-- Login form 
    --It takes username and password from user.
    -->
    <div class="loginDiv">
        <form class="loginForm" action="../UserOperations/userHomepage.php" method="post">
            <img id="logo" src="../Logos/logo.png" height="50%" width="50%">

            <h1>Login</h1>
            <input type="text" name="" placeholder="Username">
            <input type="password" name="" placeholder="Password">
            <input type="submit" name="" value="Login">

        </form>
    </div>
</body>

</html>