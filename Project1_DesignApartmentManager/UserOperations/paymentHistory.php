<!-- *@Author Abuzer Fatih KARALAR
 *@Version 22.12.2020 
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
  <title>Payments</title>
  <link rel="stylesheet" href="../Css/userList.css">

</head>

<body>
  <?php
    //Database operations for logged admin using SESSION
  $userID=$_GET['userID'];
  $userSql="SELECT*FROM users WHERE userID='$userID'";
  $userQuery=mysqli_query($connect,$userSql);
  $rowUser=mysqli_fetch_assoc($userQuery);
  ?>

  <!-- This div includes logout button,options button and logo of website  -->
  <div class="upperBox"></div>
  <header> User:<?php echo ucfirst($rowUser['name'])." ".strtoupper($rowUser['surname']);  ?>
  <br>

  <a href="../index.php" title="Homepage"> <img src="../Logos/logo.png" width="100px" height="100px"></a>
  <a href="../options.php?userID=<?php echo $userID ?>" title="Edit Informations"> <input id="options" type="image" src="../Logos/options.png" width="30px" height="30px"> </a>
  <a href="../Login/userLogout.php" title="Logout"><input id="logout" type="image" src="../Logos/logout.png" width="40px" height="48px"></a>

</header>

</div>
<div id="payments">

  <header id="title">Payment History</header>

  <table id="payments">

    <tr>
      <th>Row Number</th>
      <th>Name and Surname</th>
      <th>Payment Amount</th>
      <th>Details</th>
      <th>Payment Date</th>


    </tr>
    <?php 
    $paymentsSql="SELECT*FROM paymenthistory WHERE userID='$userID'"; 
    $paymentsQuery=mysqli_query($connect,$paymentsSql);
    $counter=0;
        while ($paymentsRow=mysqli_fetch_assoc($paymentsQuery)) { //It lists all payments and details for logged resident.
          $counter++;
          ?>

          <tr>
           <td><?php echo $counter; ?></td>
           <td><?php echo ucfirst($rowUser['name'])." ".strtoupper($rowUser['surname']); ?></td>
           <td><?php echo $paymentsRow['amount']."₺"; ?></td>
           <td><?php echo $paymentsRow['details']; ?></td>
           <td><?php  echo  $paymentsRow['currentdate']; ?></td>
         </tr>


       <?php } ?>

     </table>
   </div>


 </body>

 </html>