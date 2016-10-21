<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 20-Oct-16
 * Time: 15:02
 */

$user = new UserController();
$client = new ClientController();
$session = new Session();

/**
 * Checken of de klant een user of een client is
 */

if(isset($_SESSION['usr_id'])) {
    $userid = $_SESSION['usr_id'];
}
else if($_SESSION['client_id']) {
    $userid = $_SESSION['client_id'];
}
else {
    $userid = $session->getUserId();
}

/**
 * Haal de rechten van de user/client op
 */

if($_SESSION['usr_id']){
    $id = $user->getPermissionGroup($userid);
    $permid = $id['permgroup'];
    if($permid == 2) {
        $permgroup = 'Gebruiker';
    }
    else if($permid == 3) {
        $permgroup = 'Beheerder';
    }
    else if($permid == 4) {
        $permgroup = 'Admin';
    }
}
else if($_SESSION['client_id']){
    $id = $client->getPermissionGroup($clientid);
    $permid = $id['permgroup'];
    $permgroup = 'Klant';
}
else {
    $permgroup = '';
}

$t = $user->getPermission($permgroup, 'CAN_SHOW_HOME');
