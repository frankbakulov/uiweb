<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="robots" content="index, follow">

    <?= $this->getDescription() ?>
    <?= $this->getKeywords() ?>
    <?= $this->getTitle() ?>

    <link rel="shortcut icon" type="image/x-icon" href="/php/assets/icon/favicon.ico">

    <link rel="stylesheet" href="/php/assets/common/css/fonts.css">
    <link rel="stylesheet" href="/php/assets/common/css/normalize.css">
    <link rel="stylesheet" href="/php/assets/common/css/custom-bootstrap.css">
    <link rel="stylesheet" href="/php/assets/main/css/main.css">

    <script type="text/javascript" src="/php/assets/common/js/scroll.js"></script>


    <script>
        //гугл аналитика

        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-57682954-1', 'auto');
        ga('send', 'pageview');

    </script>
</head>
<body>
    <!-- header start -->
    <?=Component::render("common", "header") ?>
    <!-- header end -->

    <div id="wrapper">
        <section id="content">
            <div id="main" class="page">
                <h1 class="text-center text-uppercase">Разработка веб-сайтов</h1>
                <h1 class="text-center text-uppercase">и приложений</h1>
                <h2 class="text-center text-uppercase">Новейший дизайн и уникальный функционал</h2>
                <div class="container buttons text-center">
                    <button class="btn btn-default" data-href="our-tech">Узнать больше</button>
                    <button class="btn btn-order" data-href="form-feedback">Сделать заказ</button>
                </div>
            </div>
            <div id="our-tech" class="page">
                <h1 class="text-center">Наши технологии</h1>
                <h4 class="text-center">В своих проектах мы изпользуем новейшие веб-технологии</h4>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-offset-1 col-lg-3 tech-icon icon-html5"></div>
                        <div class="col-lg-offset-1 col-lg-6">
                            <h2>html5</h2>
                            <h4>Мы делаем красивые сайты.</h4>
                            <h4>Валидная вёрстка - наши проекты проходят валидацию W3C.</h4>
                            <h4>Любой тип вёрстки - фиксированная, резиновая или адаптивная</h4>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-lg-offset-1 col-lg-6">
                            <h2>css3</h2>
                            <h4>Мы используем самые новейшие возможности в вёрстке</h4>
                            <h4>Мы используем CSS фреймворки, такие как Bootstrap</h4>
                        </div>
                        <div class="col-lg-offset-1 col-lg-3 tech-icon icon-css3"></div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-lg-offset-1 col-lg-3 tech-icon icon-php"></div>
                        <div class="col-lg-offset-1 col-lg-6">
                            <h2>php</h2>
                            <h4>У нас большой опыт разработки серверной части сайта</h4>
                            <h4>Мы реализуем проекты, на известных CMS, таких как Bitrix, UMI, WordPress, ModX revo, Djem, так и разрабатываем индивидуальные проекты.</h4>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-lg-offset-1 col-lg-6">
                            <h2>javascript</h2>
                            <h4>Нашими сайтами легко пользоваться, так как клиентская часть на высоте.</h4>
                            <h4>Мы используем все возможности упростить пользователю работу с сайтом.</h4>
                        </div>
                        <div class="col-lg-offset-1 col-lg-3 tech-icon icon-javascript"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-offset-1 col-lg-3 tech-icon icon-angularjs"></div>
                        <div class="col-lg-offset-1 col-lg-6">
                            <h2>Angularjs</h2>
                            <h4>Мы делаем динамические страницы, чтобы пользователю не нужно было обновлять страницу, чтобы увидеть изменения.</h4>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <!-- carousel start -->
            <?= Component::render("main", "carousel") ?>
            <!-- carousel end -->


            <!-- feedback form start -->
            <?= Component::render(
                "main",
                "form-feedback",
                [
                    'id' => 'form-feedback',
                    'action' => '/ajax/form-feedback',
                ]) ?>
            <!-- feedback form start -->

        </section>
    </div>

    <!-- footer start -->
    <?= Component::render("common", "footer") ?>
    <!-- footer start -->

    <script type="text/javascript" src="/php/assets/common/js/functions.js"></script>
</body>
</html>