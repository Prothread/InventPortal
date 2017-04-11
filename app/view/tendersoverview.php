<?php
$tender = new TenderController();
$allTenders = $tender->getAllTenders();

$userController = new UserController();
$clients = $userController->getClientList();
$users = $userController->getUserList();

?>

<div id="case-overview-holder" class="crm-content-wrapper">
    <h1 class="crm-content-header"><?= TENDER_OVERVIEW_TEXT ?></h1>
    <div class="case-overzicht-buttons">
        <button class="custom-file-upload overview-add-button"
                onclick="window.location.href='?page=addtender'"><?= TEXT_CREATE_DROPDOWN ?></button>
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
            <?php if (sizeof($allTenders) > 0) {
                foreach ($allTenders as $tender) {
                    $hasUser = false;
                    $hasClient = false;
                    ?>
                    <tr>
                        <td>
                            <a href="?page=tenderview&id=<?= $tender['id'] ?>"><?= $tender['subject'] ?></a>
                        </td>
                        <td>
                            <a href="?page=showuserprofile&id=<?= $tender['user'] ?>"> <?php
                                foreach ($users as $user) {
                                    if ($user['id'] == $tender['user']) {
                                        echo $user['naam'];
                                        $hasUser = true;
                                    }
                                }
                                ?></a>
                            <?php
                            if (!$hasUser) {
                                echo "-";
                            }
                            ?>
                        </td>
                        <td>
                            <a href="?page=showuserprofile&id=<?= $tender['client'] ?>"> <?php
                                if (!is_null($clients)) {
                                    foreach ($clients as $client) {
                                        if ($client['id'] == $tender['client']) {
                                            echo $client['naam'];
                                            $hasClient = true;
                                        }
                                    }
                                }
                                ?></a>
                            <?php
                            if (!$hasClient) {
                                echo "-";
                            }
                            ?>
                        </td>
                        <td>
                            &#8364; <?= $tender['value'] ?>
                        </td>
                        <td>
                            <?= $tender['chance'] ?> &#37;
                        </td>
                        <td>
                            <?= date("d-m-Y", strtotime($tender['endDate'])) ?>
                        </td>
                        <td>
                            <img src="css/status-<?= $tender['status'] ?>.png">
                        </td>
                    </tr>
                <?php }
            } ?>

            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function () {
            $('#myTable').dataTable({
                "order": [[0, "desc"]],
                "deferRender": true
            });

        });
    </script>