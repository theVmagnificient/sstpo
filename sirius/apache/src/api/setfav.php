<?php
#error_reporting(E_ALL);
#ini_set('display_errors', 1);
$req = str_replace(array("'",'"','<','>'),'',$_COOKIE['acto']);
$listid = str_replace(array("'",'"','<','>'),'',$_GET['listid']);
$entid = str_replace(array("'",'"','<','>'),'',$_GET['entid']);
$mode = $_GET['mode'];
if($listid == 0){$listid = 'my_sites';}
elseif($listid ==3){$listid='fav_com';}
elseif($listid ==1){$listid='fav_sup';}
elseif($listid ==2){$listid='fav_cli';}
$dbconn = pg_connect(include($_SERVER['DOCUMENT_ROOT'].'/config/db.php'));
$query = "UPDATE users SET ".$listid." = array_remove(".$listid.",".$entid.") WHERE token = '".$req."';";
$result = pg_query($query);
if ($mode == 1) {
    $dbconn = pg_connect(include($_SERVER['DOCUMENT_ROOT'].'/config/db.php'));
    $query = "UPDATE users SET ".$listid." = array_append(".$listid.",".$entid.") WHERE token = '".$req."';";
    $result = pg_query($query);
}
?>
