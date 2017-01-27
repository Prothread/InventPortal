<?php
#STATUSPORTAL PAGE

$hoi = mysqli_connect("localhost", "root", "", "statusportaal") or die("There was a problem connecting to the database");

if($user->getPermission($permgroup, 'CAN_USE_STATUSPORTAL') == 1){

}
else {
    $block->Redirect('index.php');
    Session::flash('error', TEXT_NO_PERMISSION);
}

$status = new StatusController();
$StatusItems = $status->getItems();

$user = new UserController();
$users = $user->getAllUsersByPerm(1);
?>
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <table style="width:100%">
                    <tr>
                        <th align="left" style="font-weight: normal;"><p class="NameText">Statusportaal</p></th>
                        <th style="text-align: right;"><div id="NewClientButton" style="background-color: #dd2c4c;" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Nieuw item</div></th>
                    </tr>
                </table>

                <hr size="1">
                <div class="row equal">
                    <div class="col-lg-12 text-left">
                        <?php if($StatusItems !==  null) { ?>

                            <div style="width: 30%; border: 1px #e0e0e0; background-color: #FFF;" class="panel">
                                <div style="background-color: #dd2c4c; height: 30px; -moz-border-radius: 0; -webkit-border-radius: 3px 3px 0 0; border-radius: 3px 3px 0 0; " class="panel-header">
                                    <h3 id="TitleFont" style="line-height: 1.5; margin-left: 4px; color: #FFF; font-weight: normal; text-align: center;" class="panel-title"><span id="GlyphiconHead" class="glyphicon glyphicon-flag"></span> Leads</h3>
                                </div>
                                <div class="inner" style="width: 95%; margin: 0 auto;">

                                    <div class="panel-body">

                                        <?php foreach($StatusItems as $StatusItem) { ?>
                                            <?php
                                            if($StatusItem['category']=='Lead'){
                                                $thisuser = $user->getUserById(  $StatusItem['person']  );
                                                $today = date('Y-m-d');
                                                $nextday = date('Y-m-d', strtotime('+1 day'));

                                                $statusdate = $StatusItem['deadline'];

                                                if($today < $statusdate) {
                                                    $rightdate = 'OnTime';
                                                }
                                                if($nextday == $statusdate) {
                                                    $rightdate = 'OneDayToDL';
                                                }
                                                if($today == $statusdate) {
                                                    $rightdate = 'OneDayToDL';
                                                }
                                                if($today > $statusdate) {
                                                    $rightdate = 'TooLate';
                                                }
                                                ?>
                                                <div>
                                                    <div id="<?= $rightdate ?>" class="item">

                                                        <a href="?page=statusitem&id=<?= $StatusItem['id'] ?>"><span class="lettertype" id="textright" style="text-align:right; margin-left: 4px; text-decoration: none; color: #000;"><?= $StatusItem['subject']?></span></a>

                                                        <div id="smallaf" style="text-align: right; font-size: 13px; margin-right: 5px;"><?= $thisuser['naam'] ?></div>


                                                    </div>
                                                </div>
                                                <div id="betweenwhite" style="height: 6px;"></div>
                                            <?php }} ?>

                                    </div>
                                </div>
                            </div>

                            <div style="width: 20px; background-color: #FFF" id="middle"></div>

                            <div style="width: 30%; border: 1px #e0e0e0;" class="panel">
                                <div style="background-color: #dd2c4c; height: 30px; -moz-border-radius: 0; -webkit-border-radius: 3px 3px 0 0; border-radius: 3px 3px 0 0; text-align: center;" class="panel-header">
                                    <h3 id="TitleFont" style="line-height: 1.5; margin-left: 4px; color: #FFF; font-weight: normal;" class="panel-title"><span id="GlyphiconHead" class="glyphicon glyphicon-pencil"></span> Offertes</h3>
                                </div>
                                <div class="inner" style="width: 95%; margin: 0 auto;">
                                    <div class="panel-body">

                                        <?php foreach($StatusItems as $StatusItem) { ?>
                                            <?php
                                            if($StatusItem['category']=='Offerte'){
                                                $thisuser = $user->getUserById(  $StatusItem['person']  );
                                                $today = date('Y-m-d');
                                                $nextday = date('Y-m-d', strtotime('+1 day'));

                                                $statusdate = $StatusItem['deadline'];

                                                if($today < $statusdate) {
                                                    $rightdate = 'OnTime';
                                                }
                                                if($nextday == $statusdate) {
                                                    $rightdate = 'OneDayToDL';
                                                }
                                                if($today == $statusdate) {
                                                    $rightdate = 'OneDayToDL';
                                                }
                                                if($today > $statusdate) {
                                                    $rightdate = 'TooLate';
                                                }
                                                ?>
                                                <div>
                                                    <div id="<?= $rightdate ?>" class="item">
                                                        <a href="?page=statusitem&id=<?= $StatusItem['id'] ?>"><span class="lettertype" id="textright" style="    text-align:right; margin-left: 4px; text-decoration: none; color: #000;"><?= $StatusItem['subject']?></span></a>
                                                        <div id="smallaf" style="text-align: right; font-size: 13px; margin-right: 5px;"><?= $thisuser['naam'] ?></div>
                                                    </div>
                                                </div>
                                                <div id="betweenwhite" style="height: 6px;"></div>
                                            <?php }} ?>
                                    </div>
                                </div>
                            </div>

                            <div style="width: 20px; background-color: #FFF" id="middle"></div>

                            <div style="width: 30%; border: 1px #e0e0e0;" class="panel">
                                <div style="background-color: #dd2c4c; height: 30px; -moz-border-radius: 0; -webkit-border-radius: 3px 3px 0 0; border-radius: 3px 3px 0 0; text-align: center;" class="panel-header">
                                    <h3 id="TitleFont" style="line-height: 1.5; margin-left: 4px; color: #FFF; font-weight: normal;" class="panel-title"><span id="GlyphiconHead" class="glyphicon glyphicon-folder-open"></span>&nbsp; Projecten</h3>
                                </div>


                                <div class="inner" style="width: 95%; margin: 0 auto;">

                                    <div class="panel-body">

                                        <?php foreach($StatusItems as $StatusItem) { ?>
                                            <?php
                                            if($StatusItem['category']=='Project'){
                                                $thisuser = $user->getUserById(  $StatusItem['person']  );
                                                $today = date('Y-m-d');
                                                $nextday = date('Y-m-d', strtotime('+1 day'));

                                                $statusdate = $StatusItem['deadline'];

                                                if($today < $statusdate) {
                                                    $rightdate = 'OnTime';
                                                }
                                                if($nextday == $statusdate) {
                                                    $rightdate = 'OneDayToDL';
                                                }
                                                if($today == $statusdate) {
                                                    $rightdate = 'OneDayToDL';
                                                }
                                                if($today > $statusdate) {
                                                    $rightdate = 'TooLate';
                                                }
                                                ?>
                                                <div>
                                                    <div id="<?= $rightdate ?>" class="item">
                                                        <a href="?page=statusitem&id=<?= $StatusItem['id'] ?>"><span class="lettertype" id="textright" style="text-align:right; margin-left: 4px; text-decoration: none; color: #000;"><?= $StatusItem['subject']?></span></a>

                                                        <div id="smallaf" style="text-align: right; font-size: 13px; margin-right: 5px;"><?= $thisuser['naam'] ?></div>


                                                    </div>
                                                </div>
                                                <div id="betweenwhite" style="height: 6px;"></div>
                                            <?php }} ?>

                                    </div>
                                </div>

                            </div>
                            <div style="width: 20px; background-color: #FFF" id="middle"></div>

                            <div style="width: 30%; border: 1px #e0e0e0;" class="panel">
                                <div style="background-color: #dd2c4c; height: 30px; -moz-border-radius: 0; -webkit-border-radius: 3px 3px 0 0; border-radius: 3px 3px 0 0; text-align: center;" class="panel-header">
                                    <h3 id="TitleFont" style="line-height: 1.5; margin-left: 4px; color: #FFF; font-weight: normal;" class="panel-title"><span id="GlyphiconHead" class="glyphicon glyphicon-exclamation-sign"></span>  To-do</h3>
                                </div>

                                <div class="inner" style="width: 95%; margin: 0 auto;">

                                    <div class="panel-body">

                                        <?php foreach($StatusItems as $StatusItem) { ?>
                                            <?php
                                            if($StatusItem['category']=='To-do'){
                                                $thisuser = $user->getUserById(  $StatusItem['person']  );
                                                $today = date('Y-m-d');
                                                $nextday = date('Y-m-d', strtotime('+1 day'));

                                                $statusdate = $StatusItem['deadline'];

                                                if($today < $statusdate) {
                                                    $rightdate = 'OnTime';
                                                }
                                                if($nextday == $statusdate) {
                                                    $rightdate = 'OneDayToDL';
                                                }
                                                if($today == $statusdate) {
                                                    $rightdate = 'OneDayToDL';
                                                }
                                                if($today > $statusdate) {
                                                    $rightdate = 'TooLate';
                                                }
                                                ?>
                                                <div>
                                                    <div id="<?= $rightdate ?>" class="item">
                                                        <a href="?page=statusitem&id=<?= $StatusItem['id'] ?>"><span class="lettertype" id="textright" style="text-align:right; margin-left: 4px; text-decoration: none; color: #000;"><?= $StatusItem['subject']?></span></a>

                                                        <div id="smallaf" style="text-align: right; font-size: 13px; margin-right: 5px;"><?= $thisuser['naam'] ?></div>


                                                    </div>
                                                </div>
                                                <div id="betweenwhite" style="height: 6px;"></div>
                                            <?php }} ?>

                                    </div>
                                </div>


                            </div>
                        <?php } else {?><div class="alert alert-info" role="alert">Er zijn nog geen items aangemaakt</div><?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
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


                <form action="?page=nieuwstatusitem" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <fieldset>


                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">Onderwerp</label>
                            <div class="col-md-4">
                                <input class="form-control input-md" maxlength="40" id="textinput" type="text" name="onderwerp" placeholder="Onderwerp">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">Persoon</label>
                            <div class="col-md-4">

                                <?php if($users !== null || !empty($users)) { ?>
                                    <select class="form-control" name="name">

                                        <?php foreach($users as $user) { ?>
                                            <option class="form-control input-md" value="<?= $user['id']?>"><?= $user['naam'] ?></option>
                                        <?php } ?>

                                    </select>
                                <?php } ?>

                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">Deadline</label>
                            <div class="col-md-4">
                                <input class="form-control input-md" type="text" id="datepicker" name="deadline" placeholder="Deadline dd/mm/yyyy">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">Opmerking</label>
                            <div class="col-md-4">
                                <textarea class="form-control input-md" id="textinput" maxlength="300" type="text" name="comment" placeholder="Opmerking"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">Categorie</label>

                            <div class="col-md-4">
                                <select class="form-control" name="category">
                                    <option>Lead</option>
                                    <option>Offerte</option>
                                    <option>Project</option>
                                    <option>To-do</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput"></label>
                            <div class="col-md-4">
                                <input class="btn btn-primary btn-success" name="submit"  style="max-width: 100px; background-color: #bb2c4c; border: 1px solid #dd2c4c" type="submit" value="Aanmaken">
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="Sure" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Weet u zeker dat u dit item wilt verwijderen?</h4>
            </div>
            <div class="modal-body">
                <br>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>