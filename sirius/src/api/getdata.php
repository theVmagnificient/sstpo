<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

$req = str_replace(array("'",'"'),'',$_GET['request']);
$offset=str_replace(array("'",'"'),'',$_GET['offset']);
$dbconn = pg_connect(include($_SERVER['DOCUMENT_ROOT'].'/config/db.php'));
$ans = array(
    'items'=>array(),
    'correct'=>true
);
if (is_numeric($req)) {
$query = "SELECT id,name,description,websites,ogrn,inn FROM sstpo WHERE ogrn = $req or $req = ANY(inn) ORDER BY length(description) ASC OFFSET $offset LIMIT 20;";
//$query = "SELECT * FROM sstpo LIMIT 20;";
    $result = pg_query($query);
    while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
        array_push($ans['items'], $line);
    }
}
if(count($ans['items']) < 20) {
$query = "SELECT id,name,description,websites,ogrn,inn FROM sstpo WHERE name % '$req' or names % '$req' or description % '$req' or websites % '$req' ORDER BY similarity(name,'$req') DESC, length(description) ASC  OFFSET $offset LIMIT 20;";
//$query = "SELECT * FROM sstpo LIMIT 20;";
$result = pg_query($query);
//var_dump($result);
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
        $flagg = false;
        for ($i=0;$i<count($ans['items']);$i++){
            if ($line['ogrn']==$ans['items'][$i]['ogrn']){
                $flagg = true;
        break;
            }
        }
        if ($flagg == false){
            array_push($ans['items'],$line);
        }
    }
}
/*
if(count($ans['items']) < 20) {
    $reqmas = explode(' ', $req);
    $reqsu = '';
    $reqsu .= file_get_contents("http://127.0.0.1:5000/?request=".json_encode($reqmas[$i]));
    $query = "SELECT * FROM sstpo WHERE description_clear % '$reqsu' LIMIT 20;";
    $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
    while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
        $flagg = false;
        for ($i = 0; $i < count($ans['items']); $i++){
            if ($line['ogrn'] == $ans['items'][$i]['ogrn']) {
                $flagg = true;
            }
        }
        if ($flagg == false) {
            array_push($ans['items'], $line);
        }
    }
*/
echo json_encode($ans);
pg_close($dbconn);
?>
