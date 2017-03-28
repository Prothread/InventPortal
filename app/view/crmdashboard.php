<?php
$thisUserId = $_SESSION['usr_id'];

$tenderCon = new TenderController();
$allTenders = $tenderCon->getTendersByUserId($thisUserId);

$projectController = new ProjectController();
$allProjects = $projectController->getProjectsByUserId($thisUserId);

$userController = new UserController();
$clients = $userController->getClientList();

?>

<div id="crm-dashboard-holder">

    <div class="crm-dashboard-row">
        <header><?= YOUR_TENDER ?></header>

        <select class="crm-dashboard-select">
            <option value="" disabled selected>Filter optie</option>
            <option><?= TABLE_TITLE ?></option>
            <option><?= TEXT_DATE ?></option>
            <option><?= TEXT_IS_CLIENT ?></option>
            <option><?= TEXT_URGENCY ?></option>
        </select>

        <div class="crm-dashboard-inside-row">
            <button class="custom-file-upload">Aanmaken</button>
            <?php foreach ($allTenders as $tender) {
                $timeDiff = $tenderCon->getTimeDifference($tender['enddate'], date("Y-m-d"))
                ?>
                <div class="crm-dashboard-box">
                    <?php if ($timeDiff <= 0) { ?>
                        <img class="deadline" src="css/deadline4.png">
                    <?php } else if ($timeDiff > 0 && $timeDiff <= 2) { ?>
                        <img class="deadline" src="css/deadline3.png">
                    <?php } else if ($timeDiff > 2 && $timeDiff <= 7) { ?>
                        <img class="deadline" src="css/deadline2.png">
                    <?php } else { ?>
                        <img class="deadline" src="css/deadline1.png">
                    <?php } ?>
                    <ul>
                        <li>
                            <a href="?page=tenderview&id=<?= $tender['id'] ?>"><?= $tender['subject'] ?></a>
                        </li>
                        <li>
                            <?php foreach ($clients as $client) {
                                if ($client['id'] == $tender['client']) {
                                    ?>
                                    <a href="?page=showuserprofile&id=<?= $client['id'] ?>"><?= $client['naam'] ?></a>
                                    <?php
                                }
                            } ?>
                        </li>
                        <li>
                            <?= date("d-m-Y", strtotime($tender['enddate'])) ?>
                        </li>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="crm-dashboard-row">
        <header>Jouw projecten</header>

        <select class="crm-dashboard-select">
            <option value="" disabled selected>Filter optie</option>
            <option>Onderwerp</option>
            <option>Datum</option>
            <option>Klant</option>
            <option>Urgentie</option>
        </select>

        <div class="crm-dashboard-inside-row">
            <button class="custom-file-upload">Aanmaken</button>
            <?php foreach ($allProjects as $project) {
                $timeDiff = $projectController->getTimeDifference($project['endDate'], date("Y-m-d"));
                ?>
                <div class="crm-dashboard-box">
                    <?php if ($timeDiff <= 0) { ?>
                        <img class="deadline" src="css/deadline4.png">
                    <?php } else if ($timeDiff > 0 && $timeDiff <= 2) { ?>
                        <img class="deadline" src="css/deadline3.png">
                    <?php } else if ($timeDiff > 2 && $timeDiff <= 7) { ?>
                        <img class="deadline" src="css/deadline2.png">
                    <?php } else { ?>
                        <img class="deadline" src="css/deadline1.png">
                    <?php } ?>
                    <ul>
                        <li>
                            <a href="?page=projectview&id=<?= $project['id'] ?>"><?= $project['subject'] ?></a>
                        </li>
                        <li>
                            <?php foreach ($clients as $client) {
                                if ($client['id'] == $project['client']) {
                                    ?>
                                    <a href="?page=showuserprofile&id=<?= $client['id'] ?>"><?= $client['naam'] ?></a>
                                    <?php
                                }
                            } ?>
                        </li>
                        <li>
                            <?= date("d-m-Y", strtotime($project['endDate'])) ?>
                        </li>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="crm-dashboard-row">
        <header>Jouw opdrachten</header>

        <select class="crm-dashboard-select">
            <option value="" disabled selected>Filter optie</option>
            <option>Onderwerp</option>
            <option>Datum</option>
            <option>Klant</option>
            <option>Urgentie</option>
        </select>

        <div class="crm-dashboard-inside-row">

            <button class="custom-file-upload">Aanmaken</button>

            <div class="crm-dashboard-box">
                <img class="deadline" src="css/deadline3.png">
                <ul>
                    <li>
                        Opdracht onderwerp
                    </li>
                    <li>
                        Klant naam
                    </li>
                    <li>
                        04-03-2017
                    </li>
                </ul>
            </div>

            <div class="crm-dashboard-box">
                <img class="deadline" src="css/deadline3.png">
                <ul>
                    <li>
                        Opdracht onderwerp
                    </li>
                    <li>
                        Klant naam
                    </li>
                    <li>
                        04-03-2017
                    </li>
                </ul>
            </div>

            <div class="crm-dashboard-box">
                <img class="deadline" src="css/deadline1.png">
                <ul>
                    <li>
                        Opdracht onderwerp
                    </li>
                    <li>
                        Klant naam
                    </li>
                    <li>
                        04-03-2017
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="crm-dashboard-row">
        <header>Jouw taken</header>

        <select class="crm-dashboard-select">
            <option value="" disabled selected>Filter optie</option>
            <option>Onderwerp</option>
            <option>Datum</option>
            <option>Klant</option>
            <option>Urgentie</option>
        </select>

        <div class="crm-dashboard-inside-row">

            <button class="custom-file-upload">Aanmaken</button>

            <div class="crm-dashboard-box">
                <img class="deadline" src="css/deadline4.png">
                <img class="urgentie" src="css/urgentie4.png">
                <ul>
                    <li>
                        Taak onderwerp
                    </li>
                    <li>
                        Klant naam
                    </li>
                    <li>
                        04-03-2017
                    </li>
                </ul>
            </div>

            <div class="crm-dashboard-box">
                <img class="deadline" src="css/deadline3.png">
                <img class="urgentie" src="css/urgentie4.png">
                <ul>
                    <li>
                        Taak onderwerp
                    </li>
                    <li>
                        Klant naam
                    </li>
                    <li>
                        04-03-2017
                    </li>
                </ul>
            </div>

            <div class="crm-dashboard-box">
                <img class="deadline" src="css/deadline1.png">
                <ul>
                    <li>
                        Taak onderwerp
                    </li>
                    <li>
                        Klant naam
                    </li>
                    <li>
                        04-03-2017
                    </li>
                </ul>
            </div>

            <div class="crm-dashboard-box">
                <img class="deadline" src="css/deadline2.png">
                <ul>
                    <li>
                        Taak onderwerp
                    </li>
                    <li>
                        Klant naam
                    </li>
                    <li>
                        04-03-2017
                    </li>
                </ul>
            </div>

            <div class="crm-dashboard-box">
                <img class="deadline" src="css/deadline1.png">
                <ul>
                    <li>
                        Taak onderwerp
                    </li>
                    <li>
                        Klant naam
                    </li>
                    <li>
                        04-03-2017
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="crm-dashboard-row">
        <header>Jouw cases</header>

        <select class="crm-dashboard-select">
            <option value="" disabled selected>Filter optie</option>
            <option>Onderwerp</option>
            <option>Datum</option>
            <option>Klant</option>
            <option>Urgentie</option>
        </select>

        <div class="crm-dashboard-inside-row">

            <button class="custom-file-upload">Aanmaken</button>

            <div class="crm-dashboard-box">
                <img class="deadline" src="css/deadline3.png">
                <ul>
                    <li>
                        Case onderwerp
                    </li>
                    <li>
                        Klant naam
                    </li>
                    <li>
                        04-03-2017
                    </li>
                </ul>
            </div>

            <div class="crm-dashboard-box">
                <img class="deadline" src="css/deadline1.png">
                <ul>
                    <li>
                        Case onderwerp
                    </li>
                    <li>
                        Klant naam
                    </li>
                    <li>
                        04-03-2017
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>