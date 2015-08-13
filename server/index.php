<?php 
require './backend/db/db_base.php';

$database_host = "localhost";
$database = "apollo";
$db_port = "3306";
$db_pwd = "";
$db_user = "root";

// $con = new mysqli($database_host, $db_user, null, $database, $db_port, $db_user);
// $con = mysqli_connect($database_host);
// $con = new mysqli($database_host, $db_user);
$con = get_connection();
$con->close();
echo "suck my balls on the index whore!";
?>