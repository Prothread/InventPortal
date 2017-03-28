<?php
$tenderCon = new TenderController();
$allTenders = $tenderCon->getAllTenders();

$thisUserId = $_SESSION['usr_id'];

$dashTenders = array();

foreach ($allTenders as $tender) {
    if($tender['user'] == $thisUserId){
        array_push($dashTenders, $tender);
    }
}

$userController = new UserController();
$clients = $userController->getClientList();
$theclient;

foreach ($dashTenders as $tender) {
    $time = $tenderCon->getTimeDifference($tender['enddate'], date("Y-m-d"));
}
?>

<div id="crm-dashboard-holder">

    <div class="crm-dashboard-row">
        <header><?= YOUR_TENDER ?></header>

        <select class="crm-dashboard-select">
            <option value="" disabled selected>Filter optie</option>
            <option><?= TABLE_TITLE ?>
            <option>
            <option><?= TEXT_DATE ?></option>
            <option><?= TEXT_IS_CLIENT ?></option>
            <option><?= TEXT_URGENCY ?></option>
        </select>

        <div class="crm-dashboard-inside-row">

            <button class="custom-file-upload">Aanmaken</button>
            <?php foreach ($dashTenders as $tender) { ?>
                <div class="crm-dashboard-box">
                    <?php if($tenderCon->getTimeDifference($tender['enddate'], date("Y-m-d")) <= 0 ){ ?>
                        <img class="deadline" src="css/deadline4.png">
                    <?php } else if($tenderCon->getTimeDifference($tender['enddate'], date("Y-m-d")) > 0 && $tenderCon->getTimeDifference($tender['enddate'], date("Y-m-d")) <= 2) {?>
                        <img class="deadline" src="css/deadline3.png">
                    <?php } else if($tenderCon->getTimeDifference($tender['enddate'], date("Y-m-d")) > 2 && $tenderCon->getTimeDifference($tender['enddate'], date("Y-m-d")) <= 7) { ?>
                        <img class="deadline" src="css/deadline2.png">
                    <?php } else { ?>
                        <img class="deadline" src="css/deadline1.png">
                    <?php } ?>
                    <ul>
                        <li>
                            <a href="?page=tenderview&id= <?= $tender['id'] ?>"><?= $tender['subject'] ?></a>
                        </li>
                        <li>
                            <?php foreach ($clients as $client) {
                                if ($client['id'] == $tender['client']) {
                                    echo $client['naam'];
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

            <div class="crm-dashboard-box">
                <img class="deadline" src="css/deadline1.png">
                <ul>
                    <li>
                        Project onderwerp
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