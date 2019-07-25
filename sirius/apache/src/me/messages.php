<head>
	<title>True Search</title>
<link rel="shortcut icon" href="/favicon.png" type="image/png">
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="/css/main.css">
	<link rel="stylesheet" href="/css/profile.css">
        <!-- Yandex.Metrika counter --> <script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(54433279, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, trackHash:true }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/54433279" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
        <link rel="preload" href="/images/menu-black.png" as="image">
	<script type="text/javascript">
	/* NOTE : Use web server to view HTML files as real-time update will not work if you directly open the HTML file in the browser. */
	(function(d, m){
	var kommunicateSettings = {"appId":"12aaee71a36be24eb6beb59e6345a7d73","conversationTitle":"Artur Lukyanov","popupWidget":true,"automaticChatOpenOnNavigation":true};
	var s = document.createElement("script"); s.type = "text/javascript"; s.async = true;
	s.src = "https://widget.kommunicate.io/v2/kommunicate.app";
	var h = document.getElementsByTagName("head")[0]; h.appendChild(s);
	window.kommunicate = m; m._globals = kommunicateSettings;
})(document, window.kommunicate || {});
</script>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
        <header>
		 <div class="header-item-container">
<div class = "header-item" style="background-image: url('/images/logo.svg'); height:54px; width:54px;">
		</div>

           		<a href="/">
                        <div class = "header-item">
                                Главная
                        </div>
                </a>
                <a href = "/#scrolltitle">
                        <div class = "header-item">
                                О нас
                        </div>
                </a>
                <a href = "/#scrollourteam">
                        <div class = "header-item">
                                Наша команда
                        </div>
                </a>
                <a href = "/me">
                        <div class = "header-item">
                                Личный кабинет
                        </div>
                </a>
        	</div>
        </header>
    <main>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if(isset($_COOKIE['acto']))
{
	$cookie = str_replace(array("'", '"', ';', '<', '>'),'',$_COOKIE['acto']);
	$dbconn = pg_connect(include($_SERVER['DOCUMENT_ROOT'].'/config/db.php'));
	$query = "SELECT id FROM users WHERE token='$cookie';";
	$result = pg_query($query);
	$line = pg_fetch_array($result, null, PGSQL_ASSOC);
	if(!$line)
	{
		header("Location: /login");
		exit;
	}
	$id = $line['id'];
	$query = "SELECT to_id,from_id,message FROM messages WHERE to_id=$id";
	$result = pg_query($query);
	$lines = pg_fetch_all($result);
	if($lines)
	{
	$first = true;
	foreach($lines as $line)
	{
		$from_id = $line['from_id'];
		$result_ = pg_query("SELECT firstname,surname FROM users WHERE id=$from_id");
		$line_ = pg_fetch_array($result_);
		$from_ = $line_['firstname'] . ' ' . $line_['surname'];
		$msg = $line['message'];
		$msg = str_replace(array("'", '"', ';', '<', '>'), '', $msg);
		$from_ = str_replace(array("'", '"', ';', '<', '>'), '', $from_);
		if($first)
		{
			echo "<div class='ent-con'><div class='ent-title'><h1>$from_</h1></div><div class='ent-inn'>$msg</div></div>";
			$first = false;
		}
		else
		{
			echo "<div class='ent-con' style='margin-top: 10px;'><div class='ent-title'><h1>$from_</h1></div><div class='ent-inn'>$msg</div></div>";
		}
	}
	}
}
else
{
	header("Location: /login");
	exit;
}
?>
<div class='ent-con search-container'>
	<div class='ent-title'><h1>Отправить сообщение</h1></div><br/>
	<div class='ent-inn'>
		<form action='send.php' method="POST">
			<h4>Кому: <input name="to_id"><br/></h4><br/>
			<textarea rows="10" cols="73" name="message" style="border-radius:1%;resize:none" placeholder="Ваше сообщение здесь..."></textarea><br/><br/>
			<input type="submit" value="Отправить"/>
		</form>
	</div>
</div>	
    </main>

<script>
window.onload = function () {
    slider= document.getElementsByClassName('slider')[0];
    slideritem = slider.getElementsByClassName('slider-item');
    sbl= slider.getElementsByClassName("slider-nav-but")[0];
    sbr= slider.getElementsByClassName("slider-nav-but")[1];
    sicw = slider.getElementsByClassName("sicw")[0];
    var nlsi = 0;
    console.log(slideritem.length)
    var slal = 0;
    var snii=0;
	if(document.getElementsByClassName('slider-item').length>0){
     document.getElementsByClassName('slider-wrapper')[0].style.display='block';}
    for (var i = 1; i < slideritem.length;i++){
        slal+= slider.offsetWidth;
        slideritem[i].style.left = slal+"px";
    }
    zx();
    zc();
    rfexp();
    window.onresize = function (){
        slal = 0;
        for (var i = 1; i < slideritem.length;i++){
            slal+= slider.offsetWidth;
            slideritem[i].style.left = slal+"px";
        }
        nlsi = -slider.offsetWidth*snii;
        zx();
        zc();
	slall = 0;
        for (var i = 1; i < slideritemm.length;i++){
            slall+= sliderr.offsetWidth;
            slideritemm[i].style.left = slall+"px";
        }
        nlsii = -sliderr.offsetWidth*snii;
	slalll = 0;
        for (var i = 1; i < slideritemmm.length;i++){
            slalll+= sliderrr.offsetWidth;
            slideritemmm[i].style.left = slalll+"px";
        }
        nlsiii = -sliderrr.offsetWidth*snii;
    }
    function zx(){
        if  (Math.abs(nlsi-slider.offsetWidth)<=slal){
            nlsi -= slider.offsetWidth;
            sicw.style.left = nlsi+"px";
            snii+=1;
            if (nlsi==-slal){
                sbr.style.display='none';
            }
            else{
                sbr.style.display='block';
            }
            if (nlsi==0){
                sbl.style.display='none';
            }
            else{
                sbl.style.display='block';
            }
        }
        else{
        }
    }
    sbr.onclick = function (){
        zx();
    }
    function zc(){
        if  (nlsi+slider.offsetWidth<=0){
            nlsi += slider.offsetWidth;
            snii-=1;
            sicw.style.left = nlsi+"px";
            if (nlsi==0){
                sbl.style.display='none';
            }
            else{
                sbl.style.display='block';
            }
            if (nlsi==-slal){
                sbr.style.display='none';
            }
            else{
                sbr.style.display='block';
            }
        }
        else{
        }
    }
    sbl.onclick = function (){
        zc();
    }
}

 function rfexp() {
    sliderr= document.getElementsByClassName('slider')[1];
    slideritemm = sliderr.getElementsByClassName('slider-item');
    sbll= sliderr.getElementsByClassName("slider-nav-but")[0];
    sbrr= sliderr.getElementsByClassName("slider-nav-but")[1];
    sicww = sliderr.getElementsByClassName("sicw")[0];
    var nlsii = 0;
    console.log(slideritemm.length)
    var slall = 0;
    var snii=0;
	if(sliderr.getElementsByClassName('slider-item').length>0){
     document.getElementsByClassName('slider-wrapper')[1].style.display='block';}
    for (var i = 1; i < slideritemm.length;i++){
        slall+= sliderr.offsetWidth;
        slideritemm[i].style.left = slall+"px";
    }
    zxx();
 zcc();
	if(slideritemm.length==1){
	sbll.style.display='none';
	sbrr.style.display='none';
}
   function  secondres(){
        slall = 0;
        for (var i = 1; i < slideritemm.length;i++){
            slall+= sliderr.offsetWidth;
            slideritemm[i].style.left = slall+"px";
        }
        nlsii = -sliderr.offsetWidth*snii;
        zxx();
        zcc();
    }
    function zxx(){
        if  (Math.abs(nlsii-slider.offsetWidth)<=slall){
            nlsii -= sliderr.offsetWidth;
            sicww.style.left = nlsii+"px";
            snii+=1;
            if (nlsii==-slall){
                sbrr.style.display='none';
            }
            else{
                sbrr.style.display='block';
            }
            if (nlsii==0){
                sbll.style.display='none';
            }
            else{
                sbll.style.display='block';
            }
        }
        else{
        }
    }
    sbrr.onclick = function (){
        zxx();
    }
    function zcc(){
        if  (nlsii+sliderr.offsetWidth<=0){
            nlsii += sliderr.offsetWidth;
            snii-=1;
            sicww.style.left = nlsii+"px";
            if (nlsii==0){
                sbll.style.display='none';
            }
            else{
                sbll.style.display='block';
            }
            if (nlsii==-slall){
                sbrr.style.display='none';
            }
            else{
                sbrr.style.display='block';
            }
        }
        else{
        }
    }
    sbll.onclick = function (){
        zcc();
    }
rfexpp();
}

function rfexpp() {
    sliderrr= document.getElementsByClassName('slider')[2];
    slideritemmm = sliderrr.getElementsByClassName('slider-item');
    sblll= sliderrr.getElementsByClassName("slider-nav-but")[0];
    sbrrr= sliderrr.getElementsByClassName("slider-nav-but")[1];
    sicwww = sliderrr.getElementsByClassName("sicw")[0];
    var nlsiii = 0;
    console.log(slideritem.length)
    var slalll = 0;
    var sniiii = 0;
	if(sliderrr.getElementsByClassName('slider-item').length>0){
    document.getElementsByClassName('slider-wrapper')[2].style.display='block';}
    for (var i = 1; i < slideritemmm.length;i++){
        slalll+= sliderrr.offsetWidth;
        slideritemmm[i].style.left = slalll+"px";
    }
    zxxx();
    zccc();
    function thirdres(){
        slalll = 0;
        for (var i = 1; i < slideritemmm.length;i++){
            slalll+= sliderrr.offsetWidth;
            slideritemmm[i].style.left = slalll+"px";
        }
        nlsiii = -sliderrr.offsetWidth*sniii;
        zxxx();
        zccc();
    }
    function zxxx(){
        if  (Math.abs(nlsiii-sliderrr.offsetWidth)<=slalll){
            nlsiii -= sliderrr.offsetWidth;
            sicwww.style.left = nlsiii+"px";
            sniiii+=1;
            if (nlsiii==-slalll){
                sbrrr.style.display='none';
            }
            else{
                sbrrr.style.display='block';
            }
            if (nlsiii==0){
                sblll.style.display='none';
            }
            else{
                sblll.style.display='block';
            }
        }
        else{
        }
    }
    sbrrr.onclick = function (){
        zxxx();
    }
    function zccc(){
        if  (nlsiii+sliderrr.offsetWidth<=0){
            nlsiii += slider.offsetWidth;
            sniiii-=1;
            sicwww.style.left = nlsiii+"px";
            if (nlsiii==0){
                sblll.style.display='none';
            }
            else{
                sblll.style.display='block';
            }
            if (nlsiii==-slalll){
                sbrrr.style.display='none';
            }
            else{
                sbrrr.style.display='block';
            }
        }
        else{
        }
    }
    sblll.onclick = function (){
        zccc();
    }
}
</script>
