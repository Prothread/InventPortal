<?php
/**
 * Created by PhpStorm.
 * User: Kevin Ernst
 * Date: 28-Sep-16
 * Time: 12:20
 */
require_once '../app/view/header.php';
require_once '../config/load.php';

isset($_GET['page']) ? $page = $_GET['page'] : $page = 'dashboard';

if(isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'dashboard';
}

/*if(!$session->exists('username') && $page !== 'wachtwoordvergeten' && $page !== 'wachtwoordherstellen') {
    $page = 'login';
} elseif($session->exists('username') && $page=='login') {
    $page = 'dashboard';
}*/

switch($page) {
    case 'upload':
        include '../app/view/uploadoverzicht.php';
        break;
    case 'dashboard':
        include '../app/view/dashboard.php';
        break;
    case 'overzicht':
        include '../app/view/overzicht.php';
        break;
    case 'uploading':
        include '../app/Model/upload.php';
        break;
    case 'phpmail':
        include '../app/view/phpmail.php';
        break;
    case 'verify':
        include '../app/Model/verifymail.php';
        break;
    case 'dbverify':
        include '../app/Model/DbVerify.php';
        break;
    case 'accordering':
        include '../app/view/accordering.php';
        break;
    case 'item':
        include '../app/view/item.php';
        break;
    case 'settings':
        include '../app/view/settings.php';
        break;
    case 'newclient':
        include '../app/view/newclient.php';
        break;
    case 'imageverify':
        include '../app/view/imageverify.php';
        break;
    case 'imagedecline':
        include '../app/view/imagedecline.php';
        break;
    case 'manageclients':
        include '../app/view/manageclients.php';
        break;
    case 'conditions':
        include '../app/view/conditions.php';
        break;
    case 'test':
        include '../app/view/test.php';
        break;
    default:
        break;
}

require_once '../app/view/footer.php';