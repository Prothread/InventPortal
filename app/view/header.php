<?php
#HEADER

header('Cache-Control: no-cache, no-store, must-revalidate'); //HTTP/1.1
header('Pragma: no-cache'); //HTTP/1.0

$user = new UserController();
$block = new BlockController();
require_once DIR_MODEL . 'permissions.php';

if (isset($_SESSION['usr_id'])) {
    $myuser = $user->getUserById($_SESSION['usr_id']);
    $myuser = $myuser['naam'];
} else if (isset($user)) {
    $thisuser = $user->getUserById($session->getUserId());
    $myuser = $thisuser['naam'];
} else {
    echo 'User';
}

//Connect to database
//Option 1: use this (works online)
//Option 2: use $mysqli = mysqli_connect(); (works offline)
$db = new Database();
$mysqli = $db->getConnection();

$settings = new UserController();
$admin = $settings->getAdminSettings();

if (isset($_SESSION['accorduserid']) && !isset($_SESSION['usr_id'])) {
    $userinfo = $user->getUserById($_SESSION['accorduserid']);
    $imgsrc = 'icons/profile.png';
} else {
    $userinfo = $user->getUserById($_SESSION['usr_id']);

    if ($userinfo['profimg'] !== null) {
        $imgsrc = DIR_IMG . $userinfo['profimg'];
    } else {
        $imgsrc = '../icons/profile.png';
    }

}
?>
<html lang="<?= $language ?>" class="toggled">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
        <meta name="description" content="Madalco Klantenportaal">
        <meta name="author" content="Madalco Media">

        <title>Madalco Portal</title>

        <!-- Bootstrap CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- styling + jquery for select box -->
        <script src="js/jquery-2.1.1.min.js" type="text/javascript"></script>
        <link href="css/select2.min.css" rel="stylesheet"/>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#allclients").select2({
                    placeholder: '<?= INPUT_SELECT_CLIENT ?>'
                });
            });
        </script>

        <!-- Eigen CSS -->
        <link href="css/styles.css" rel="stylesheet">

        <!-- Upload plugin -->
        <link rel="stylesheet" type="text/css" href="css/dropzone.css"/>
        <script type="text/javascript" src="js/dropzone.js" lan="<?= $language ?>"></script>

        <!-- JQuery -->
        <script src="js/jquery-1.12.4.js"></script>
        <script src="js/jquery-ui.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/jquery-ui.css">

        <!-- Datatable css + jquery -->
        <link rel="stylesheet" href="css/jquery.dataTables.min.css">
        <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
        <script src="js/jsapi.js"></script>

        <!--Dropdown search menu-->
        <script src="js/select2.min.js"></script>

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
              href="css/favicon.png">
    </head>

<body>
    <div class="se-pre-con"></div>
    <div id="header" style="background: <?= $admin['Header']; ?>">
        <div id="MenuSide">
            <img src="<?= DIR_PUBLIC . $admin['Logo'] ?>" style="width:auto;height:75%;"/>
        </div>
        <div id="NameSide">
            <a style="text-decoration: none;" href="?page=profile">
                <img src="<?= $imgsrc ?>" id="UserBlockImage">
                <div id="LoggedInAs"><?= $myuser ?></div>
            </a>
        </div>
        <div id="MenuButton">
            <a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><img src="icons/menu-alt-20.png"></a>
        </div>
    </div>

<div id="wrapper" class="toggled">
    <!-- Sidebar -->

    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">

            <li class="nav-button-home">
                <a href="?page=dashboard"><?= TEXT_HOME ?></a>
            </li>

            <li class="nav-button-all">
                <a href="?page=overview"><?= TEXT_OVERVIEW ?></a>
            </li>

            <br/>

            <?php if ($user->getPermission($permgroup, 'CAN_UPLOAD') == 1) { ?>
                <li class="nav-button-upload">
                    <a href="?page=uploadoverview"><?= TEXT_UPLOAD ?></a>
                </li>
            <?php } ?>

            <?php if ($user->getPermission($permgroup, 'CAN_EDIT_SETTINGS') == 1) { ?>
                <li class="nav-button-settings">
                    <a href="?page=settings"><?= TEXT_SETTINGS ?></a>
                </li>
            <?php } ?>

            <br/>

            <?php if ($user->getPermission($permgroup, 'CAN_ACCORD') == 1 && isset($_SESSION['accord'])) { ?>
                <li class="nav-button-accord">
                    <a href="?page=approve"><?= TEXT_ACCORD ?></a>
                </li>
            <?php } ?>

            <?php if ($user->getPermission($permgroup, 'CAN_SHOW_KLANTPAGINA') == 1) { ?>
                <li class="nav-button-users">
                    <a href="?page=manageclients"><?= TEXT_CLIENT ?></a>
                </li>
            <?php } ?>

            <?php if ($user->getPermission($permgroup, 'CAN_SHOW_USERS') == 1) { ?>
                <li class="nav-button-users">
                    <a href="?page=manageusers"><?= TEXT_USER ?></a>
                </li>
            <?php } ?>

            <br/>
            <br/>
            <li class="nav-button-logout">
                <a href="?page=logout"><?= TEXT_LOGOUT ?></a>
            </li>
        </ul>

    </div>
<?php
if ($session->exists('flash')) {
    foreach ($session->get('flash') as $flash) {
        echo "<div class='alert alert_{$flash['type']}'>{$flash['message']}</div>";
    }
    $session->remove('flash');
}