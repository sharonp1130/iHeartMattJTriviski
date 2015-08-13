<!-- Base database connection stuff. -->

<?php 

$database_host = "localhost";
$database = "apollo";
$db_port = "3306";
$db_pwd = null;
$db_user = "root";

function get_connection() {
	global $database, $database_host, $db_port, $db_pwd, $db_user;

	$connection = new mysqli($database_host, $db_user, $db_pwd, $database, $db_port);
	
	if ($connection->connect_error) {
		die('Connect Error (' . $connection->connect_errno . ') '
				. $connection->connect_error);
	}
	
	return $connection;
}

?>