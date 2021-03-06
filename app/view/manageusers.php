<?php
#OVERZICHT PAGE VAN ALLE GEBRUIKERS

if ($user->getPermission($permgroup, 'CAN_SHOW_USERS') == 1) {

} else {
    $block->Redirect('index.php');
    Session::flash('error', TEXT_NO_PERMISSION);
}

$user = new UserController();

$get_filled_info = $user->getAllUsersByPerm(1);
?>

<div class="container">
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <p class="NameText"><?= TEXT_USER_OVERVIEW ?></p>
                    <hr size="1">

                    <?php if ($user->getPermission($permgroup, 'CAN_CREATE_USER') == 1) { ?>
                        <a href="index.php?page=newuser">
                            <button id="NewClientButton"><?= BUTTON_NEWUSER ?></button>
                        </a>
                    <?php } ?>

                    <?php if ($get_filled_info !== null) { ?>

                        <table id="myTable" class="table table-striped">
                            <thead>
                            <tr>
                                <th style="display:none">ID</th>
                                <th><?= TEXT_NAME ?></th>
                                <th><?= TEXT_COMPANY_NAME ?></th>
                                <th><?= TEXT_EMAIL ?></th>
                                <th><?= TEXT_ADRESS ?></th>
                                <th><?= TEXT_POSTALCODE ?></th>
                                <th><?= TEXT_CITY ?></th>
                                <th>Edit</th>
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
                                        <a href="?page=showuserprofile&id=<?= $upload['id'] ?>"><?= $upload['naam'] ?></a>
                                    </td>
                                    <td>
                                        <?= $upload['bedrijfsnaam'] ?>
                                    </td>
                                    <td>
                                        <?= $upload['email'] ?>
                                    </td>
                                    <td>
                                        <?= $upload['adres'] ?>
                                    </td>
                                    <td>
                                        <?= $upload['postcode']; ?>
                                    </td>
                                    <td>
                                        <?= $upload['plaats']; ?>
                                    </td>
                                    <td>
                                        <?php $uploadid = $upload['id']; ?>
                                        <a href="?page=editclient&id=<?= $uploadid ?>"><img
                                                src="img/icons/settings-hover.png" style="width: 24px; height: 24px;">
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>

                    <?php } else { ?>
                        <div id="weiger" class="alert alert-info" style="text-align: center;" role="alert"><span
                                class="glyphicon glyphicon-remove-circle"></span> Er zijn nog geen gebruikers aangemaakt
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#myTable').dataTable({
            "order": [[0, "desc"]],
            "deferRender": true
        });

    });
</script>