<!DOCTYPE html>
<html lang='ru'>

<head>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/pages/head.php') ?>

    <title>Вход | True Search</title>

    <link rel="stylesheet" href="/css/main.css">
</head>

<body>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/pages/header.php') ?>

    <main>
        <div class="login-wrapper">
            <div class="login-block">
                <div class="mode-selector">
                    <div class="mode-item" onclick="setmode(0);">
                        Вход
                    </div>
                    <div class="mode-item active-mode-item" onclick="setmode(1);">
                        Регистрация
                    </div>
                </div>
                <div class="input-container">
                    <input class="login-input-firstname" style="width:300px" type="text" placeholder="Имя">
                    <input class="login-input-surname" style="width:300px" type="text" placeholder="Фамилия">
                    <input class="login-input-email" style="width:300px" type="email" placeholder="E-mail">
                    <input class="login-input-password" style="width: 300px" type="password" placeholder="Пароль">
                </div>
                <div class="result-log-container"></div>
                <div class="login-button signin-button" onclick=signinbut()>
                    Войти
                </div>
                <div class="login-button signup-button" style="width:250px" onclick=signupbut()>
                    Зарегистрироваться
                </div>
            </div>
        </div>
    </main>
</body>

<script>
    function setmode(num) {
        if (num == 0) {
            loginbut[0].style.display = 'block';
            loginbut[1].style.display = 'none';
            inpconmas[0].style.display = 'none';
            inpconmas[1].style.display = 'none';
            modeitem[1].style.background = 'black';
            modeitem[0].style.background = 'white';
            modeitem[0].style.color = 'black';
            modeitem[1].style.color = 'white';
            anslog.innerHTML = '';
        } else if (num == 1) {
            loginbut[1].style.display = 'block';
            loginbut[0].style.display = 'none';
            inpconmas[0].style.display = 'block';
            inpconmas[1].style.display = 'block';
            modeitem[1].style.background = 'white';
            modeitem[0].style.background = 'black';
            modeitem[1].style.color = 'black';
            modeitem[0].style.color = 'white';
            anslog.innerHTML = '';
        }
    }
    var xxmlHttp = new XMLHttpRequest();

    function httpGetx(theUrl) {
        xxmlHttp.open("GET", theUrl, true);
        xxmlHttp.send(null);
        return xxmlHttp.responseText;
    }
    xxmlHttp.onreadystatechange = function() {
        if (xxmlHttp.readyState != 4) {
            return;
        }
        result = JSON.parse(xxmlHttp.responseText);
        if (result != false) {
            setmode(0);
        } else {
            anslog.innerHTML = 'E-mail уже занят';
        }
    }
    var xmlHttp = new XMLHttpRequest();

    function httpGet(theUrl) {
        xmlHttp.open("GET", theUrl, true);
        xmlHttp.send(null);
        return xmlHttp.responseText;
    }
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState != 4) {
            return;
        }
        result = JSON.parse(xmlHttp.responseText);
        if (result != false) {
            console.log(result);
            document.cookie = "acto=" + result + ';path=/;';
            document.location = '/';
        } else {
            anslog.innerHTML = 'Неверный E-mail или пароль';
        }
    }

    function gettoken(mode) {
        if (mode == 0 && inpconmas[3].value.length > 5 && inpconmas[2].value.length > 5) {
            anslog.innerHTML = '';
            email = inpconmas[2].value;
            password = inpconmas[3].value;
            httpGet('/api/gettoken.php?mode=' + mode + '&password=' + password + '&email=' + email);
        } else if (mode == 1 && inpconmas[0].value.length > 0 && inpconmas[1].value.length > 0 && inpconmas[2].value.length > 5 && inpconmas[3].value.length > 5) {
            anslog.innerHTML = '';
            firstname = inpconmas[0].value;
            surname = inpconmas[1].value;
            email = inpconmas[2].value;
            password = inpconmas[3].value;
            httpGetx('/api/gettoken.php?mode=' + mode + '&password=' + password + '&email=' + email + '&firstname=' + firstname + '&surname=' + surname);
        } else {
            anslog.innerHTML = 'Заполните все поля';
        }
    }

    function signinbut() {
        gettoken(0);
    }

    function signupbut() {
        gettoken(1);
    }

    window.onload = function() {
        loginbut = document.getElementsByClassName('login-button');
        inpcon = document.getElementsByClassName('input-container')[0];
        inpconmas = inpcon.getElementsByTagName('input');
        modeitem = document.getElementsByClassName('mode-item');
        anslog = document.getElementsByClassName('result-log-container')[0];
    }

</script>

</html>
