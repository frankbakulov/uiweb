<!DOCTYPE html>
<html  lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="robots" content="index, follow">

    <?=$this->getDescription()?>
    <?=$this->getKeywords()?>
    <?=$this->getTitle()?>

    <link rel="shortcut icon" type="image/x-icon" href="/php/assets/icon/favicon.ico">

    <link rel="stylesheet" href="/php/assets/common/css/fonts.css">
    <link rel="stylesheet" href="/php/assets/common/css/normalize.css">
    <link rel="stylesheet" href="/php/assets/common/css/custom-bootstrap.css">
    <link rel="stylesheet" href="/php/assets/inner/css/inner.css">

    <link rel="stylesheet" href="/php/assets/user/css/form-register.css">
    <link rel="stylesheet" href="/php/assets/user/css/form-login.css">

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


    <?=Component::render("common", "header")?>

    <div id="wrapper">
        <div class="container">
            <section id="content">
                <?=$this->content?>
            </section>
        </div>
    </div>

    <?=Component::render("common", "footer")?>
</body>
</html>