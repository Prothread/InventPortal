<?php
#TERMS AND CONDITIONS PAGE
?>

<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <p class="NameText">Algemene voorwaarden</p>
                <hr size="1">
                <div style="height:100%;width:100%;border:1px solid #ccc;font:16px/26px Cabin; overflow:auto;">

                    <embed width="100%" height="100%"
                           src="img/Algemene voorwaarden Madalco Media BV - V2016.2.pdf"></embed>

                    <?php
                        $ctype = "application/pdf";
                        $fullPath = 'img/Algemene voorwaarden Madalco Media BV - V2016.2.pdf';
                    if (!headers_sent()) {
                        header('Content-type: application/pdf');
                        header('Content-Disposition: inline; filename="' . $filename . '"');
                        header('Content-Transfer-Encoding: binary');
                        header('Content-Length: ' . filesize($fullPath));
                        header('Accept-Ranges: bytes');

                        readfile($fullPath);
                    }
                        return true; ?>


                </div>
            </div>
        </div>
    </div>
</div>