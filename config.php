<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
// define('DB_SERVER', 'localhost');
// define('DB_PORT', '5432');
// define('DB_NAME', 'postgres');
// define('DB_USERNAME', 'amoli');
// define('DB_PASSWORD', '');
 
//  Attempt to connect to MySQL database 
// //$link = pg_connect(DB_SERVER, DB_PORT, DB_NAME, DB_USERNAME, DB_PASSWORD );
// $link = pg_connect("host=localhost port=5432 dbname=postgres user=amolivani");
// $db = pg_connect("host=localhost port=5432 dbname=postgres user=amolivani");

$db = pg_connect(getenv("DATABASE_URL"));

?>