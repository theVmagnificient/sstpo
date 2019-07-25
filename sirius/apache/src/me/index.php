<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_COOKIE['acto'])) {
    $cookie = str_replace(array("'",'"',';','<','>'), '', $_COOKIE['acto']);
    $dbconn = pg_connect(include($_SERVER['DOCUMENT_ROOT'].'/config/db.php'));
    $query = "SELECT id,firstname,surname,email,fav_cli,fav_com,fav_sup,my_sites FROM users WHERE token = '$cookie';";
    $result = pg_query($query);
    $line = pg_fetch_array($result, null, PGSQL_ASSOC);
    if (!$line) {
        header("Location: /login");
        exit;
    }
} else {
    header("Location: /login");
    exit;
}
?>

<!DOCTYPE html>
<html lang='ru'>

<head>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/pages/head.php') ?>

    <title>Личный кабинет | True Search</title>

    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/profile.css">

</head>

<body>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/pages/header.php') ?>

    <main>
        <img src="/images/skyscraper1.png" class="right top photo">
        <div class="ent-con">
            <div class="ent-title">
                <h1>
                    <?php echo $line['firstname'].' '.$line['surname']; ?>
                </h1>
            </div>
            <br>
            <div class="ent-inn">Телефон: не указан</div>
            <div class="ent-inn">Электронная почта: <?php echo $line['email']; ?></div>
    
            <?php
            if (strlen($line['my_sites']) > 2) {
                echo '<div><br><h3>Мои компании:</h3></div><ul id="mylist">';
                $line['my_sites'] = explode (',',substr($line['my_sites'],1,strlen($line['my_sites'])-2));
                for ($i=0;$i<count($line['my_sites']);$i++) {
                    $query = "SELECT name,ogrn FROM sstpo WHERE id = '".$line['my_sites'][$i]."';";
                    $result = pg_query($query);
                    $lines = pg_fetch_array($result, null, PGSQL_ASSOC);
                    echo '<li><a href="/enterprise/?ogrn='.$lines['ogrn'].'">'.$lines['name'].'</a></li>';
                }
                echo '</ul><div><br>';
            }
            if (strlen($line['fav_sup']) > 2) {
                echo '<br /><h3>Поставщики:</h3><br>';
                echo '<div class="slider-wrapper"><div class="slider"><div class="slider-nav-but" id="snb-left" style="display: block;">&lt;</div> <div class="slider-nav-but" id="snb-right" style="display: block;">&gt;</div><div class="sicw"">';			
                $line['fav_sup'] = explode (',',substr($line['fav_sup'],1,strlen($line['fav_sup'])-2));
                for ($i=0;$i<count($line['fav_sup']);$i++) {
                    $query = 'SELECT name,description,inn,ogrn from sstpo where id = '.$line['fav_sup'][$i].' LIMIT 1;';
                    $result = pg_query($query);
                    $lines = pg_fetch_array($result, null, PGSQL_ASSOC);
                    if (($i + 1) % 3 == 1) {
                        echo '<div class="slider-item firs-slid">';
                    }
                    echo '<a href ="/enterprise/?ogrn='.$lines['ogrn'].'"><div class="slider-img-con"><div class="slider-title-name">'.$lines['name'].'</div><div class="slider-description">'.$lines['description'].'</div><div class="ent-inn">ИНН: '.substr($lines['inn'],1,strlen($lines['inn'])-2).'</div><div class="ent-ogrn">ОГРН: '.$lines['ogrn'].'</div></div></a>';
                    if (($i + 1) % 3 == 0) {
                        echo '</div>';
                    }
                }
                echo '</div></div></div></div>';
            }
            if (strlen($line['fav_cli']) > 2) {
                echo '<br /><h3>Клиенты:</h3><br><div class="slider-wrapper"><div class="slider"><div class="slider-nav-but" id="snbbb-left" style="display: block;">&lt;</div> <div class="slider-nav-but" id="snbbb-right" style="display: block;">&gt;</div><div class="sicw"">';
                $line['fav_cli'] = explode (',',substr($line['fav_cli'],1,strlen($line['fav_cli'])-2));
                for ($i = 0; $i < count($line['fav_cli']); $i++) {
                    $query = 'SELECT name,description,inn,ogrn from sstpo where id = '.$line['fav_cli'][$i].' LIMIT 1;';
                    $result = pg_query($query);
                    $lines = pg_fetch_array($result, null, PGSQL_ASSOC);
                    if (($i + 1) % 3 == 1) {
                        echo '<div class="slider-item firs-slid">';
                    }
                    echo '<a href ="/enterprise/?ogrn='.$lines['ogrn'].'"><div class="slider-img-con"><div class="slider-title-name">'.$lines['name'].'</div><div class="slider-description">'.$lines['description'].'</div><div class="ent-inn">ИНН: '.substr($lines['inn'],1,strlen($lines['inn'])-2).'</div><div class="ent-ogrn">ОГРН: '.$lines['ogrn'].'</div></div></a>';
                    if (($i + 1) % 3 == 0) {
                        echo '</div>';
                    }
                }
                echo '</div></div></div></div>';
            }
            if (strlen($line['fav_com']) > 2) {
                echo '<br /><h3>Конкуренты:</h3><br>';
                echo '<div class="slider-wrapper"><div class="slider"><div class="slider-nav-but" id="snb-left" style="display: block;">&lt;</div> <div class="slider-nav-but" id="snb-right" style="display: block;">&gt;</div><div class="sicw"">';
                $line['fav_com'] = explode (',',substr($line['fav_com'],1,strlen($line['fav_com'])-2));
                for ($i = 0; $i < count($line['fav_com']); $i++) {
                    $query = 'SELECT name,description,inn,ogrn from sstpo where id = '.$line['fav_com'][$i].' LIMIT 1;';
                    $result = pg_query($query);
                    $lines = pg_fetch_array($result, null, PGSQL_ASSOC);
                    if (($i + 1) % 3 == 1) {
                        echo '<div class="slider-item firs-slid">';
                    }
                    echo '<a href ="/enterprise/?ogrn='.$lines['ogrn'].'"><div class="slider-img-con"><div class="slider-title-name">'.$lines['name'].'</div><div class="slider-description">'.$lines['description'].'</div><div class="ent-inn">ИНН: '.substr($lines['inn'],1,strlen($lines['inn'])-2).'</div><div class="ent-ogrn">ОГРН: '.$lines['ogrn'].'</div></div></a>';
                    if (($i + 1) % 3 == 0) {
                        echo '</div>';
                    }
                }
                echo '</div></div></div></div>';
            }
            ?>
        </div>
    </main>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function(event)  {
        slider = document.getElementsByClassName('slider')[0];
        slideritem = slider.getElementsByClassName('slider-item');
        sbl = slider.getElementsByClassName("slider-nav-but")[0];
        sbr = slider.getElementsByClassName("slider-nav-but")[1];
        sicw = slider.getElementsByClassName("sicw")[0];
        var nlsi = 0;
        console.log( slideritem.length );
        var slal = 0;
        var snii = 0;
        if (document.getElementsByClassName('slider-item').length > 0) {
            document.getElementsByClassName('slider-wrapper')[0].style.display = 'block';
        }
	if(slider.getElementsByClassName('slider-item').length <=1){
		sbl.style.display = 'none';
		sbr.style.display = 'none';
	}
        for (var i = 1; i < slideritem.length; i++) {
            slal += slider.offsetWidth;
            slideritem[i].style.left = slal + "px";
        }
        zx();
        zc();
        rfexp();
        window.onresize = function() {
            slal = 0;
            for (var i = 1; i < slideritem.length; i++) {
                slal += slider.offsetWidth;
                slideritem[i].style.left = slal + "px";
            }
            nlsi = -slider.offsetWidth * snii;
            zx();
            zc();
            slall = 0;
            for (var i = 1; i < slideritemm.length; i++) {
                slall += sliderr.offsetWidth;
                slideritemm[i].style.left = slall + "px";
            }
            nlsii = -sliderr.offsetWidth * snii;
            slalll = 0;
            for (var i = 1; i < slideritemmm.length; i++) {
                slalll += sliderrr.offsetWidth;
                slideritemmm[i].style.left = slalll + "px";
            }
            nlsiii = -sliderrr.offsetWidth * snii;
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
            } else {}
        }
        sbl.onclick = function() {
            zc();
        }
    })

    function rfexp() {
        sliderr = document.getElementsByClassName('slider')[1];
        slideritemm = sliderr.getElementsByClassName('slider-item');
        sbll = sliderr.getElementsByClassName("slider-nav-but")[0];
        sbrr = sliderr.getElementsByClassName("slider-nav-but")[1];
        sicww = sliderr.getElementsByClassName("sicw")[0];
        var nlsii = 0;
        console.log(slideritemm.length);
        var slall = 0;
        var snii = 0;
        if (sliderr.getElementsByClassName('slider-item').length > 0) {
            document.getElementsByClassName('slider-wrapper')[1].style.display = 'block';
        }
        for (var i = 1; i < slideritemm.length; i++) {
            slall += sliderr.offsetWidth;
            slideritemm[i].style.left = slall + "px";
        }
        zxx();
        zcc();
        if (slideritemm.length == 1) {
            sbll.style.display = 'none';
            sbrr.style.display = 'none';
        }

        function secondres() {
            slall = 0;
            for (var i = 1; i < slideritemm.length; i++) {
                slall += sliderr.offsetWidth;
                slideritemm[i].style.left = slall + "px";
            }
            nlsii = -sliderr.offsetWidth * snii;
            zxx();
            zcc();
        }

        function zxx() {
            if (Math.abs(nlsii - slider.offsetWidth) <= slall) {
                nlsii -= sliderr.offsetWidth;
                sicww.style.left = nlsii + "px";
                snii += 1;
                if (nlsii == -slall) {
                    sbrr.style.display = 'none';
                } else {
                    sbrr.style.display = 'block';
                }
                if (nlsii == 0) {
                    sbll.style.display = 'none';
                } else {
                    sbll.style.display = 'block';
                }
            } else {}
        }
        sbrr.onclick = function() {
            zxx();
        }

        function zcc() {
            if (nlsii + sliderr.offsetWidth <= 0) {
                nlsii += sliderr.offsetWidth;
                snii -= 1;
                sicww.style.left = nlsii + "px";
                if (nlsii == 0) {
                    sbll.style.display = 'none';
                } else {
                    sbll.style.display = 'block';
                }
                if (nlsii == -slall) {
                    sbrr.style.display = 'none';
                } else {
                    sbrr.style.display = 'block';
                }
            } else {}
        }
        sbll.onclick = function() {
            zcc();
        }
        rfexpp();
    }

    function rfexpp() {
        sliderrr = document.getElementsByClassName('slider')[2];
        slideritemmm = sliderrr.getElementsByClassName('slider-item');
        sblll = sliderrr.getElementsByClassName("slider-nav-but")[0];
        sbrrr = sliderrr.getElementsByClassName("slider-nav-but")[1];
        sicwww = sliderrr.getElementsByClassName("sicw")[0];
        var nlsiii = 0;
	if (sliderrr.getElementsByClassName('slider-item').length <= 1){
		sblll.style.display='none';
		sbrrr.style.display='none';
	}	
        console.log(slideritem.length)
        var slalll = 0;
        var sniiii = 0;
	console.log('asd'+sliderrr.getElementsByClassName('slider-item').length);
        if (sliderrr.getElementsByClassName('slider-item').length > 0) {
            document.getElementsByClassName('slider-wrapper')[2].style.display = 'block';
        }
        for (var i = 1; i < slideritemmm.length; i++) {
            slalll += sliderrr.offsetWidth;
            slideritemmm[i].style.left = slalll + "px";
        }
        zxxx();
        zccc();

        function thirdres() {
	    slalll = 0;
	    for (var i = 1; i < slideritemmm.length; i++) {
		slalll += sliderrr.offsetWidth;
		slideritemmm[i].style.left = slalll + "px";
            }
            nlsiii = -sliderrr.offsetWidth * sniii;
            zxxx();
            zccc();
        }
	
        function zxxx() {
            if (Math.abs(nlsiii - sliderrr.offsetWidth) <= slalll) {
                nlsiii -= sliderrr.offsetWidth;
                sicwww.style.left = nlsiii + "px";
                sniiii += 1;
                if (nlsiii == -slalll) {
                    sbrrr.style.display = 'none';
                } else {
                    sbrrr.style.display = 'block';
                }
                if (nlsiii == 0) {
                    sblll.style.display = 'none';
                } else {
                    sblll.style.display = 'block';
                }
            } else {}
        }
        sbrrr.onclick = function() {
            zxxx();
        }

        function zccc() {
            if (nlsiii + sliderrr.offsetWidth <= 0) {
                nlsiii += slider.offsetWidth;
                sniiii -= 1;
                sicwww.style.left = nlsiii + "px";
                if (nlsiii == 0) {
                    sblll.style.display = 'none';
                } else {
                    sblll.style.display = 'block';
                }
                if (nlsiii == -slalll) {
                    sbrrr.style.display = 'none';
                } else {
                    sbrrr.style.display = 'block';
                }
            } else {}
        }
        sblll.onclick = function() {
            zccc();
        }
    }
</script>

</html>
