<!DOCTYPE html>
<html  lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="robots" content="index, follow">

    <?=$this->getDescription()?>
    <?=$this->getKeywords()?>
    <?=$this->getTitle()?>

    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">

    <link rel="stylesheet" href="/php/assets/common/css/fonts.css">
    <link rel="stylesheet" href="/php/assets/common/css/normalize.css">
    <link rel="stylesheet" href="/php/assets/common/css/custom-bootstrap.css">
    <link rel="stylesheet" href="/php/assets/common/css/header.css">
    <link rel="stylesheet" href="/php/assets/main/css/main.css">

    <!--<script type="text/javascript" src="/php/assets/main/js/scrolling.js"></script>-->
    <script type="text/javascript" src="/php/assets/common/js/functions.js"></script>
    <script type="text/javascript" src="/php/assets/main/js/gear.js"></script>
    <script type="text/javascript" src="/php/assets/main/js/main.js"></script>

</head>
<body>
<div id="wrapper">


    <!-- header start -->
    <?=Component::render("common", "header")?>
    <!-- header end -->



    <canvas id="main-canvas"></canvas>

    <section id="content">

        <div id="slider">
            <div id="slider-content">
                <div id="banner0" class="banner">

                </div>
                <div id="banner1" class="banner">
                    <div class="inner-relative container">
                        <!-- feedback form start -->
                        <?=Component::render(
                            "main",
                            "feedback-form",
                            [
                                'id' => 'feedback-form',
                                'action' => '/ajax/feedback',
                            ])?>
                        <!-- feedback form start -->
                    </div>
                </div>
                <div id="banner2" class="banner">
                    <!-- romos -->
                    <div class="romvos-footer poz1"></div>
                    <div class="footer-header poz1">
                        <h4 class="big-title">напишите нам</h4>
                        <a href="mailto:info@uiweb.ru">info@uiweb.ru</a>
                    </div>
                    <!-- romos -->
                </div>
                <div id="banner3" class="banner">

                </div>

            </div>
        </div>

        <!--<div>
            <?
        //вывод контента
        //echo $this->content
        ?>
        </div>-->

        <!--<canvas id="gears" width="330" height="320"></canvas>
        <div id="cover"></div>-->


    </section>

    <!-- footer start -->
    <?=Component::render("common", "footer")?>
    <!-- footer start -->

</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){

        function MainShow(selector) {
            var that = this;
            this.n = 0;
            this.coords = {x:0,y:0};

            this.getRandomInt = function(min, max) {
                return Math.floor(Math.random() * (max - min + 1)) + min;
            };

            //целочисленное деление
            function div(val, by){
                return (val - val % by) / by;
            }


            this.wave = function(y) {
                var residue = y % 360;
                var entered = y;
                //180 px - 1 x
                //y = 1 - cos(x)^2
                //Math.sqrt(y)

                //получаем остаток от деления
                y = y / 15;
                console.log(residue);

                var x = Math.sqrt(1 - Math.pow(Math.sin(-y), 2));

                if(residue > 90) {
                    return -x * 45;
                }else{
                    return x * 45;
                }


                /*if(x <){

                }else{

                }*/

            };

            this.e = document.getElementById(selector);
            this.e.width = window.innerWidth;
            this.e.height = window.innerHeight;

            //console.log(this.e.width);

            this.c = this.e.getContext("2d");

            // clear
            //this.c.clearRect(0, 0, this.e.width, this.e.height);

            var bodyElems = document.getElementsByTagName("body");
            var body = bodyElems[0];

            /*addListenerMulti(body, 'DOMMouseScroll mousewheel', function (e){
                console.log(1);
                if(e.detail > 0 || e.wheelDelta < 0){
                    that.n++;
                    that.direction = 'down';
                }else{
                    that.n--;
                    that.direction = 'up';
                }
            });*/

            this.c.lineWidth = 2;
            this.c.lineJoin = this.c.lineCap = 'round';
            this.c.strokeStyle = 'purple';


            setInterval(function(){

                that.c.beginPath();
                that.n = that.n + 5;
                var x = that.wave(that.n)+200;
                var y = that.n
                that.c.moveTo(that.coords.x-that.getRandomInt(0, 3), that.coords.y - that.getRandomInt(0, 3));
                that.c.lineTo(x-that.getRandomInt(0, 3), y-that.getRandomInt(0, 3));
                that.c.stroke();
                that.coords = {x:x,y:y};

                console.log('x - ' + that.wave(that.n) + ',  y- ' + that.n);
            }, 100);
        }

        new MainShow("main-canvas");
    });
</script>

</body>
</html>