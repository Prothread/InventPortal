<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 11-Oct-16
 * Time: 08:32
 */

?>

<canvas id="canvas" width="290px" height="400px" style="border:1px solid #d3d3d3;"></canvas>

<script>

    var canvas = document.getElementById('canvas');
    var ctx = canvas.getContext('2d');

    img = new Image;
    img.onload = draw;
    img.src = "../app/uploads/Goodra_9.jpg";

    img1 = new Image;
    img1.onload = draw;
    img1.src = "../public/css/watermerk.png";

    function draw() {
        drawImageProp(ctx, this, 0, 0, canvas.width, canvas.height);
    }

    function drawImageProp(ctx, img, x, y, w, h, offsetX, offsetY) {

        if (arguments.length === 2) {
            x = y = 0;
            w = ctx.canvas.width;
            h = ctx.canvas.height;
        }

        /// default offset is center
        offsetX = typeof offsetX === 'number' ? offsetX : 0.5;
        offsetY = typeof offsetY === 'number' ? offsetY : 0.5;

        /// keep bounds [0.0, 1.0]
        if (offsetX < 0) offsetX = 0;
        if (offsetY < 0) offsetY = 0;
        if (offsetX > 1) offsetX = 1;
        if (offsetY > 1) offsetY = 1;

        var iw = img.width,
            ih = img.height,
            r = Math.min(w / iw, h / ih),
            nw = iw * r,   /// new prop. width
            nh = ih * r,   /// new prop. height
            cx, cy, cw, ch, ar = 1;

        /// decide which gap to fill
        if (nw < w) ar = w / nw;
        if (nh < h) ar = h / nh;
        nw *= ar;
        nh *= ar;

        /// calc source rectangle
        cw = iw / (nw / w);
        ch = ih / (nh / h);

        cx = (iw - cw) * offsetX;
        cy = (ih - ch) * offsetY;

        /// make sure source rectangle is valid
        if (cx < 0) cx = 0;
        if (cy < 0) cy = 0;
        if (cw > iw) cw = iw;
        if (ch > ih) ch = ih;

        /// fill image in dest. rectangle
        ctx.drawImage(img, cx, cy, cw, ch,  x, y, w, h);
    }

    var dataURL = canvas.toDataURL();

    var wrapper = document.getElementById('wrapper');

    var img2 = new Image();
    img2.onload=function(){
        document.body.appendChild(wrapper);
    };

    img2.src = dataURL;

</script>