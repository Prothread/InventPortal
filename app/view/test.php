<?php
#TEST

if($user->getPermission($permgroup, 'CAN_SHOW_OVERZICHT') == 1){

} else {
    $block->Redirect('index.php?page=showuserprofile');
}

$mail = new MailController();
$uploads = new BlockController();

$verified = '0, 1';
$get_filled_info = $uploads->getOlderUploads($verified);
?>

<div id="container">
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Nieuw item</h4>
                </div>
                <div class="modal-body">
                    <br>

                    <div class="fetched-data"></div>

                </div>
                <div class="modal-footer">

                </div>
            </div>

        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#myModal').on('show.bs.modal', function (e) {
                var rowid = $(e.relatedTarget).data('id');
                $.ajax({
                    type : 'post',
                    url : '?page=item2', //Here you will fetch records
                    data :  'rowid='+ rowid, //Pass $id
                    success : function(data){
                        $('.fetched-data').html(data);//Show fetched data from database
                    }
                });
            });
        });
    </script>

    <div class="container">
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <table style="width:100%">
                        <tr>
                            <th style="text-align: left;"><p class="NameText" style="font-weight: normal;">Overzicht</p></th>
                            <th style="text-align: right;">

                                <a href="?page=showuserprofile">
                                    <button type="button" class="btn btn-labeled btn-success MyOverviewButton">
                                        <span class="btn-label"><i class="glyphicon glyphicon-list-alt"></i></span> Mijn overzicht</button>
                                </a>

                            </th>
                        </tr>
                    </table>
                    <hr>

                    <table id="myTable" class="table table-striped" >
                        <thead>
                        <tr>
                            <?php if($get_filled_info !== null) {?>
                                <th style="display:none">ID</th>
                                <th>Onderwerp</th>
                                <th>Verstuurder</th>
                                <th>Naam</th>
                                <th id="date">Datum</th>
                                <th>Status</th>
                            <?php }
                            else {?>
                                <th></th>
                            <?php } ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if($get_filled_info !== null) {
                            foreach ($get_filled_info as $upload) { ?>
                                <tr>
                                    <td style="display:none">
                                        <?= $upload['id']; ?>
                                    </td>
                                    <td>
                                        <a href="#myModal" data-toggle="modal" data-id="<?= $upload['id']?>" href="#upl<?= $upload['id']?>"><?= $upload['onderwerp'] ?></a>
                                    </td>
                                    <td>
                                        <?= $upload['verstuurder'] ?>
                                    </td>
                                    <td>
                                        <?= $upload['naam'] ?>
                                    </td>
                                    <td>
                                        <?= date("d-m-Y", strtotime($upload['datum'])); ?>
                                    </td>
                                    <td>
                                        <span style="display:none" id="status"><?= $upload['verified']; ?></span>
                                        <?php if ($upload['verified'] == 1) { ?>
                                            <img alt="Gezien" style="width: 50px; height: 50px;"
                                                 src="public/icons/gezien.png">
                                        <?php } elseif ($upload['verified'] == 2) { ?>
                                            <img alt="Geaccepteerd" src="public/icons/akkoord.png">
                                        <?php } elseif ($upload['verified'] == 3) { ?>
                                            <img alt="Geweigerd" src="public/icons/geweigerd.png">
                                        <?php } else { ?>
                                            <img alt="Uploaded" src="public/icons/uploaded.png">
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php }
                        }
                        else {?>
                            <td>U heeft nog geen proeven geaccordeerd</td>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#myTable').dataTable({
                "order": [[ 0, "desc" ]],
                "deferRender": true
            });

        });
    </script>
</div>

<canvas id="canvas" width="290px" height="auto" style="border:1px solid #d3d3d3;"></canvas>
<script>

    var canvas = document.getElementById('canvas');
    var ctx = canvas.getContext('2d');

    img = new Image;
    img.onload = draw;

    img1 = new Image;
    img1.onload = draw;

    img.src =  "<?= 'app/uploads/' . $_GET['img']?>";
    img1.src = "css/watermerk.png";

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