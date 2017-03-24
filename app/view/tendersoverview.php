<?php
$allTenders;
$tender = new TenderController();

$allTenders = $tender->getAllTenders();

?>

<div id="case-overview-holder">

    <header><?=TENDER_OVERVIEW_TEXT?></header>
    <hr>
    <div class="case-overzicht-buttons">
        <button class="custom-file-upload"><?=TEXT_CREATE_DROPDOWN?></button>
        <button class="custom-file-upload"><?=TEXT_ARCHIVE?></button>
    </div>
    <div class="case-overvieuw-table">
        <table id="myTable" class="table table-striped">
            <thead>
            <tr>
                <th><?=TABLE_TITLE?></th>
                <th><?=TEXT_EMPLOYEE?></th>
                <th><?=TEXT_CLIENT?></th>
                <th><?=TEXT_VALUE_TEXT?></th>
                <th><?=TEXT_CHANCE_TEXT?></th>
                <th><?=TEXT_END_DATE?></th>
                <th><?=TEXT_PROGRESS?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($allTenders as $tender) { ?>

                <tr>
                    <td>
                        <a href="?page=tenderview&id= <?=$tender['id']?>"><?= $tender['onderwerp'] ?></a>
                    </td>
                    <td>
                        <a href="#"><?= $tender['werknemer'] ?></a>
                    </td>
                    <td>
                        <a href="#"><?= $tender['klant'] ?></a>
                    </td>
                    <td>
                        &#8364; <?= $tender['waarde'] ?>
                    </td>
                    <td>
                        <?= $tender['kans'] ?> &#37;
                    </td>
                    <td>
                        <?= $tender['aanmaakdatum'] ?>
                    </td>
                    <td>
                        <img src="css/bezig-icon.png">
                    </td>
                </tr>

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