function Carousel (settings) {
    "use strict";

    this.carousel = settings.carousel;


    //проверка на существование карусельки
    if(this.carousel !== null) {

        //ширина карусели от количества вложенных элементов
        this.inner = document.querySelector('#' + this.carousel.id + ' .slider-inner');


        this.items = [];


        this.options = {};

        //начальный слайдер
        this.options.place = (settings.startAt === undefined ? 1 : settings.startAt);
        this.currentItem = this.options.place - 1;


        //запускать при инициализации
        this.options.autoPlay = (settings.autoPlay === undefined ? false : settings.autoPlay);

        //интервал в секундах
        this.options.duration = (settings.duration === undefined ? 5 : settings.duration);

        //таймер, можно юзать для остановки
        this.options.timer = null;

        this.options.aniDuration = 500;

        //анимация
        this.step = null;
        this.fps = 32;
        this.interval = 1000 / this.fps;
        this.totalStep = this.options.aniDuration / this.interval;


        //функции
        this.options.beforeStart = (settings.beforeStart === undefined ? function () {
        } : settings.beforeStart);
        this.options.afterEnd = (settings.afterEnd === undefined ? function () {
        } : settings.afterEnd);

        this.generateItems();
        this.prepareItems();


        if (!this.options.autoPlay) {
            this.play();
        }
    }
}

//запись элеметнтов в массив
Carousel.prototype.generateItems = function () {
    this.items = [];
    var nodes = this.inner.children;
    for (var i = 0; i < nodes.length; i++) {
        //проверка по тегу
        if (nodes[i].tagName === "DIV") {
            this.items.push(nodes[i]);
        }
    }
};

//простоановка позиций
Carousel.prototype.prepareItems = function () {
    for (var i = 0; i < this.items.length; i++) {
        this.items[i].style.left = (100 * i) + '%';
        this.items[i].style.width = '100%';
    }
};

//запуск с задержкой
Carousel.prototype.play = function () {
    var self = this;
    this.options.timer = setTimeout(function () {
        self.periodicallyUpdate();
    }, self.options.duration*1000);
};

Carousel.prototype.pause = function () {
    clearTimeout(this.options.timer);
};

Carousel.prototype.periodicallyUpdate = function () {
    this.next();
};

Carousel.prototype.getCurrentItem = function(){
    /*if(){
     return
     }else{

     }*/
};

Carousel.prototype.getNextItem = function(){
    if(this.options.place == this.items.length){
        return 0;
    }else{
        return this.currentItem;
    }
};

Carousel.prototype.animate = function(item, from, to){

    var self = this;

    var step = 0;
    var change = to - from;

    function animate () {

        //шаги до завершения
        //меняем шаг, пока шаги не закончены
        if (step < self.totalStep) {
            step++;
        }

        var percentComplete = (step/self.totalStep),
            newValue = change * self.ease(percentComplete);

        self.items[item].style.left = (from + newValue) + '%';

        //повторяем итерации пока не выполним шаги
        if (step < self.totalStep) {
            requestAnimationFrame(animate);
        } else {
            self.items[item].style.left = to + '%';
        }
    }

    requestAnimationFrame(animate);

};

Carousel.prototype.next = function () {

    if ( this.options.place === this.items.length){
        this.animate(this.currentItem, parseFloat(this.items[this.currentItem].style.left), -100);
        this.animate(0, 100, 0);
        this.currentItem = 0;
        this.options.place = 1;
        this.play();
    }else{
        //устанавливаем позиции при листании
        var item = this.currentItem;
        this.animate(item, parseFloat(this.items[this.currentItem].style.left), -100);

        this.items[item+1].style.left = '100%';
        this.animate(item+1, parseFloat(this.items[this.currentItem+1].style.left), 0);
        this.currentItem++;
        this.options.place++;
        this.play();
    }

};

Carousel.prototype.ease = function(pos){
    if ((pos/=0.5) < 1){
        return 0.5 * Math.pow(pos,2);
    }else {
        return -0.5 * ((pos -= 2) * pos - 2);
    }
};