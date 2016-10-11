<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 11-Oct-16
 * Time: 08:32
 */

?>

<img id="poke" src="../app/uploads/Goodra_9.jpg" alt="Pokemon Goodea" width="220" height="277" />
<canvas id="canvas0" width="250px" height="300px" style="border:1px solid #d3d3d3;"></canvas>
<canvas id="canvas1"></canvas>
<canvas id="canvas2"></canvas>
<canvas id="canvas3"></canvas>
<canvas id="canvas4"></canvas>

<script>
    var canvas = document.getElementById('canvas0');
    var context = canvas.getContext('2d');

    var canvas1=document.getElementById('canvas1');
    var canvas2=document.getElementById('canvas2');
    var canvas3=document.getElementById('canvas3');
    var canvas4=document.getElementById('canvas4');

    var img = document.getElementById('poke');

    context.drawImage(img,0,0);
    context.drawImage(canvas1,0,0);
    context.drawImage(canvas2,100,0);
    context.drawImage(canvas3,0,100);
    context.drawImage(canvas4,100,100);
</script>