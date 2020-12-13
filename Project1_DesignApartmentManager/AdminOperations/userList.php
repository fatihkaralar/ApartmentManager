<!-- *@Author Abuzer Fatih KARALAR
 *@Version 28.10.2020 
-->
<?php
session_start();
require_once '../dbconnection/dbconnect.php';
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
                <td>Row Number</td>
                <td>Name and Surname</td>
                <td>Apartment number</td>
                <td> Status </td>
                <td> E- mail</td>
                <td> Rent Debt</td>
                <td>Edit User</td>
                <td>Send Mail</td>
                <td>Remove User</td>
            </tr>


        </table>
    </div>

    <script>
        /* This script lists the users.It is not a dynamic script.For the future here is works with database. 
         */
        var names = ["Fatih KARALAR", "Mehmet KARALAR", "Ali TANDOĞAN", "Berat YILMAZ"];
        var Status = ["Tenant", "Owner"];
        //This loop creates a table and fills it with user informations
        for (var i = 0; i < 30; i++) {
            var randomName = Math.floor(Math.random() * 4);
            var randomStatus = Math.floor(Math.random() * 2);
            var tableRef = document.getElementById('users').getElementsByTagName('tbody')[0];
            var newRow = tableRef.insertRow(tableRef.rows.length);
            var rowNumbercell = newRow.insertCell(0);
            var Namecell = newRow.insertCell(1);
            var aptNoCell = newRow.insertCell(2);
            var StatusCell = newRow.insertCell(3);
            var MailCell = newRow.insertCell(4);
            var RentDebtCell = newRow.insertCell(5);
            var editButtonCell = newRow.insertCell(6);
            var mailButtonCell = newRow.insertCell(7);
            var removeButtonCell = newRow.insertCell(8);
            rowNumbercell.innerHTML = i;
            Namecell.innerHTML = names[randomName];
            aptNoCell.innerHTML = i + 1
            StatusCell.innerHTML = Status[randomStatus];
            MailCell.innerHTML = names[randomName].toLocaleLowerCase() + "@hotmail.com.tr";
            RentDebtCell.innerHTML = 0;
            editButtonCell.innerHTML = '<button id="editButton">Edit User</button>';
            mailButtonCell.innerHTML = '<button id="mailButton">Send Mail</button>';
            removeButtonCell.innerHTML = '<button id="removeButton">Remove User</button>';

        }
    </script>
</body>

</html>