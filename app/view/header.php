<?php
#HEADER

$user = new UserController();

include DIR_MODEL . 'permissions.php';

if(isset($_SESSION['usr_name'])) {
    $myuser = $_SESSION['usr_name'];
}
else if( isset($user) ) {
    $thisuser = $user->getUserById($session->getUserId());
    $myuser = $thisuser['naam'];
}
else {
    echo 'User';
}

$settings = new UserController();
$admin = $settings->getAdminSettings();
?>

<html lang="nl">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="Madalco Klantenportaal">
    <meta name="author" content="Madalco Media">

    <title>Madalco Portal</title>

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Eigen CSS -->
    <link href="css/styles.css" rel="stylesheet">

    <!-- JQuery -->
    <script src="js/jquery-1.12.4.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="css/jquery-ui.css">

    <script src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">
        google.load("jquery", "1.3.2");
    </script>
    <!--Sort table-->
    <script src="js/sorttable.js" type="text/javascript"></script>

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Eigen CSS -->
    <link href="css/styles.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->



    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="icon"
          type="image/png"
          href="<?= DIR_PUBLIC . 'images/favicon.png'?>">
</head>

<body>
<div class="se-pre-con"></div>
    <div id="header" style="background: <?= $admin['Header'];?>">
        <div id="MenuSide">
            <img src="<?= DIR_PUBLIC . $admin['Logo'] ?>" style="width:auto;height:75%;" /> <!-- ../public/css/madlogo.png -->
        </div>
        <div id="MenuButton">
            <a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><img src="https://cdn4.iconfinder.com/data/icons/wirecons-free-vector-icons/32/menu-alt-20.png"></a>
        </div>
    </div>

<div id="NameSide">
    <div id="UserPhoto">
    </div>
    <a style="text-decoration: none;" href="index.php?page=gebruikersoverzicht">
        <div style="text-decoration: none;" id="UserBlock">
            <h3 id="LoggedInAs"><?= $myuser; ?></h3>
        </div>
    </a>
</div>


<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">

            <li class="nav-button-home">
                <a href="index.php?page=dashboard">Home</a>
            </li>

            <li class="nav-button-status">
                <a href="?page=statusportal">Statusportaal</a>
            </li>

            <?php if($user->getPermission($permgroup, 'CAN_EDIT_SETTINGS') == 1){ ?>
                <li class="nav-button-settings">
                    <a href="index.php?page=settings">Instellingen</a>
                </li>
            <?php } ?>

             <li class="nav-button-all">
                 <a href="index.php?page=overzicht">Overzicht</a>
             </li>

            <?php if ($user->getPermission($permgroup, 'CAN_UPLOAD') == 1 || $user->getPermission($permgroup, 'CAN_ACCORD') == 1) { ?>
                <br><p id="MenuSeperator"><span style="color: #FFF;" class="glyphicon glyphicon-ok"></span> ACCORDERINGEN</p>
            <?php } ?>

            <?php if ($user->getPermission($permgroup, 'CAN_UPLOAD') == 1) { ?>
                <li class="nav-button-upload">
                    <a href="index.php?page=uploadoverzicht">Upload</a>
                </li>
            <?php } ?>

            <?php if ($user->getPermission($permgroup, 'CAN_ACCORD') == 1) { ?>
                <li class="nav-button-accord">
                    <a href="index.php?page=accordering">Accordering</a>
                </li>
            <?php } ?>

            <?php if($user->getPermission($permgroup, 'CAN_SHOW_KLANTPAGINA') == 1 || $user->getPermission($permgroup, 'CAN_SHOW_USERS') == 1) {?>
                <p id="MenuSeperator"><span style="color: #FFF;" class="glyphicon glyphicon-user"></span> PERSONEN</p>
            <?php } ?>

            <?php if ($user->getPermission($permgroup, 'CAN_SHOW_KLANTPAGINA') == 1) { ?>

                <li class="nav-button-users">
                    <a href="index.php?page=manageclients">Klanten</a>
                </li>
            <?php } ?>

            <?php if ($user->getPermission($permgroup, 'CAN_SHOW_USERS') == 1) { ?>
                <li class="nav-button-users">
                    <a href="index.php?page=manageusers">Gebruikers</a>
                </li>
            <?php }?>

            <br>
            <br>
            <li class="nav-button-logout">
                <a href="?page=logout">Uitloggen</a>
            </li>
        </ul>
    </div>
<?php

if($session->exists('flash')) {
    foreach($session->get('flash') as $flash) {
        echo "<div class='alert alert_{$flash['type']}'>{$flash['message']}</div>";
    }
    $session->remove('flash');
} ?>