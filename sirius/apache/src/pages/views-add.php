<?php
if(!isset($_COOKIE['viewed']))
{
$dbconn = pg_connect(include($_SERVER['DOCUMENT_ROOT']."/config/db.php"));
$query = "UPDATE views SET counter = counter+1;";
$result = pg_query($query);
echo '<script>document.cookie = "viewed=1";</script>';
}
?>
