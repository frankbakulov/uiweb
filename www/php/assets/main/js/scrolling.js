function Scrolling(){
    'use strict';

    var that = this;
    this.count_banners = document.querySelectorAll('.banner').length;
    this.banners = document.querySelectorAll('.banner');
    this.slider = document.getElementById('slider');
    this.n = 0;
    //this.positions = ['bottom', 'top', 'left', 'top'];
    //допилить для использования подряд одинаковых скролов
    this.positions = ['bottom', 'top', 'left', 'top'];
    this.visible_banner = 0;
    this.direction = 'down';

    function addListenerMulti(el, s, fn){
        var events = s.split(' ');
        for(var i = 0; i < events.length; i++){
            el.addEventListener(events[i], fn, false);
        }
    }

    this.init = function(){
        Array.prototype.forEach.call(that.banners, function(v, k){
            if(k !== 0) {
                console.log(k);
                console.log(v);
                v.style[that.positions[k]] = '100%';
            }
        });
        var bodyElems = document.getElementsByTagName("body");
        var body = bodyElems[0];
        //отслеживание скроллинга
        addListenerMulti(body, 'DOMMouseScroll mousewheel', function (e){
            console.log(1);
            if(e.detail > 0 || e.wheelDelta < 0){
                that.n--;
                that.direction = 'down';
            }else{
                that.n++;
                that.direction = 'up';
            }
            e.preventDefault();
        });
        that.slide();
    };
    this.slide = function(){
        that.move = setInterval(function() {
            var percent = 100;
            var n = -(that.n * 5);
            var count_banners = that.count_banners;

            if(n <= 0){
                that.n = 0
            }
            if(n >= (count_banners * percent)-100){
                that.n = -((count_banners * 100)-100)/5 ;
            }
            Array.prototype.forEach.call(that.banners, function(v, k){
                //console.log(n);
                if(k == 0){
                    if(n >= 0 && n <= percent) {
                        that.visible_banner = k;
                        that.banners[k].style[that.positions[k+1]] = -n + '%';
                        that.banners[k+1].style[that.positions[k+1]] = (percent - n) + '%';
                        that.banners[k+1].style[that.positions[k+2]] = '0%';
                        that.banners[k+2].style[that.positions[k+2]] = '100%';
                    }
                }else if(k !== count_banners-1){
                    if(n >= percent*k && n < (percent*k)+100) {
                        that.visible_banner = k;
                        that.banners[k - 1].style[that.positions[k]] = '100%';
                        that.banners[k].style[that.positions[k]] = '0%';
                        that.banners[k].style[that.positions[k + 1]] = -(n - percent * k) + '%';
                        that.banners[k + 1].style[that.positions[k + 1]] = (percent * (k + 1) - n) + '%';
                        //скролл не всегда отрабатывает до конца
                        //побеждаем так
                        if(that.direction == 'up' && that.visible_banner == count_banners-3){
                            that.banners[count_banners-1].style[that.positions[count_banners-1]] = '100%';
                            that.banners[count_banners-2].style[that.positions[count_banners-1]] = '0%';
                        }
                    }
                }else{
                    if(n >= percent*k){
                        that.visible_banner = k;
                        that.banners[k-1].style[that.positions[k]] = '100%';
                        that.banners[k].style[that.positions[k]] = '0%';
                    }
                }
            });
        }, 50);
    };
    this.init();
}