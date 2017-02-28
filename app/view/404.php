<?php
#404 ERROR PAGE

unset($contenter);

?>

<div id="error404">
    <div class="error">
        <br/><br/><br/><br/><br/>
        <h1 class="elegantshadow">Error 404</h1>
        <br>
        <hr class="style17">
        <h3 style="color: #dd2c4c; font-family: 'Abhaya Libre', serif; font-size: 40px;"
            class="font-bold"><?= TEXT_MESSAGE_ERROR_404_TITLE ?>...</h3>
        <div style="color: #000; font-family: 'Open Sans', sans-serif; font-size: 20px;" class="error-desc">
            <?= TEXT_MESSAGE_ERROR_404 ?>
            <div>
                <br>
                <a class=" login-detail-panel-button btn" href="#">
                    <a href="?page=dashboard"
                       style="font-family: 'Abhaya Libre', serif; font-size: 25px; color: #dd2c4c"
                       class="btn btn-lg btn-default">Homepage</a>
                </a>
            </div>
        </div>
    </div>
</div>