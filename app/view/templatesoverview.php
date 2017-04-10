<?php
$template = new templateController();
$allTemplates = $template->getAllTemplates();
$templatetask = new TemplateTaskLinksController();

?>

<div id="case-overview-holder">

    <header>Templates Overzicht</header>
    <hr>
    <div class="case-overzicht-buttons">
        <button class="custom-file-upload">Aanmaken</button>
        <button class="custom-file-upload">Archief</button>
    </div>
    <div class="case-overvieuw-table">
        <table id="myTable" class="table table-striped">
            <thead>
            <tr>
                <th>Onderwerp</th>
                <th>Beschrijving</th>
                <th>Taken</th>
            </tr>
            </thead>
            <tbody>
            <?php if (sizeof($allTemplates) > 0) {
                foreach ($allTemplates as $template) {
                    $t = $templatetask->getTaskAmountByTemplateId($template['id']);
                    ?>
                    <tr>
                        <td>
                            <a href="?page=templateview&id=<?= $template['id'] ?>"><?= $template['onderwerp'] ?></a>
                        </td>
                        <td>
                            <?= $template['beschrijving'] ?>
                        </td>
                        <td>
                            <?php echo $t['COUNT(*)']?>
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