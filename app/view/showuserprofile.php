<?php
#PAGE FOR SHOWING PROFILE

if ($user->getPermission($permgroup, 'CAN_SHOW_USERS') == 1) {

} else {
    $block->Redirect('index.php');
    Session::flash('error', TEXT_NO_PERMISSION);
}

$user = new UserController();
$session = new Session();

if (isset($_GET['id'])) {
    $_GET['id'] = $session->cleantonumber($_GET['id']);
    $userinfo = $user->getUserById($_GET['id']);
} else {
    echo '<div class="alert alert-info">Profiel niet gevonden</div>';
    return false;
}

$uploads = new BlockController();
$items = new MailController();
$user = new UserController();

if ($userinfo['permgroup'] == '1') {
    $clientID = $userinfo['id'];
    $userid = $userinfo['id'];
    $get_filled_info = $items->getUserMailByUserId($userid, null, null, $clientID);
} else {
    $userid = $userinfo['id'];
    $get_filled_info = $items->getUserMailByUserId($userid);
}
?>

<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 profile">
                <div class="container">
                    <table style="width:100%">
                        <tr>
                            <th style="text-align: left;"><p class="NameText" style="font-weight: normal;">
                                    <?= TEXT_USERPROFILE ?><?= $userinfo['naam'] ?></p></th>
                            <th style="text-align: right;">

                                <?php if($user->getPermission($permgroup, 'CAN_RESET_CLIENT_PASSWORD') == '1' && $userinfo['permgroup'] == '1') { ?>
                                    <a data-toggle="modal" data-target="#NewUserPassword" href="#">
                                        <button type="button" class="btn btn-labeled btn-success MyOverviewButton">
                                            <span class="btn-label"><i class="glyphicon glyphicon-lock"></i></span><?= TEXT_RESET_PASSWORD ?>
                                        </button>
                                    </a>
                                <?php }
                                else if($user->getPermission($permgroup, 'CAN_RESET_USER_PASSWORD') == '1' && $userinfo['permgroup'] !== '1') { ?>
                                    <a data-toggle="modal" data-target="#NewUserPassword" href="#">
                                        <button type="button" class="btn btn-labeled btn-success MyOverviewButton">
                                            <span class="btn-label"><i class="glyphicon glyphicon-lock"></i></span><?= TEXT_RESET_PASSWORD ?>
                                            </button>
                                    </a>
                                <?php } ?>

                                <?php if ($user->getPermission($permgroup, 'CAN_EDIT_CLIENT') == 1 && $userinfo['permgroup'] == '1') { ?>
                                    <a href="?page=editclient&id=<?= $_GET['id'] ?>">
                                        <button type="button" class="btn btn-labeled btn-success MyOverviewButton">
                                            <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span><?= TEXT_EDIT_USER ?>
                                        </button>
                                    </a>
                                <?php }
                                else if ($user->getPermission($permgroup, 'CAN_EDIT_USER') == 1 && $userinfo['permgroup'] !== '1') { ?>
                                    <a href="?page=editclient&id=<?= $_GET['id'] ?>">
                                        <button type="button" class="btn btn-labeled btn-success MyOverviewButton">
                                            <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span><?= TEXT_EDIT_USER ?>
                                        </button>
                                    </a>
                                <?php } ?>

                                <?php if ($user->getPermission($permgroup, 'CAN_DELETE_CLIENT') == 1 && $userinfo['permgroup'] == '1') { ?>
                                    <a data-toggle="modal" data-target="#DeleteUser" href="#">
                                        <button type="button" class="btn btn-labeled btn-success MyOverviewButton">
                                            <span class="btn-label"><i class="glyphicon glyphicon-remove"></i></span><?= TEXT_DELETE_USER ?>
                                        </button>
                                    </a>
                                <?php } ?>

                                <?php if ($user->getPermission($permgroup, 'CAN_DELETE_USER') == 1 && $userinfo['permgroup'] !== '1') { ?>
                                    <a data-toggle="modal" data-target="#DeleteUser" href="#">
                                        <button type="button" class="btn btn-labeled btn-success MyOverviewButton">
                                            <span class="btn-label"><i class="glyphicon glyphicon-remove"></i></span><?= TEXT_DELETE_USER ?>
                                        </button>
                                    </a>
                                <?php } ?>
                            </th>
                            </th>
                        </tr>
                    </table>
                    <hr>

                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-3">
                            <div class="text-center">
                                <div style="background: url(<?= DIR_IMG . $userinfo['profimg'] ?>); background-size: cover; width: 200px; height: 200px; background-position: 50%; margin: 0 auto" class="avatar img-circle"></div>

                                <input class="form-control" type="file">
                            </div>
                        </div>

                        <!-- edit form column -->
                        <div class="col-md-9 personal-info">
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= TEXT_NAME ?></label>
                                    <div class="col-lg-8">
                                        <input readonly class="form-control" value="<?= $userinfo['naam'] ?>"
                                               type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= TEXT_COMPANY_NAME ?></label>
                                    <div class="col-lg-8">
                                        <input readonly class="form-control" value="<?= $userinfo['bedrijfsnaam'] ?>"
                                               type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= TEXT_EMAIL ?></label>
                                    <div class="col-lg-8">
                                        <input readonly class="form-control" value="<?= $userinfo['email'] ?>"
                                               type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= TEXT_ADRESS ?></label>
                                    <div class="col-lg-8">
                                        <input readonly class="form-control" value="<?= $userinfo['adres'] ?>"
                                               type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= TEXT_POSTALCODE ?></label>
                                    <div class="col-lg-8">
                                        <input readonly class="form-control" size="6"
                                               value="<?= $userinfo['postcode'] ?>" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?= TEXT_CITY ?></label>
                                    <div class="col-lg-8">
                                        <input readonly class="form-control" value="<?= $userinfo['plaats'] ?>"
                                               type="text">
                                    </div>
                                </div>

                                <?php if ($user->getPermission($permgroup, 'CAN_EDIT_USER') == '1'){ ?>
                                    <?php $usrperm = $user->getPermissionGroupName($userinfo['permgroup']); ?>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label"><?= TEXT_PERMISSION ?></label>
                                        <div class="col-lg-8">
                                            <input readonly class="form-control" value="<?= $usrperm['name'] ?>" type="text">
                                        </div>
                                    </div>
                                <?php } ?>
                                <!--<div class="form-group">
                                  <label class="col-md-3 control-label"></label>
                                  <div class="col-md-8">
                                    <input disabled class="btn btn-primary" value="Opslaan" type="button">-->
                                <span></span>
                        </div>
                    </div>
                    </form>



                    <?php if (isset($get_filled_info) && $get_filled_info !== null) { ?>
                    <br />
                    <br />
                    <br />

                    <table id="myTable" class="table table-striped">
                        <thead>
                        <tr>

                            <th style="display:none">ID</th>
                            <th><?= TABLE_TITLE ?></th>
                            <th><?= TEXT_SENDER ?></th>
                            <th><?= TEXT_CLIENT ?></th>
                            <th id="date"><?= TEXT_DATE ?></th>
                            <th><?= TEXT_PROGRESS ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($get_filled_info as $upload) { ?>
                            <tr>
                                <td style="display:none">
                                    <?= $upload['id']; ?>
                                </td>
                                <td>
                                    <a href="?page=item&id=<?= $upload['id'] ?>"><?= $upload['onderwerp'] ?></a>
                                </td>
                                <td>
                                    <?php $usr = $user->getUserById($upload['verstuurder']); ?>
                                    <a href="?page=showuserprofile&id=<?= $usr['id'] ?>"><?= $usr['naam'] ?></a>
                                </td>
                                <td>
                                    <?php $clnt = $user->getUserById($upload['naam']); ?>
                                    <a href="?page=showuserprofile&id=<?= $clnt['id'] ?>"><?= $clnt['naam'] ?></a>
                                </td>
                                <td>
                                    <?= date("d-m-Y", strtotime($upload['datum'])); ?>
                                </td>
                                <td>
                                    <span style="display:none" id="status"><?= $upload['verified']; ?></span>
                                    <?php if ($upload['verified'] == 1) { ?>
                                        <img alt="Gezien" src="icons/gezien.png">
                                    <?php } elseif ($upload['verified'] == 2) { ?>
                                        <img alt="Geaccepteerd" src="icons/akkoord.png">
                                    <?php } elseif ($upload['verified'] == 3) { ?>
                                        <img alt="Geweigerd" src="icons/geweigerd.png">
                                    <?php } else { ?>
                                        <img alt="Uploaded" src="icons/uploaded.png">
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>

                <script>
                    $(document).ready(function () {
                        $('#myTable').dataTable({
                            "order": [[0, "desc"]],
                            "deferRender": true
                        });

                    });
                </script>

                </div>
            </div>
        </div>

        <br/>
        <br/>

    </div>
    <hr>

</div>

<!-- Modal -->
<div class="modal fade" id="NewUserPassword" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div style="text-align: center;" class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?= TEXT_RESET_PASSWORD ?></h4>
            </div>
            <div style="text-align: center;" class="modal-body">
                <br>

                <p> <?= TEXT_MESSAGE_DELETING_PASSWORD ?> <b><?= $userinfo['naam'] ?></b> <?= TEXT_MESSAGE_DELETING_PASSWORD1 ?> <br/><br/>
                    <?= TEXT_ARE_YOU_SURE ?><br/><br/></p>
                <a href="?page=newuserpassword&id=<?= $_GET['id'] ?>">
                    <button type="button" class="btn btn-labeled btn-success MyOverviewButton">
                        <span class="btn-label"><i class="glyphicon glyphicon-lock"></i></span><?= TEXT_RESET_PASSWORD ?>
                    </button>
                </a>

                <br/>
                <br/>
            </div>
            <div class="modal-footer">

            </div>
        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="DeleteUser" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div style="text-align: center;" class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?= TEXT_DELETE_USER ?></h4>
            </div>
            <div style="text-align: center;" class="modal-body">
                <br>

                <p> <?= TEXT_MESSAGE_DELETING_USER ?> <b><?= $userinfo['naam'] ?></b> <?= TEXT_MESSAGE_DELETING_USER1 ?> <br/><br/>
                    <?= TEXT_ARE_YOU_SURE ?><br/><br/></p>
                <a href="?page=deleteuser&id=<?= $_GET['id'] ?>">
                    <button type="button" class="btn btn-labeled btn-success MyOverviewButton">
                        <span class="btn-label"><i class="glyphicon glyphicon-remove"></i></span><?= TEXT_DELETE_USER ?>
                    </button>
                </a>

                <br/>
                <br/>
            </div>
            <div class="modal-footer">

            </div>
        </div>

    </div>
</div>