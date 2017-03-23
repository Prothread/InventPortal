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
        <h1 class="crm-content-header"><?= TEXT_TEMPLATE_CREATE ?></h1>
        <form class="crm-add" action="?page=projectcreate" method="post">
            <div>
                <label><?= TABLE_TITLE ?></label>
                <input type="text" class="form-control" name="title">
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
    <div class="add-right-content add-content">
        <h1 class="crm-content-header"><?= TEXT_ADD_TASKS ?></h1>
        <div class="crm-add">
            <div>
                <label><?= TEXT_TASK_ADD ?></label>
                <select></select>
            </div>
            <div>
                <label><?= TEXT_TASK_OVERVIEW ?></label>
                <div id="taken-lijst">

                </div>
            </div>
        </div>
    </div>
</div>
