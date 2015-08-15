<!-- Base database connection stuff. -->

<?php 

$database_host = "localhost";
$database = "apollo";
$db_port = "3306";

$query_user = "apollo_query";
$query_pwd = "query_password";

$insert_user = "apollo_insert";
$insert_pwd = "sharonlicksballs6969";


/**
 * Connects to the db as the query user.
 * 
 * @return mysqli
 */
function get_query_connection() {
	global $query_user, $query_pwd;
	echo "query deal user" . $query_user . " pwd" . $query_pwd; 
	return get_connection($query_user, $query_pwd);
}

/**
 * Connects to the db as the query user.
 * 
 * @return mysqli
 */
function get_insert_connection() {
	global $insert_user, $insert_pwd;
	echo "insert deal user" . $insert_user . " pwd" . $insert_pwd;
	
	return get_connection($insert_user, $insert_pwd);
}

/**
 * @param unknown $db_user
 * @param unknown $db_pwd
 * @return mysqli
 */
function get_connection($db_user, $db_pwd) {
	global $database, $database_host, $db_port;

	echo "connection deal user" . $db_user . " pwd " . $db_pwd . "<p>";
	
	
	$connection = new mysqli($database_host, $db_user, $db_pwd, $database, $db_port);
	
	if ($connection->connect_error) {
		die('Connect Error (' . $connection->connect_errno . ') '
				. $connection->connect_error);
	}
	
	return $connection;
}

?>