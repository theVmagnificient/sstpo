<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

$req = str_replace(array("'", '"', '<', '>'), '', $_COOKIE['acto']);
$dbconn = pg_connect(include($_SERVER['DOCUMENT_ROOT'].'/config/db.php'));
$query = "SELECT distinct my_sites, fav_cli, fav_com, fav_sup FROM users where token = '$req' LIMIT 1";
$result = pg_query($query);
$line = pg_fetch_array($result, null, PGSQL_ASSOC);
$ans = '';
$line = explode(',', substr($line['fav_com'], 1, strlen($line['fav_com']) - 2).','.substr($line['fav_cli'], 1, strlen($line['fav_cli']) - 2).','.substr($line['fav_sup'], 1, strlen($line['fav_sup'])-2).','.substr($line['my_sites'], 1, strlen($line['my_sites']) - 2));
echo json_encode($line);
?>
