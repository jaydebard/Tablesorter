<?php
// Connect to database
$mysqli = new mysqli('db_host', 'db_user', 'db_pass', 'db_name');

if($mysqli->connect_errno > 0){
    die('Unable to connect to database [' . $mysqli->connect_error . ']');
}
?> 