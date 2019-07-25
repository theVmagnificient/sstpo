<!DOCTYPE html>
<html lang='ru'>

<head>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/pages/head.php') ?>

    <title>True Search</title>
</head>

<body>
<?php
    if (isset($_GET['login'])) {
        if($_GET['login'] == 'admin' && $_GET['password'] == 'admin') {
            echo '<img src="https://memepedia.ru/wp-content/uploads/2018/03/bund-1-768x577.jpg"/>';
        } else {
            echo '<img src="https://cs7.pikabu.ru/post_img/2019/05/08/5/1557297093170620460.gif"/>';
        }
    }
?>
    <form action="/admin">
        Login: <input name="login" /><br />
        Password: <input name="password" type="password" /><br />
        <input type="submit" />
    </form>
</body>

</html>
