document.addEventListener('DOMContentLoaded', function(){
    new Scrolling();

    /*window.requestAnimFrame = (function(callback) {
        return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame ||
        function(callback) {
            window.setTimeout(callback, 1000 / 60);
        };
    })();

    function animateGears(gears, lastTime, teeth_img, body_img) {
        var canvas = document.getElementById('gears');
        var context = canvas.getContext('2d');

        // update
        var time = (new Date()).getTime();
        var timeDiff = time - lastTime;

        for(var i = 0; i < gears.length; i++){
            var gear = gears[i];

            if(gears[i].clockwise){
                gears[i].theta -= (gear.thetaSpeed * timeDiff);
            }else{
                gears[i].theta += (gear.thetaSpeed * timeDiff);
            }
        }

        // clear
        context.clearRect(0, 0, canvas.width, canvas.height);

        // draw
        for(var i = 0; i < gears.length; i++){
            gears[i].draw(teeth_img, body_img);
        }

        // request new frame
        requestAnimFrame(function() {
            animateGears(gears, time, teeth_img, body_img);
        });
    }

    var gears=[];
    gears.push(new Gear({
        x: 80,
        y: 70,
        outerRadius: 60,
        innerRadius: 30,
        midRadius: 50,
        holeRadius: 30,
        numTeeth: 16,
        widthTeeth: 7,
        theta: 1,
        thetaSpeed: 1,
        clockwise: true,
        lightColor: '#B1CCFF',
        darkColor: '#3959CC'
    }));
    gears.push(new Gear({
        x: 90,
        y: 200,
        outerRadius: 80,
        innerRadius: 40,
        midRadius: 70,
        numTeeth: 16,
        widthTeeth: 7,
        theta: 6,
        thetaSpeed: 1,
        clockwise: false,
        lightColor: '#B1CCFF',
        darkColor: '#3959CC'
    }));
    gears.push(new Gear({
        x: 240,
        y: 230,
        outerRadius: 80,
        innerRadius: 40,
        midRadius: 70,
        numTeeth: 16,
        widthTeeth: 7,
        theta: 1,
        thetaSpeed: 1,
        clockwise: true,
        lightColor: '#B1CCFF',
        darkColor: '#3959CC',
        clear_center: 30
    }));
    gears.push(new Gear({
        x: 180,
        y: 70,
        outerRadius: 50,
        innerRadius: 20,
        midRadius: 40,
        numTeeth: 12,
        widthTeeth: 7,
        theta: 4,
        thetaSpeed: 1.2,
        clockwise: false,
        lightColor: '#B1CCFF',
        darkColor: '#3959CC',
        clear_center: 10
    }));
    gears.push(new Gear({
        x: 260,
        y: 90,
        outerRadius: 40,
        innerRadius: 20,
        midRadius: 30,
        numTeeth: 12,
        widthTeeth: 7,
        theta: 4,
        thetaSpeed: 1.2,
        clockwise: true,
        lightColor: '#B1CCFF',
        darkColor: '#3959CC',
        clear_center: 10
    }));
    gears.push(new Gear({
        x: 160,
        y: 150,
        outerRadius: 90,
        innerRadius: 60,
        midRadius: 80,
        numTeeth: 22,
        widthTeeth: 7,
        theta: 4,
        thetaSpeed: 1.2,
        clockwise: true,
        lightColor: '#B1CCFF',
        darkColor: '#3959CC',
        clear_center: 60
    }));

    var teeth_img = new Image();
    teeth_img.onload = function(){
        teeth_img = this;
        var body_img = new Image();
        body_img.onload = function(){
            var body_img = this;
            var time = (new Date()).getTime();
            animateGears(gears, time, teeth_img, body_img);
        }
        body_img.src = 'http://dev2.uiweb.ru/php/assets/texture/high/metal3.jpg';
    }
    teeth_img.src = 'http://dev2.uiweb.ru/php/assets/texture/high/radial-steel.jpg';
    */
});