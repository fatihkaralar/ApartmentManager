<?php 

//This file stops the session.And redirect user to login page
session_start();
session_unset();
session_destroy();
header('location:../Login/userLogin.php ');



 ?>