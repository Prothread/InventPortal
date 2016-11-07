<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 11-Oct-16
 * Time: 08:32
 */



?>



<!--<div style="border:0;">
    <img src="<?/*=  DIR_IMAGE . '4k_22.jpeg' */?>" width=309 height=159 />
    <div style="position:relative; left: 0px; top: -159px; width:150px;">
        <img src="css/watermerk.png" width=300 height=150>
    </div>
</div>-->

<!-- thumbnail image wrapped in a link -->

<a href="#img1">
    <img src="<?= DIR_IMAGE . '4k_22.jpeg'?>" class="thumbnail">

    <div id="thumbnail"></div>
    <div id="thumbnail2"></div>
</a>
<style>
    .thumbnail {
        max-width: 40%;
    }
    #thumbnail {
        background: url('css/proef.png') repeat center, url(<?= DIR_IMAGE . '4k_22.jpeg'?>);
        background-size: 100%;
        max-width: 60%;
        height: 220px;
    }
    #thumbnail2 {
        background: url('css/proef.png') repeat, url(<?= DIR_IMAGE . '4k_22.jpeg'?>) ;
        background-size: 100px, 100%;
        max-width: 60%;
        height: 220px;
    }

    .italic { font-style: italic; }
    .small { font-size: 0.8em; }

    /** LIGHTBOX MARKUP **/

    .lightbox {
        /** Default lightbox to hidden */
        display: none;

        /** Position and style */
        position: fixed;
        z-index: 1001;
        width: 100%;
        height: 100%;
        text-align: center;
        top: 0;
        left: 0;
        background: rgba(0,0,0,0.8);
    }

    .lightbox div {
        /** Pad the lightbox image */
        max-width: 90%;
        max-height: 90%;
        margin: 0 auto;
        padding-top: 2%;
    }

    .lightbox:target {
        /** Remove default browser outline */
        outline: none;

        /** Unhide lightbox **/
        display: block;
    }

    .lightbox #thumbnail {
        background: url('css/proef.png') repeat center, url(<?= DIR_IMAGE . '4k_22.jpeg'?>);
        background-size: 100%;
        max-width: 100%;
        height:100%;
    }

    .lightbox #thumbnail2 {
        background: url('css/proef.png') repeat, url(<?= DIR_IMAGE . '4k_22.jpeg'?>) no-repeat;
        background-size: 13%, 100%;
        max-width: 100%;
        height:100%;
    }

    #lightboximage2 {
        z-index: 75;
        position: absolute;
        padding-top: 18%;
        padding-left: 44%;
    }
    #lightboximage1 {
        width:100%;
    }
</style>

<!--lightbox container hidden with CSS-->
<a href="#_" class="lightbox" id="img1">
    <div id="lighter">
        <!--<img id="lightboximage2" src="css/proef.png">
        <img id="lightboximage1" src="<?/*= DIR_IMAGE . '4k_22.jpeg'*/?>">-->

        <div id="thumbnail2"></div>

    </div>
</a>

<!--
<canvas id="canvas" width="290px" height="400px" style="border:1px solid #d3d3d3;"></canvas>
<script>

    var canvas = document.getElementById('canvas');
    var ctx = canvas.getContext('2d');

    img = new Image;
    img.onload = draw;

    img1 = new Image;
    img1.onload = draw;

    //img.src = "../app/uploads/Goodra_9.jpg";
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
-->