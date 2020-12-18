<!-- *@Author Abuzer Fatih KARALAR
 *@Version 28.10.2020 
-->
<?php
session_start();
require_once '../dbconnection/dbconnect.php';
if ($_SESSION['type']!="admin") {
    header('location: ../nopermission.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="../Css/userList.css">

</head>

<body>
    <?php
    //Database operations for logged admin using SESSION
    $username = $_SESSION['username'];
    $userListSql = "SELECT name FROM admins WHERE username='$username'";
    $userListQuery = mysqli_query($connect, $userListSql);
    $row = mysqli_fetch_assoc($userListQuery);
    ?>

    <!-- This div includes logout button,options button and logo of website  -->
    <div class="upperBox"></div>
    <header> Admin:<?php echo $row['name'];  ?>
    <br>

    <img src="../Logos/logo.png" width="100px" height="100px">
    <a href="../options.php"> <input id="options" type="image" src="../Logos/options.png" width="30px" height="30px"> </a>
    <a href="../Login/adminLogout.php"><input id="logout" type="image" src="../Logos/logout.png" width="30px" height="45px"></a>

</header>
</div>
<div id="user">
    <!--Js codes lists users here-->
    <header id="title">Apartment Residents</header>

    <table id="users">

        <tr>
            <th>Row Number</th>
            <th>Name and Surname</th>
            <th>Apartment number</th>
            <th> Status </th>
            <th> E- mail</th>
            <th> Rent Debt</th>
            <th>Edit User</th>
            <th>Send Mail</th>
            <th>Remove User</th>
        </tr>
        <?php 
        $residentsSql="SELECT*FROM users";
        $residentQuery=mysqli_query($connect,$residentsSql);
        $counter=0;
        while ($residentRow=mysqli_fetch_assoc($residentQuery)) { //It list all residents.
          $counter++;
          ?>

          <tr>
           <td><?php echo $counter; ?></td>
           <td><?php echo ucfirst($residentRow['name'])." ".strtoupper($residentRow['surname']); ?></td>
           <td><?php echo $residentRow['aptNo']; ?></td>
           <td><?php echo $residentRow['status']; ?></td>
           <td><?php echo $residentRow['mail']; ?></td>
           <td><?php echo $residentRow['rentDebt']; ?></td>
           <td><a href="editUser.php?userID=<?php echo $residentRow['userID'] ?>"><button id="editButton">Edit User</button></a> </td>
           <td><a href="mailto:<?php echo $residentRow['mail']?>"> <button id="mailButton">Send Mail</button></a></td>
           <td><a href="removeUser.php?userID=<?php echo $residentRow['userID'] ?>&removeUser=ok"> <button id="removeButton">Remove User</button></a></td>





       </tr>


   <?php } ?>

</table>
</div>
<?php 
if ($_GET['error']=="debtError") { //If a user have debt,then the method prints an error message.
   $errorMessage= "<b><p style='color:black; text-transform: uppercase;font-weight: 500; text-align: center;'>You cannot delete users who have not paid their debts </p></b>";
   echo $errorMessage;
}elseif ($_GET['isRemoved']=="true") {
    $errorMessage= "<b><p style='color:black; text-transform: uppercase;font-weight: 500; text-align: center;'>The user removed successfully. </p></b>";
    echo $errorMessage;
}




?>

</body>

</html>