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

if (isset($_SESSION['usr_id'])) {
    $id = $user->getPermissionGroup($_SESSION['usr_id']);
    $perm = $user->getPermissionGroupName($id['permgroup']);

    $mypermgroup = $perm['name'];
    $permgroup = $id['permgroup'];
}

else if (isset($_SESSION['userid'])) {
    if ($session->getUserId()) {
        $id = $user->getPermissionGroup($session->getUserId());
        $perm = $user->getPermissionGroupName($id['permgroup']);

        $mypermgroup = $perm['name'];
        $permgroup = $id['permgroup'];
    }
}

else {
    $permgroup = 0;
}