<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

$ogrn = str_replace(array("'", '"'), '', $_GET['ogrn']);
$dbconn = pg_connect(include($_SERVER['DOCUMENT_ROOT'].'/config/db.php'));
$query = "SELECT name,description,websites,inn,ogrn,simila from sstpo WHERE ogrn = '$ogrn' LIMIT 1;";
$result = pg_query($query) or die('Ошибка запроса: ');
$line = pg_fetch_array($result, null, PGSQL_ASSOC);
$refe = $_SERVER['HTTP_REFERER'];
?>

<!DOCTYPE html>
<html lang='ru'>

<head>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/pages/head.php') ?>

    <title>Организация | True Search</title>

    <link rel="stylesheet" href="/css/main.css">
    <link rel="preload" href="/images/favorite.png" as="image">
    <link rel="preload" href="/images/favorite-filled.png" as="image">
</head>

<body>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/pages/header.php') ?>

    <main>
        <div class="back-con">
            <span class="back-item">
                <?php
                if (strpos($refe, 'search') <= 0) {
                    echo "<a href = '/'>Поиск</a>";
                } else {
                    echo "<a href = $refe>Поиск</a>";
                }
                ?>
            </span>
            <span class="right-arrow">></span>
            <span class="back-item">
                <a href="#">
                    <?php echo $line['name']; ?>
                </a>
            </span>
        </div>
        <div class="ent-con">
            <div class="ent-title">
                <?php echo $line['name']; ?>
            </div>
            <div class="ent-website">
                <?php echo '<a href=http://'.$line['websites'].'>'.$line['websites'].'</a>'; ?>
            </div>
            <div class="ent-description">
                <?php echo $line['description']; ?>
            </div>
            <div class="ent-inn">
                <?php echo 'ИНН: '.substr($line['inn'], 1, strlen($line['inn']) - 2); ?>
            </div>
            <div class="ent-ogrn">
                <?php echo 'ОГРН: '.$line['ogrn']; ?>
            </div>
            <div class="slider-wrapper">
                <div class="slider">
                    <div class="slider-nav-but" id="snb-left" style="display: block;">
                        &lt;</div>
                    <div class="slider-nav-but" id="snb-right" style="display: block;">&gt;
                    </div>
                    <div class="sicw" style="left: 0;">
                        <?php
                        $line['simila'] = substr($line['simila'],1,strlen($line['simila'])-2);
                        $line['simila'] = explode(',',$line['simila']);
                        if ($line['simila'][0] != "") {
                            for ($i = 0; $i < count($line['simila']); $i++) {
                                $query = 'SELECT name,description,inn,ogrn from sstpo where id = '.$line['simila'][$i].' LIMIT 1;';
                                $result = pg_query($query);
                                $lines = pg_fetch_array($result, null, PGSQL_ASSOC);
                                if (($i + 1) % 3 == 1) {
                                    echo '<div class="slider-item firs-slid">';
                                }
                                echo '<a href ="?ogrn='.$lines['ogrn'].'"><div class="slider-img-con"><div class="slider-title-name">'.$lines['name'].'</div><div class="slider-description">'.$lines['description'].'</div><div class="ent-inn">ИНН: '.substr($lines['inn'],1,strlen($lines['inn'])-2).'</div><div class="ent-ogrn">ОГРН: '.$lines['ogrn'].'</div></div></a>';
                                if (($i + 1) % 3 == 0) {
                                    echo '</div>';
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        window.onload = function() {
            slider = document.getElementsByClassName('slider')[0];
            slideritem = slider.getElementsByClassName('slider-item');
            sbl = slider.getElementsByClassName("slider-nav-but")[0];
            sbr = slider.getElementsByClassName("slider-nav-but")[1];
            sicw = slider.getElementsByClassName("sicw")[0];
            var nlsi = 0;
            console.log(slideritem.length)
            var slal = 0;
            var snii = 0;
            if (document.getElementsByClassName('slider-item').length > 0) {
                document.getElementsByClassName('slider-wrapper')[0].style.display = 'block';
            }
            for (var i = 1; i < slideritem.length; i++) {
                slal += slider.offsetWidth;
                slideritem[i].style.left = slal + "px";
            }

            zx();

            zc();

            window.onresize = function() {

                slal = 0;
                for (var i = 1; i < slideritem.length; i++) {
                    slal += slider.offsetWidth;
                    slideritem[i].style.left = slal + "px";
                }
                nlsi = -slider.offsetWidth * snii;
                zx();
                zc();
            }

            function zx() {
                if (Math.abs(nlsi - slider.offsetWidth) <= slal) {
                    nlsi -= slider.offsetWidth;
                    sicw.style.left = nlsi + "px";
                    snii += 1;
                    if (nlsi == -slal) {
                        sbr.style.display = 'none';
                    } else {
                        sbr.style.display = 'block';
                    }
                    if (nlsi == 0) {
                        sbl.style.display = 'none';
                    } else {
                        sbl.style.display = 'block';
                    }
                } else {}
            }
            sbr.onclick = function() {
                zx();
            }

            function zc() {
                if (nlsi + slider.offsetWidth <= 0) {
                    nlsi += slider.offsetWidth;
                    snii -= 1;
                    sicw.style.left = nlsi + "px";
                    if (nlsi == 0) {
                        sbl.style.display = 'none';
                    } else {
                        sbl.style.display = 'block';
                    }
                    if (nlsi == -slal) {
                        sbr.style.display = 'none';
                    } else {
                        sbr.style.display = 'block';
                    }
                } else {

                }
            }
            sbl.onclick = function() {
                zc();
            }


        }
    </script>
</body>

</html>
