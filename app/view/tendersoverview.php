<?php
$allTenders;
$tender = new TenderController();

$allTenders = $tender->getAllTenders();

$userController = new UserController();
$clients = $userController->getClientList();
$users = $userController->getUserList();

?>

<div id="case-overview-holder">

    <header><?= TENDER_OVERVIEW_TEXT ?></header>
    <hr>
    <div class="case-overzicht-buttons">
        <button class="custom-file-upload"><?= TEXT_CREATE_DROPDOWN ?></button>
        <button class="custom-file-upload"><?= TEXT_ARCHIVE ?></button>
    </div>
    <div class="case-overvieuw-table">
        <table id="myTable" class="table table-striped">
            <thead>
            <tr>
                <th><?= TABLE_TITLE ?></th>
                <th><?= TEXT_EMPLOYEE ?></th>
                <th><?= TEXT_CLIENT ?></th>
                <th><?= TEXT_VALUE_TEXT ?></th>
                <th><?= TEXT_CHANCE_TEXT ?></th>
                <th><?= TEXT_END_DATE ?></th>
                <th><?= TEXT_PROGRESS ?></th>
            </tr>
            </thead>
            <tbody>
            <?php if (sizeof($allTenders) > 0) { ?>
                <?php foreach ($allTenders as $tender) { ?>

                    <tr>
                        <td>
                            <a href="?page=tenderview&id=<?= $tender['id'] ?>"><?= $tender['subject'] ?></a>
                        </td>
                        <td>
                            <a href="?page=showuserprofile&id=<?= $tender['user'] ?>"> <?php
                                foreach ($users as $user) {
                                    if ($user['id'] == $tender['user']) {
                                        echo $user['naam'];
                                    }
                                }
                                ?></a>
                        </td>
                        <td>
                            <a href="?page=showuserprofile&id=<?= $tender['client'] ?>"> <?php
                                foreach ($clients as $client) {
                                    if ($client['id'] == $tender['client']) {
                                        echo $client['naam'];
                                    }
                                }
                                ?></a>
                        </td>
                        <td>
                            &#8364; <?= $tender['value'] ?>
                        </td>
                        <td>
                            <?= $tender['chance'] ?> &#37;
                        </td>
                        <td>
                            <?= date("d-m-Y", strtotime($tender['enddate'])) ?>
                        </td>
                        <td>
                            <img src="css/bezig-icon.png">
                        </td>
                    </tr>

                <?php } ?>
            <?php } ?>

            </tbody>
        </table>
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