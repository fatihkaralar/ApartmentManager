<?php

$server = "localhost";
$user = "root";
$password = "";
$db = "apartment_management";

$connect = mysqli_connect($server, $user, $password, $db);

if(!$connect)
{
    die("Connection Failed:" .mysqli_connect_error());
}
?>
