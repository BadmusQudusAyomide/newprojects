<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'pxxlspac_btechi_user');
define('DB_PASSWORD', ' 6vMmteif61');
define('DB_NAME', 'pxxlspac_btechi_db');

/* Attempt to connect to MySQL database */
$mysqli = mysqli_connect("localhost", "pxxlspac_btechi_user", "6vMmteif61", "pxxlspac_btechi_db");

// Check connection
if ($mysqli === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
