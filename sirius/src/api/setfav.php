<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$req = str_replace(array("'",'"','<','>'),'',$_COOKIE['acto']);
$listid = str_replace(array("'",'"','<','>'),'',$_GET['listid']);
$entid = str_replace(array("'",'"','<','>'),'',$_GET['entid']);
$mode = $_GET['mode'];
if ($mode == 0) {
    if($listid == 0){$listid = 'my_sites';}
    elseif($listid ==3){$listid='fav_com';}
    elseif($listid ==1){$listid='fav_sup';}
    elseif($listid ==2){$listid='fav_cli';}
    $dbconn = pg_connect(include($_SERVER['DOCUMENT_ROOT'].'/config/db.php'));
    $query = "UPDATE users SET ".$listid." = array_append(my_Sites,".$entid.") WHERE token = '".$req."';";
    $result = pg_query($query);
} elseif ($mode == 1) {
    $dbconn = pg_connect(include($_SERVER['DOCUMENT_ROOT'].'/config/db.php'));
    $query = "UPDATE users SET my_sites = array_remove(my_sites,".$entid."), fav_com = array_remove(fav_com,".$entid."), fav_sup = array_remove(fav_sup,".$entid."),fav_cli = array_remove(fav_cli,".$entid.") WHERE token = '".$req."';";
    $result = pg_query($query);
}
?>
