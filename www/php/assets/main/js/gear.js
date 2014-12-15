function Gear(config){
    'use strict';

    this.x = config.x;
    this.y = config.y;
    this.outerRadius = config.outerRadius;
    this.innerRadius = config.innerRadius;
    this.midRadius = config.midRadius;
    this.holeRadius = config.holeRadius;
    this.numTeeth = config.numTeeth;
    this.widthTeeth = config.widthTeeth;
    this.theta = config.theta;
    this.thetaSpeed = config.thetaSpeed / 1000;
    this.lightColor = config.lightColor;
    this.darkColor = config.darkColor;
    this.clockwise = config.clockwise;
    this.clear_center = config.clear_center;

    this.draw = function (teeth_img, body_img) {
        var canvas = document.getElementById('gears');
        //canvas.width = 300;
        //canvas.height = 300;
        var context = canvas.getContext('2d');

        var pat = context.createPattern(teeth_img,"no-repeat");

        context.save();
        var numPoints = this.numTeeth * 2;


        context.beginPath();
        context.lineJoin = 'bevel';
        for(var n = 0; n < numPoints; n++) {

            var radius = null;

            if(n % 2 == 0) {
                radius = this.outerRadius;
            }
            else {
                radius = this.innerRadius;
            }

            var theta = this.theta;
            theta += ((Math.PI * 2) / numPoints) * (n + 1);

            var x = (radius * Math.sin(theta)) + this.x;
            var y = (radius * Math.cos(theta)) + this.y;

            if(n == 0) {
                context.moveTo(x, y);
            }
            else {
                context.lineTo(x, y);
            }
        }
        context.closePath();

        context.lineWidth = this.widthTeeth;
        context.strokeStyle = pat;
        context.stroke();





        context.beginPath();

        context.translate(this.x, this.y);
        context.rotate(-theta);
        context.translate(-this.x, -this.y);

        context.arc(this.x, this.y, this.midRadius, 0, 2 * Math.PI, false);
        context.clip();

        context.drawImage(body_img, 0, 0, 1024, 1024, 0, 0, 560, 560);


        //console.log(this.x);
        //console.log(this.y);
        //context.drawImage(img, 0, 0, 330, 330, 0, 0, 200, 200);

        context.stroke();
        context.closePath();
        if(this.clear_center > 0 && this.clear_center != null){
            context.beginPath();
            context.globalCompositeOperation = 'destination-out';
            context.arc(this.x, this.y, this.clear_center, 0, 2 * Math.PI, false);
            context.fill();
            context.closePath();

            //context.globalCompositeOperation = 'source-over';
            context.globalCompositeOperation = 'source-over';
            context.lineWidth = this.widthTeeth;
            context.strokeStyle = pat;
            context.stroke();
            context.closePath();
        }
        context.restore();
    };

}