<?php
/**
 * Created by PhpStorm.
 * User: freek
 * Date: 12-5-2017
 * Time: 09:35
 */

$block = new BlockController();

if($user->getPermission($permgroup, 'CAN_VIEW_CRM') != 1){
    $block->Redirect('index.php?page=crmdashboard');
    Session::flash('error', TEXT_NO_PERMISSION);
}

//Dynamic values

$typeCap = ucfirst($type);
$typeController = $typeCap . "Controller";
$typeUpper = strtoupper($type);
$typeLower = strtolower($type);
$typeItems = "all" . $typeCap;
$getTypes = "getAll" . $typeCap . "s";
$getItemsByStatus = $getTypes . "ByStatus";

if ($type != "defaultTask" && $type != "template") {
    ${$typeController} = new $typeController();

    if (isset($_GET["archive"])) {
        if($user->getPermission($permgroup, 'CAN_EDIT_CRM') != 1){
            $overviewStatusIds = [5];
        }else {
            $overviewStatusIds = [5, 6];
        }
    } else {
        $overviewStatusIds = [0, 1, 2, 3];
    }
    ${$typeItems} = [];
    foreach ($overviewStatusIds as $status) {
        $itemsByStatus = ${$typeController}->$getItemsByStatus($status);
        ${$typeItems} = array_merge(${$typeItems}, $itemsByStatus);
    }

} elseif ($type == 'defaultTask') {
    $task = new TaskController();
    ${$typeItems} = $task->getAllTasksByStatus(4);
} else {
    $templateController = new TemplateController();
    ${$typeItems} = $templateController->getAllTemplates();
}

if ($type == "task") {
    $tempTasks = ${$typeItems};
    ${$typeItems} = [];

    foreach ($tempTasks as $task) {
        if ($task['status'] != 4) {
            array_push(${$typeItems}, $task);
        }
    }

    $tenderController = new TenderController();
    $tenders = $tenderController->getAllTenders();
}

if ($type == "assignment" || $type == "task" || $type == "case") {
    $projectController = new ProjectController();
    $projects = $projectController->getAllProjects();
}

if ($type == "task" || $type == "case") {
    $assignmentController = new AssignmentController();
    $assignments = $assignmentController->getAllAssignments();
}

if ($type != "defaultTask" && $type != "template") {
    $userController = new UserController();
    $clients = $userController->getClientList();
    $users = $userController->getUserList();
}

if ($type == "template") {
    $templateLinkController = new TemplateTaskLinksController();
}

switch ($type) {
    case "tender":
        $columns = ["title", "user", "client", "value", "chance", "endDate", "status"];
        break;
    case "project";
        $columns = ["title", "user", "client", "endDate", "status"];
        break;
    case "assignment":
        $columns = ["title", "user", "client", "project", "endDate", "status"];
        break;
    case "task":
        $columns = ["title", "user", "client", "tender", "project", "assignment", "duration", "status"];
        break;
    case "case":
        $columns = ["title", "user", "client", "project", "assignment", "endDate", "status"];
        break;
    case "defaultTask":
        $columns = ["title", "description"];
        break;
    case "template":
        $columns = ["title", "description", "count"];
        break;
}

?>

<div id="overview-holder" class="crm-content-wrapper">
    <h1 class="crm-content-header"><?php if (!isset($_GET['archive'])) {
            echo constant($typeUpper . "_OVERVIEW_TEXT");
        } else {
            echo constant($typeUpper . "_OVERVIEW_ARCHIVE");
        } ?></h1>

    <div class="overview-buttons">
        <button class="custom-file-upload overview-add-button"
                onclick="window.location.href='?page=add<?= $typeLower ?>'"><?= TEXT_CREATE_DROPDOWN ?></button>
        <?php
        if ($type == 'defaultTask' || $type == 'template') {
        } elseif (!isset($_GET['archive'])) {
            ?>
            <button class="custom-file-upload"
                    onclick="window.location.href='?page=<?= $typeLower ?>soverview&archive'"><?= TEXT_ARCHIVE ?></button>
            <?php
        } else {
            ?>
            <button class="custom-file-upload"
                    onclick="window.location.href='?page=<?= $typeLower ?>soverview'"><?= TEXT_OVERVIEW ?></button>
            <?php
        }
        ?>
    </div>

    <div>
        <table id="myTable" class="table table-striped">
            <thead>
            <tr>
                <?php
                foreach ($columns as $column) {
                    echo "<th>" . constant("TABLE_" . strtoupper($column)) . "</th>";
                }
                ?>
            </tr>
            </thead>
            <tbody>
            <?php
            if (sizeof(${$typeItems}) > 0) {
                foreach (${$typeItems} as $i) {
                    $hasUser = false;
                    $hasClient = false;
                    $hasProject = false;
                    $hasAssignment = false;
                    $hasTender = false;

                    ?>
                    <tr>
                        <?php
                        if ($type != "defaultTask") {
                            ?>
                            <td>
                                <a href="?page=<?= $type ?>view&id=<?= $i['id'] ?>"><?= $i['subject'] ?></a>
                            </td>
                            <?php
                        } else {
                            ?>
                            <td>
                                <a href="?page=defaulttaskview&id=<?= $i['id'] ?>"><?= $i['subject'] ?></a>
                            </td>
                            <?php
                        }
                        if (in_array("description", $columns)) {
                            ?>
                            <td>
                                <p><?= $i['description'] ?></p>
                            </td>
                            <?php
                        }
                        if (in_array("user", $columns)) {
                            ?>
                            <td>
                                <a href="?page=showuserprofile&id=<?= $i['user'] ?>"> <?php
                                    if (!is_null($users)) {
                                        foreach ($users as $user) {
                                            if ($user['id'] == $i['user']) {
                                                echo $user['naam'];
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
                            <?php
                        }
                        if (in_array("client", $columns)) {
                            ?>
                            <td>
                                <a href="?page=showuserprofile&id=<?= $i['client'] ?>"> <?php
                                    if (!is_null($clients)) {
                                        foreach ($clients as $client) {
                                            if ($client['id'] == $i['client']) {
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
                            <?php
                        }
                        if (in_array("value", $columns)) {
                            echo "<td>&#8364; " . $i['value'] . "</td>";
                        }
                        if (in_array("chance", $columns)) {
                            echo "<td>" . $i['chance'] . " &#37;</td>";
                        }

                        if (in_array("tender", $columns)) {
                            ?>
                            <td>
                                <a href="?page=tenderview&id=<?= $i['tender'] ?>"><?php
                                    if (!is_null($tenders)) {
                                        foreach ($tenders as $tender) {
                                            if ($tender['id'] == $i['tender']) {
                                                echo $tender['subject'];
                                                $hasTender = true;
                                            }
                                        }
                                    }
                                    ?></a>
                                <?php
                                if (!$hasTender) {
                                    echo "-";
                                }
                                ?>
                            </td>
                            <?php
                        }

                        if (in_array("project", $columns)) {
                            ?>
                            <td>
                                <a href="?page=projectview&id=<?= $i['project'] ?>"><?php
                                    if (!is_null($projects)) {
                                        foreach ($projects as $project) {
                                            if ($project['id'] == $i['project']) {
                                                echo $project['subject'];
                                                $hasProject = true;
                                            }
                                        }
                                    }
                                    ?></a>
                                <?php
                                if (!$hasProject) {
                                    echo "-";
                                }
                                ?>
                            </td>
                            <?php
                        }

                        if (in_array("assignment", $columns)) {
                            ?>
                            <td>
                                <a href="?page=assignmentview&id=<?= $i['assignment'] ?>"><?php
                                    if (!is_null($assignments)) {
                                        foreach ($assignments as $assignment) {
                                            if ($assignment['id'] == $i['project']) {
                                                echo $assignment['subject'];
                                                $hasAssignment = true;
                                            }
                                        }
                                    }
                                    ?></a>
                                <?php
                                if (!$hasAssignment) {
                                    echo "-";
                                }
                                ?>
                            </td>
                            <?php
                        }
                        if (in_array("duration", $columns)) {
                            echo "<td>" . $i["duration"] . "</td>";
                        }

                        if (in_array("endDate", $columns)) {
                            echo "<td>" . date("d-m-Y", strtotime($i['endDate'])) . "</td>";
                        }
                        if (in_array("status", $columns)) {
                            switch ($i['status']) {
                                case 0:
                                    $alt = "OPEN";
                                    break;
                                case 1:
                                    $alt = "ONGOING";
                                    break;
                                case 2:
                                    $alt = "SECOND_PARTY";
                                    break;
                                case 3:
                                    $alt = "THIRD_PARTY";
                                    break;
                                case 5:
                                    $alt = "FINISHED";
                                    break;
                                case 6:
                                    $alt = "DELETED";
                                    break;
                            };
                            echo '<td><p style="display: none;">' . $i['status'] . '</p><img src = "css/status-' . $i['status'] . '.png" title="' . constant("TEXT_STATUS_" . $alt) . '" ></td>';
                        }
                        if (in_array("count", $columns)) {
                            $t = $templateLinkController->getTaskAmountByTemplateId($i['id']);
                            echo "<td>" . $t["COUNT(*)"] . "</td>";
                        }
                        ?>
                    </tr>
                    <?php
                }
            }
            ?>
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
