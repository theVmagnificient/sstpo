<!DOCTYPE html>
<html lang='ru'>

<head>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/pages/head.php') ?>

    <title>Поиск | True Search</title>

    <link rel="stylesheet" href="/css/main.css">
</head>

<body>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/pages/header.php') ?>

    <div id="scrapholder"></div>

    <main>
        <div class="black" onclick='hidechoose()'></div>
        <div class="choose-con-wrapper">
            <div class="choose-con">
                <div class="choose-title">
                    Добавить в
                </div>
                <div class="choose-checkbox-container">
                    <label><input type="checkbox" class="choose-checkbox">Мои юр. лица</label>
                </div>
                <div class="choose-checkbox-container">
                    <label><input type="checkbox" class="choose-checkbox">Поставщики</label>
                </div>
                <div class="choose-checkbox-container">
                    <label><input type="checkbox" class="choose-checkbox">Клиенты</label>
                </div>
                <div class="choose-checkbox-container">
                    <label><input type="checkbox" class="choose-checkbox">Конкуренты</label>
                </div>
                <div class="submit-button" onclick="submitadd()">Сохранить</div>
            </div>
        </div>
        <div class="search-container">
            <input placeholder="Что Вы ищете?" class="search-input-text" onkeypress="runScript(event)" type="text">
            <div class="search-button" onclick="searchrequest()" onkeypress="runScript(event)">
                Найти
            </div>
        </div>
        <div class="result-container">
            <div class="result-items-wrapper">
                <div class="result-item">
                    <div style="overflow:hidden;">
                        <div class="result-fav"></div>
                        <a href="">
                            <div class="result-title"></div>
                        </a>
                    </div>
                    <div class="result-description"></div>
                    <div class="result-ogrn"></div>
                    <div class="result-inn"></div>
                </div>
            </div>
        </div>
        <div class="view-more-button" onclick="viewmore()">
            Ещё
        </div>
        <div class="loading-gif-container">
            <div class="loading-gif"></div>
            <div class="error-container"></div>
        </div>
    </main>
    <footer>

    </footer>
</body>

<script>
    function getUrlParameter(name) {
        name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        var results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    };

    function runScript(e) {
        //See notes about 'which' and 'key'
        if (e.keyCode == 13) {
            searchrequest();
        }
    }

    var lsth = 0;

    function shownewitems(request) {
        loadinggif.style.display = 'block';
        viewmorebut.style.display = 'none';
        var xsmxHttp = new XMLHttpRequest();
        xsmxHttp.open("GET", '/api/getfav.php', false);
        xsmxHttp.send(null);
        favo = JSON.parse(xsmxHttp.responseText);
        //resultcontainer.style.display='none';
        httpGet('/api/getdata.php?request=' + request + '&offset=' + offset);
        xmlHttp.onreadystatechange = function() { // (3)
            //console.log('onreadystatechange ' + xmlHttp.readyState + ' ' + xmlHttp.status)
            if (xmlHttp.readyState != 4) { return; }
            answer = JSON.parse(xmlHttp.responseText);
            if (answer.items.length == 0) {
                errorcont.innerHTML = 'По Вашему запросу ничего не найдено';
            } else {
                errorcont.innerHTML = '';
                for (var i = 0; i < answer.items.length; i++) {
                    resultitemswrapper.innerHTML += itemshab;
                    resultitemswrapper.getElementsByTagName('a')[offset].href = "/enterprise/?ogrn=" + answer['items'][i]['ogrn'];
                    resultitemswrapper.getElementsByClassName('result-title')[offset].innerHTML = answer['items'][i]['name'];
                    resultitemswrapper.getElementsByClassName('result-title')[offset].id = answer['items'][i]['id'];
                    resultitemswrapper.getElementsByClassName('result-description')[offset].innerHTML = answer['items'][i]['description'];
                    resultitemswrapper.getElementsByClassName('result-ogrn')[offset].innerHTML = "ОГРН: " + answer['items'][i]['ogrn'];
                    resultitemswrapper.getElementsByClassName('result-inn')[offset].innerHTML = "ИНН: " + answer['items'][i]['inn'].substring(1, answer['items'][i]['inn'].length - 2);
                    resultitemswrapper.getElementsByClassName('result-fav')[offset].setAttribute('onclick', "addatr(" + offset + ")");
                    for (var ii = 0; ii < favo.length; ii++) {
                        //console.log(favo[ii] + ' ' + answer['items'][i]['id']);
                        if (favo[ii] == answer['items'][i]['id']) {
                            resultitemswrapper.getElementsByClassName('result-fav')[offset].classList.add('result-fav-active');
                            break;
                        }
                    }
                    offset += 1;
                }
            }
            loadinggif.style.display = 'none';
            if (answer['items'].length < 20) {
                viewmorebut.style.display = 'none';
            } else {
                viewmorebut.style.display = 'block';
            }
	       resultcontainer.style.display = 'block';
        }
    }

    function rematr(num) {
        document.getElementsByClassName('result-fav')[num].classList.remove('result-fav-active');
        document.getElementsByClassName('result-fav')[num].setAttribute('onclick', "addatr(" + num + ")");
    }
    var mkind = 0;

    function addatr(num) {
        document.getElementsByClassName('result-fav')[num].classList.add('result-fav-active');
        //document.getElementsByClassName('result-fav')[num].setAttribute('onclick', "rematr(" + num + ")");
        black.style.display = 'block';
        chooseconwrapper.style.display = 'block';
        mkind = num;
    }

    var xmlHttp = new XMLHttpRequest();

    function httpGet(theUrl) {
        xmlHttp.open("GET", theUrl, true);
        xmlHttp.send(null);
        return xmlHttp.responseText;
    }

    function searchrequest() {
        offset = 0;
        history.pushState('', '', '/search/?request=' + searchinput.value);
        resultitemswrapper.innerHTML = '';
        errorcont.innerHTML = '';
	shownewitems(searchinput.value);
    }
    var black = '';
    var chooseconwrapper = '';
    var offset = 0;
    var favo = ''
    window.onload = function() {
        offset = 0;
        console.log('started');
        resultcontainer = document.getElementsByClassName('result-container')[0];
        viewmorebut = document.getElementsByClassName('view-more-button')[0];
        loadinggif = document.getElementsByClassName('loading-gif')[0];
        searchinput = document.getElementsByClassName('search-input-text')[0];
        errorcont = document.getElementsByClassName('error-container')[0];
        errorcont.innerHTML = '';
        resultitemswrapper = document.getElementsByClassName('result-items-wrapper')[0];
        itemshab = resultitemswrapper.innerHTML;
        resultitemswrapper.innerHTML = '';
        if (getUrlParameter('request') == '') {
            loadinggif.style.display = 'none';
        } else {
            searchinput.value = getUrlParameter('request');
            shownewitems(searchinput.value);
        }
        black = document.getElementsByClassName('black')[0];
	chooseconwrapper = document.getElementsByClassName('choose-con-wrapper')[0];
    }

    function hidechoose() {
        black.style.display = 'none';
        chooseconwrapper.style.display = 'none';
        rematr(mkind);
    }

    function submitadd() {
        black.style.display = 'none';
	var mode = 0;
        chooseconwrapper.style.display = 'none';
        if (document.getElementsByClassName('choose-checkbox')[0].checked) {mode = 1}else{mode = 0}
            var xmxHttp = new XMLHttpRequest();
            xmxHttp.open("GET", '/api/setfav.php?mode='+mode+'&entid=' + document.getElementsByClassName('result-title')[mkind].id + '&listid=0', true);
            xmxHttp.send(null);
        if (document.getElementsByClassName('choose-checkbox')[1].checked) {mode = 1}else{mode = 0}
            var xmxxHttp = new XMLHttpRequest();
            xmxxHttp.open("GET", '/api/setfav.php?mode='+mode+'&entid=' + document.getElementsByClassName('result-title')[mkind].id + '&listid=1', true);
            xmxxHttp.send(null);
        if (document.getElementsByClassName('choose-checkbox')[2].checked) {mode = 1}else{mode = 0}
            var xmxxxHttp = new XMLHttpRequest();
            xmxxxHttp.open("GET", '/api/setfav.php?mode='+mode+'&entid=' + document.getElementsByClassName('result-title')[mkind].id + '&listid=2', true);
            xmxxxHttp.send(null);
        if (document.getElementsByClassName('choose-checkbox')[3].checked) {mode = 1}else{mode = 0}
            var xmxxxxHttp = new XMLHttpRequest();
            xmxxxxHttp.open("GET", '/api/setfav.php?mode='+mode+'&entid=' + document.getElementsByClassName('result-title')[mkind].id + '&listid=3', true);
            xmxxxxHttp.send(null);
    }

    function viewmore() {
	    shownewitems(searchinput.value);
    }
</script>

</html>
