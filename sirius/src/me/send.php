<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_COOKIE['acto'])) {
	$cookie = str_replace(array("'", '"', ';', '<', '>'),'',$_COOKIE['acto']);
	$dbconn = pg_connect(include($_SERVER['DOCUMENT_ROOT'].'/config/db.php'));
	$query = "SELECT id FROM users WHERE token='$cookie';";
	$result = pg_query($query);
	$line = pg_fetch_array($result, null, PGSQL_ASSOC);
	if (!$line) {
		header("Location: /login");
		exit;
	}
	$id = $line['id'];
	$to_id = $_POST['to_id'];
	$msg = $_POST['message'];
	$query = "INSERT INTO messages (to_id, from_id, message) VALUES ($to_id,$id,'$msg');";
	$result = pg_query($query);
} else {
	header("Location: /login");
	exit;
}
header("Location: /me/messages.php");
echo 'Succes!';
exit;
