<!DOCTYPE html>
<html lang='ru'>

<head>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/pages/head.php') ?>

    <title>True Search</title>

    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/about.css">
    <link rel="stylesheet" href="/css/ourteam.css">

    <link rel="preload" href="/images/first-background.jpg" as="image">

    <script>
        function searchrequest() {
            var req = document.getElementsByClassName('search-input-text')[0].value;
            if (req != '') {
                document.location = '/search/?request=' + req;
            }
        }

        function runScript(e) {
            // See notes about 'which' and 'key'
            if (e.keyCode == 13) {
                searchrequest();
            }
        }

    </script>
</head>

<body>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/pages/header.php') ?>

    <main>
        <div class="hello-block">
            <div class="hello-title">
                True Search
            </div>
            <div class="hello-description">
                Найдите надежного партнера по бизнесу
            </div>
            <div class="search-container">
                <input placeholder="Что Вы ищете?" class="search-input-text" onkeypress="runScript(event)" type="text">
                <div class="search-button" onclick="searchrequest()">
                    Найти
                </div>
            </div>
            <div class="more-container">
                <div class="more-text">
                    <a href="#scrolltitle">
                        <span>Подробнее</span>
                    </a>
                </div>
                <div class="more-img">
                    <a href="#scrolltitle">
                        <img src="/images/more-down-black.png" alt="">
                    </a>
                </div>
            </div>
        </div>

        <div class="container" id="scrolltitle">
            <div class="section-title">
                <h1 class="title">О компании</h1>
                <p class="sub-title">
                    <span class="colortext2">True Search</span> - это профессиональная платформа для нетворкинга, в которой предприниматели работают и общаются вместе, и менее чем за 5 секунд находят себе поставщиков и партнеров по бизнесу.
                    <br /><br /><br />
                    <span class="colortext">Наша команда, сотрудничая с правительством Москвы, создала базу с самыми надежными компаниями.</span>
                </p>
            </div>
        </div>

        <div class="container">
            <div class="statistics-box">
                <div class="statistics-item">
                    <span class="value">80000</span>
                    <p class="title">компаний</p>
                </div>
                <div class="statistics-item">
                    <span class="value">0</span>
                    <p class="title">сделок</p>
                </div>
                <div class="statistics-item">
                    <span class="value">0</span>
                    <p class="title">посещаемость</p>
                </div>
            </div>
        </div>

        <div class="skitch">
            <h2 class="pink">Как работает сервис? </h2>
            <ol class="settle">
                <li><span class="test">Заказчик/поставщик в поисковой строке вбивает запрос</span></li>
                <li><span class="test">Получает список компаний</span></li>
                <li><span class="test">Подробно ознакамливается с ними на страничке</span></li>
                <li><span class="test">Связывается с поставщиком/заказчиком</span></li>
                <li><span class="test">Заключает сделку</span></li>
            </ol>
        </div>

        <div class="nail">
            <h2>В чем наши преимущества?</h2>
        </div>
        <div class="ruby nun">
            <h3 class="prom">Для заказчика</h3>
            <ul class="cru">
                <li><span class="test">Бесплатный поиск лучших поставщиков</span></li>
                <li><span class="test">Меньше чем за 5 секунд вы найдете 10 компаний, по интересующей вас тематике</span></li>
                <li><span class="test">Исключена возможность попадания в базу фирм “однодневок”</span></li>
                <li><span class="test">Мы создали удобный чат для общения с другими компаниями</span> </li>
            </ul>
        </div>
        <div class="ruby2 nun">
            <h3 class="prom2">Для поставщика</h3>
            <ul class="cru2">
                <li><span class="test">Вы получаете новых клиентов, не тратя на это времени</span></li>
                <li><span class="test">Ежедневный приток клиентов на ваш бизнес</span></li>
                <li><span class="test">Доступ ко всей базе заявок и удобный чат для общения</span></li>
                <li><span class="test">Контекстная реклама</span></li>
                <li><span class="test">Продвижение продукции через каталог товаров и услуг</span></li>
            </ul>
        </div>

        <div class="container">
            <section class="section section-destination">
                <div id="scrollourteam" class="section-title">
                    <div class="container">
                        <h1 class="title">Наша команда</h1>
                        <p class="sub-title">Animis opibusque parati.</p>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-sm-12 col-xs-24">
                            <div class="destination-box">
                                <div class="box-cover">
                                    <img src="/images/team-members/1.jpg" alt="destination image" />
                                </div>
                                <div class="box-details">
                                    <div class="box-meta">
                                        <h4 class="city">Роман Морозов</h4>
                                        <p class="country">Веб-разработчик<br /> полного цикла</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8 col-sm-12 col-xs-24">
                            <div class="destination-box">
                                <div class="box-cover">
                                    <img src="/images/team-members/2.jpg" alt="destination image" />
                                </div>
                                <div class="box-details">
                                    <div class="box-meta">
                                        <h4 class="city">Демид Конанов</h4>
                                        <p class="country">Дизайнер</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8 col-sm-12 col-xs-24">
                            <div class="destination-box">
                                <div class="box-cover">
                                    <img src="/images/team-members/3.jpg" alt="destination image" />
                                </div>
                                <div class="box-details">
                                    <div class="box-meta">
                                        <h4 class="city">Никулина Анна</h4>
                                        <p class="country">Frontend разработчик, дизайнер</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8 col-sm-12 col-xs-24">
                            <div class="destination-box">
                                <div class="box-cover">
                                    <img src="/images/team-members/4.jpg" alt="destination image" />
                                </div>
                                <div class="box-details">
                                    <div class="box-meta">
                                        <h4 class="city">Александр Измайлов</h4>
                                        <p class="country">Спикер,<br> менеджер проекта</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8 col-sm-12 col-xs-24 lonblo8">
                            <div class="destination-box">
                                <div class="box-cover">
                                    <img src="/images/team-members/5.jpg" alt="destination image" />
                                </div>
                                <div class="box-details">
                                    <div class="box-meta">
                                        <h4 class="city">Дарья Нестерова</h4>
                                        <p class="country">Frontend разработчик, бизнес-аналитик</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8 col-sm-12 col-xs-24">
                            <div class="destination-box">
                                <div class="box-cover">
                                    <img src="/images/team-members/6.jpg" alt="destination image" />
                                </div>
                                <div class="box-details">
                                    <div class="box-meta">
                                        <h4 class="city">Артём Булгаков</h4>
                                        <p class="country">Программист</p>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-8 col-sm-12 col-xs-24">
                            <div class="destination-box">
                                <div class="box-cover">
                                    <img src="/images/team-members/7.jpg" alt="destination image" />
                                </div>
                                <div class="box-details">
                                    <div class="box-meta">
                                        <h4 class="city">Артур Лукьянов</h4>
                                        <p class="country">Программист<br /> машинного<br /> обучения</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
</body>

</html>
