<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 20-Oct-16
 * Time: 15:02
 */

$user = new UserController();
$session = new Session();

/**
 * Haal de rechten van de user/client op
 */

if(isset($_SESSION['usr_id'])){
    $id = $user->getPermissionGroup($_SESSION['usr_id']);
    $id = $id['permgroup'];

    if($id == 1) {
        $permgroup = 'Klant';
    }
    else if($id == 2) {
        $permgroup = 'Gebruiker';
    }
    else if($id == 3) {
        $permgroup = 'Beheerder';
    }
    else if($id == 4) {
        $permgroup = 'Admin';
    }
    else {
        $permgroup = '';
    }
}
else if($session->getUserId()) {
    $id = $user->getPermissionGroup($session->getUserId());

    if($id == 1) {
        $permgroup = 'Klant';
    }
    else if($id == 2) {
        $permgroup = 'Gebruiker';
    }
    else if($id == 3) {
        $permgroup = 'Beheerder';
    }
    else if($id == 4) {
        $permgroup = 'Admin';
    }
    else {
        $permgroup = '';
    }
}
else {
    $permgroup = '';
}


$t = $user->getPermission($permgroup, 'CAN_SHOW_HOME');
