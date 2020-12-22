<!-- *@Author Abuzer Fatih KARALAR
 *@Version 28.10.2020 
-->
<?php
session_start();
require_once '../dbconnection/dbconnect.php';
if ($_SESSION['type']!="user") {
  header('location: ../nopermission.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admins</title>
  <link rel="stylesheet" href="../Css/userList.css">

</head>

<body>
  <?php
    //Database operations for logged admin using SESSION
  $username = $_SESSION['username'];
  $userListSql = "SELECT * FROM users WHERE username='$username'";
  $userListQuery = mysqli_query($connect, $userListSql);
  $row = mysqli_fetch_assoc($userListQuery);
  $userID=$row['userID'];
  ?>

  <!-- This div includes logout button,options button and logo of website  -->
  <div class="upperBox"></div>
  <header> User:<?php echo ucfirst($row['name'])." ".strtoupper($row['surname']);  ?>
  <br>

  <a href="../index.php" title="Homepage"> <img src="../Logos/logo.png" width="100px" height="100px"></a>
  <a href="../options.php?userID=<?php echo $userID ?>" title="Edit Informations"> <input id="options" type="image" src="../Logos/options.png" width="30px" height="30px"> </a>
  <a href="../Login/userLogout.php" title="Logout"><input id="logout" type="image" src="../Logos/logout.png" width="30px" height="45px"></a>

</header>

</div>
<div id="admin">
  
  <header id="title">Apartment Admins</header>

  <table id="admins">

    <tr>
      <th>Row Number</th>
      <th>Name and Surname</th>
      <th> E- mail</th>
      <th>Phone Number</th>
      <th>Send Mail</th>
     
    </tr>
    <?php 
    $adminsSql="SELECT*FROM admins";
    $adminsQuery=mysqli_query($connect,$adminsSql);
    $counter=0;
        while ($adminsRow=mysqli_fetch_assoc($adminsQuery)) { //It list all residents.
          $counter++;
          ?>

          <tr>
           <td><?php echo $counter; ?></td>
           <td><?php echo $adminsRow['name']; ?></td>
           <td><?php echo $adminsRow['mail']; ?></td>
           <td><?php echo $adminsRow['phoneNumber']; ?></td>
           <td><a href="mailto:<?php echo $adminsRow['mail']?>"> <button id="mailButton">Send Mail</button></a></td>
      





         </tr>


       <?php } ?>

     </table>
   </div>


 </body>

 </html>