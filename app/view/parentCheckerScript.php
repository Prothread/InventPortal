<?php
/**
 * Created by PhpStorm.
 * User: freek
 * Date: 1-5-2017
 * Time: 11:12
 */
?>
<script>
    $("#projectSelect").change(function () {
        var assignment = document.getElementById("assignmentSelect");
        var tender = document.getElementById("tenderSelect");
        var cases = document.getElementById("caseSelect");
        assignment.selectedIndex = 0;
        tender.selectedIndex = 0;
        cases.selectedIndex = 0;
    });
    $("#assignmentSelect").change(function () {
        var project = document.getElementById("projectSelect");
        var tender = document.getElementById("tenderSelect");
        var cases = document.getElementById("caseSelect");
        project.selectedIndex = 0;
        tender.selectedIndex = 0;
        cases.selectedIndex = 0;
    });
    <?php if($type == 'task'){ ?>
    $("#tenderSelect").change(function () {
        var project = document.getElementById("projectSelect");
        var assignment = document.getElementById("assignmentSelect");
        var cases = document.getElementById("caseSelect");
        project.selectedIndex = 0;
        assignment.selectedIndex = 0;
        cases.selectedIndex = 0;
    });
    $("#caseSelect").change(function () {
        var project = document.getElementById("projectSelect");
        var assignment = document.getElementById("assignmentSelect");
        var tender = document.getElementById("tenderSelect");
        project.selectedIndex = 0;
        assignment.selectedIndex = 0;
        tender.selectedIndex = 0;
    });
    <?php } ?>
</script>
