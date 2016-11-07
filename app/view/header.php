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
    <div id="header">
        <div id="MenuSide">
            <img src="../public/css/madlogo.png" style="width:auto;height:auto;" />
        </div>
        <div id="MenuButton">
            <a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><img src="https://cdn4.iconfinder.com/data/icons/wirecons-free-vector-icons/32/menu-alt-20.png"></a>
        </div>
    </div>

<div id="NameSide">
    <div id="UserPhoto">
    </div>
    <h3 id="LoggedInAs"><?= $myuser; ?></h3>
</div>


<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">

            <h5 style="margin-left:15px;"><i style="color: #FFF;" class="glyphicon glyphicon-home"></i>
                <small><b><span style="color: #FFF;">MANAGEMENT</span></b></small>
            </h5>
            <li class="nav-button-home">
                <a href="index.php?page=dashboard">Home</a>
            </li>

            <?php if($user->getPermission($permgroup, 'CAN_SHOW_USEROVERZICHT')){ ?>
                <li class="nav-button-all">
                    <a href="index.php?page=gebruikersoverzicht">Uw overzicht</a>
                </li>
            <?php } ?>

            <?php if($user->getPermission($permgroup, 'CAN_EDIT_SETTINGS') == 1){ ?>
                <li class="nav-button-settings">
                    <a href="index.php?page=settings">Instellingen</a>
                </li>
            <?php } ?>

            <h5 style="margin-left:15px;"><i style="color: #FFF;" class="glyphicon glyphicon-ok"></i>
                <small><b><span style="color: #FFF;">ACCORDERINGEN</span></b></small>
            </h5>
            <?php if($user->getPermission($permgroup, 'CAN_UPLOAD') == 1){ ?>
                <li class="nav-button-upload">
                    <a href="index.php?page=uploadoverzicht">Upload</a>
                </li>
            <?php } ?>

            <?php if($user->getPermission($permgroup, 'CAN_SHOW_OVERZICHT')){ ?>
            <li class="nav-button-all">
                <a href="index.php?page=overzicht">Overzicht</a>
            </li>
            <?php } ?>

            <?php if($_SESSION['accord'] = '1' && $user->getPermission($permgroup, 'CAN_ACCORD')) { ?>
            <li class="nav-button-all">
                <a href="index.php?page=accordering">Accordering</a>
            </li>
            <?php } ?>

            <h5 style="margin-left:15px;"><i style="color: #FFF;" class="glyphicon glyphicon-user"></i>
                <small><b><span style="color: #FFF;">PERSONEN</span></b></small>
            </h5>
            <?php if($user->getPermission($permgroup, 'CAN_SHOW_KLANTPAGINA') == 1){ ?>

                <li class="nav-button-users">
                    <a href="index.php?page=manageclients">Klanten</a>
                </li>
            <?php } ?>

            <?php if($user->getPermission($permgroup, 'CAN_SHOW_USERS') == 1){ ?>
                <li class="nav-button-users">
                    <a href="index.php?page=manageusers">Gebruikers</a>
                </li>
            <?php } ?>

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
    $session->remove('flash');} ?>