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

/*define("SHOW_HOME",         1);
define("SHOW_UPLOAD",       1);
define("SHOW_BOARD",        1);
define("SHOW_SETTINGS",     1);
define("SHOW_CLIENT",       1);*/

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
    $permgroup = $id['permgroup'];
}
else if($_SESSION['client_id']){
    $id = $client->getPermissionGroup($clientid);
    $permgroup = $id['permgroup'];
}
else {
    $permgroup = 0;
}
//var_dump($permgroup);

//$perms = [SHOW_HOME, SHOW_UPLOAD, SHOW_BOARD];
