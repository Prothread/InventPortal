<?php
$tender = new TenderController();
$allTenders = $tender->getAllTenders();

$queTenders = array();

foreach ($allTenders as $tender) {
    if(!$tender['user']){
        array_push($queTenders, $tender);
    }
}

$userController = new UserController();
$clients = $userController->getClientList();
$theclient;

?>

<div id="crm-dashboard-holder">

    <div class="crm-dashboard-row">
        <header>Open offertes</header>

        <select class="crm-dashboard-select">
            <option value="" disabled selected>Filter optie</option>
            <option>Onderwerp</option>
            <option>Datum</option>
            <option>Klant</option>
            <option>Urgentie</option>
        </select>

        <div class="crm-dashboard-inside-row">

            <button class="custom-file-upload">Aanmaken</button>

            <?php foreach ($queTenders as $tender) { ?>
            <div class="crm-dashboard-box">
                <img class="deadline" src="css/deadline4.png">
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
                <a class="toewijzenlink" href="">Toewijzen</a>
            </div>
            <?php } ?>
        </div>
    </div>

    <div class="crm-dashboard-row">
        <header>Open projecten</header>

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
                <a class="toewijzenlink" href="">Toewijzen</a>
            </div>
        </div>
    </div>

    <div class="crm-dashboard-row">
        <header>Open opdrachten</header>

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
                <a class="toewijzenlink" href="">Toewijzen</a>
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
                <a class="toewijzenlink" href="">Toewijzen</a>
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
                <a class="toewijzenlink" href="">Toewijzen</a>
            </div>
        </div>
    </div>

    <div class="crm-dashboard-row">
        <header>Open taken</header>

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
                <a class="toewijzenlink" href="">Toewijzen</a>
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
                <a class="toewijzenlink" href="">Toewijzen</a>
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
                <a class="toewijzenlink" href="">Toewijzen</a>
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
                <a class="toewijzenlink" href="">Toewijzen</a>
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
                <a class="toewijzenlink" href="">Toewijzen</a>
            </div>
        </div>
    </div>

    <div class="crm-dashboard-row">
        <header>Open cases</header>

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
                <a class="toewijzenlink" href="">Toewijzen</a>
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
                <a class="toewijzenlink" href="">Toewijzen</a>
            </div>
        </div>
    </div>
</div>