<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

/*LOCAL */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'pokertimer');
define('DB_PASSWORD', '38q3BDw1g1VJjacx');
define('DB_NAME', 'pokertimer');


/* REMOTE 
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'pokerapp_timer');
define('DB_PASSWORD', '38q3BDw1g1VJjacx');
define('DB_NAME', 'pokerapp_timer');
*/
 
/* Attempt to connect to MySQL database */
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
?>
