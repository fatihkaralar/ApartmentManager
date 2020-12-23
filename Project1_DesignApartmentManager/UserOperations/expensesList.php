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
  <link rel="stylesheet" href="../Css/expensesList.css">

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
<div id="expenses">

  <header id="title">Expenses List</header>

  <table id="expenses">

    <tr>
      <th>Row Number</th>
      <th>Admin Name</th>
      <th>Admin Phone Number</th>
      <th>Amount</th>
      <th>Details</th>
      <th>Date of Upload</th>


    </tr>
    <?php 
    $expensesSql="SELECT*FROM expenses "; 
    $expensesQuery=mysqli_query($connect,$expensesSql);
    $counter=0;
        while ($expensesRow=mysqli_fetch_assoc($expensesQuery)) { //It lists all expenses and details for logged resident.
          $counter++;
          $expenseID=$expensesRow['expenseID'];
          $adminID=$expensesRow['adminID'];
          $adminSql="SELECT * FROM admins WHERE adminID='$adminID'";
          $adminQuery=mysqli_query($connect,$adminSql);
          $adminRow=mysqli_fetch_assoc($adminQuery);


          ?>

          <tr>
           <td><?php echo $counter; ?></td>
           <td><?php echo $adminRow['name']; ?></td>
           <td><?php echo $adminRow['phoneNumber']; ?></td>
           <td><?php echo $expensesRow['amount']."₺"; ?></td>
           <td><?php echo $expensesRow['details']; ?></td>
           <td><?php echo  $expensesRow['currentdate']; ?></td>
         </tr>


       <?php } ?>

     </table>
   </div>


 </body>

 </html>