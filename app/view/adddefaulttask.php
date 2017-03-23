<?php
/**
 * Created by PhpStorm.
 * User: freek
 * Date: 22-3-2017
 * Time: 16:37
 */


?>
<div class="crm-content-wrapper">
    <div class="add-left-content add-content">
        <h1 class="crm-content-header"><?= TEXT_DEFAULTTASK_CREATE ?></h1>
        <form class="crm-add" action="?page=projectcreate" method="post">
            <div>
                <label><?= TABLE_TITLE ?></label>
                <input type="text" class="form-control" name="title">
            </div>
            <div>
                <label><?= TEXT_DURATION ?></label>
                <input type="number" class="form-control" name="duration">
            </div>
            <div class="description-holder">
                <label><?= TEXT_DESCRIPTION ?></label>
                <textarea name="description"></textarea>
            </div>
            <div class="button-holder">
                <div class="button-push"></div>
                <button type="submit" class="custom-file-upload"><?= TEXT_CREATE_DROPDOWN ?></button>
            </div>
        </form>
    </div>
</div>
