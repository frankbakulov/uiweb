function Scroll(settings){
    'use strict';

    this.options = {};
    this.options.marginTop = (settings.marginTop === undefined ? 0 : settings.startAt);

    this.init();
}

Scroll.prototype.init = function () {
    var self = this;

    //вешаем событие при клике на все элементы с атрибутами
    //атрибуты ведут на элементы с нужным id
    var elements = document.querySelectorAll('[data-href]');
    Array.prototype.forEach.call(elements, function(v, k){
        v.addEventListener('click', function (e) {
            var to = document.getElementById(v.getAttribute('data-href')).offsetTop;
            self.animate(to);
        });
    });
};

Scroll.prototype.animate = function (to) {

    var self = this;
    var from = window.scrollY;
    var step = 0;
    function animateDown(){
        var from = window.scrollY;

        if(from < to-60){
            step += 10;
            var from = from + step;
            window.scrollTo(0, from);
            requestAnimationFrame(animateDown);
        }else{
            window.scrollTo( 0, (to-60) );
        }
    }

    function animateUp(){
        var from = window.scrollY;

        if(from > to-60){
            step += 10;
            var from = from - step;
            window.scrollTo(0, from);
            requestAnimationFrame(animateUp);
        }else{
            window.scrollTo( 0, ( to-60 ) );
        }
    }

    //проверяем где сейчас находится экран относительно
    //объекта к которому будем скролить
    if(from < to-60){
        requestAnimationFrame(animateDown);
    }else{
        requestAnimationFrame(animateUp);
    }
};
