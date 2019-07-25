<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['ws'])) {
    $ws = str_replace(array("'", '"'), '', $_GET['ws']);
} else {
    $ws = '';
}
$dbconn = pg_connect(include($_SERVER['DOCUMENT_ROOT'].'/config/db.php'));
$query_all = "SELECT distinct website FROM parser;";
$result_all = pg_query($query_all) or die('Ошибка запроса: ');
$query_ws = "SELECT website, url, description, text_probability, result_probability FROM parser WHERE website = '$ws' ORDER BY id;";
$result_ws = pg_query($query_ws) or die('Ошибка запроса: ');
$query_org = "SELECT name, ogrn, inn, websites, description FROM sstpo WHERE websites = '$ws' LIMIT 1;";
$result_org = pg_query($query_org) or die('Ошибка запроса: ');
$line_org = pg_fetch_array($result_org, null, PGSQL_ASSOC);
?>

<!DOCTYPE html>
<html lang='ru'>

<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="/favicon.png" type="image/png" />
    <!--<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">-->
    <?php include($_SERVER['DOCUMENT_ROOT'].'/pages/yandex-metrika.php') ?>

    <title>Парсер | True Search</title>

    <link rel="stylesheet" href="/css/main.css">
    <style>
        .parser_results {
            width: 100%;
        }

        .parser_results tr td, .parser_results tr th {
            border-bottom: 1px solid black;
            padding: 8px;
        }
    </style>
</head>

<body style="overflow-y: visible;">
    <?php include($_SERVER['DOCUMENT_ROOT'].'/pages/header.php') ?>
    <main style="margin-top: 55px; padding: 0 0 0 15px;">
        <div style="float: left; width: 150px; height: calc(100vh - 70px); overflow-y: scroll; overflow-x: hidden;">
            <h3>Веб-сайты</h3>
            <table>
                <?php
                while ($line = pg_fetch_array($result_all, null, PGSQL_ASSOC)){
                    echo "<tr><td class='parser-website'>";
                    echo "<a style='text-decoration: none; color: darkblue;' href='?ws=".$line['website']."'>".$line['website']."</a>";
                    echo "</td></tr>";
                }
                ?>
            </table>
        </div>
        <div style="height: calc(100vh - 70px); overflow-y: scroll; padding: 0 15px;">
            <div>
                <?php
                echo "<h2>".$line_org['name']."</h2>";
                echo "<h5>ОГРН: ".$line_org['ogrn']."</h5>";
                echo "<h5>ИНН: ".substr($line_org['inn'], 1, strlen($line_org['inn']) - 2)."</h5>";
                echo "<h5>Веб-сайт: <a style='color: darkblue;' href='http://".$line_org['websites']."'>".$line_org['websites']."</a></h5>";
                echo "<br /><h4>Текущее описание:</h4>";
                echo "<p>".$line_org['description']."</p>";
                ?>
            </div>
            <br />
            <h3>Результаты парсера</h3>
            <table class='parser_results' cellspacing='0'>
                <tr>
                    <th style='max-width: 100px;'>Страница</th>
                    <th>Описание</th>
                    <th width='50'>Вероятность описания</th>
                    <th width='50'>Итоговый балл</th>
                </tr>
                <?php
                while ($line = pg_fetch_array($result_ws, null, PGSQL_ASSOC)) {
                    echo "<tr>";
                    if (strlen($line['url']) - 7 == strlen($line['website'])) {
                        echo "<td style='overflow-x: hidden; max-width: 100px;'><a style='color: darkblue;' href='".$line['url']."'><p>".substr($line['url'], 7, strlen($line['url']))."</p></a></td>";
                    } else {
                        echo "<td style='overflow-x: hidden; max-width: 100px;'><a style='color: darkblue;' href='".$line['url']."'><p>".substr($line['url'], 7 + strlen($line['website']), strlen($line['url']))."</p></a></td>";
                    }
                    echo "<td>".$line['description']."</td>";
                    echo "<td align='center'>".number_format((float)$line['text_probability'], 3, '.', '')."</td>";
                    echo "<td align='center'>".number_format((float)$line['result_probability'], 3, '.', '')."</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </main>
</body>

</html>
