<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$dbconn = pg_connect(include($_SERVER['DOCUMENT_ROOT'] . "/config/db.php"));
$query = "SELECT COUNT(*) FROM users;";
$result = pg_query($query);
$row = pg_fetch_row($result);
echo $row[0];
?>
