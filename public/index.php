<?php
/**
 * Created by PhpStorm.
 * User: Kevin Ernst
 * Date: 28-Sep-16
 * Time: 12:20
 */

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
        require_once '../app/view/header.php';
        include '../app/view/uploadoverzicht.php';
        break;
    case 'dashboard':
        require_once '../app/view/header.php';
        include '../app/view/dashboard.php';
        break;
    case 'overzicht':
        require_once '../app/view/header.php';
        include '../app/view/overzicht.php';
        break;
    case 'uploading':
        require_once '../app/view/header.php';
        include '../app/Model/upload.php';
        break;
    case 'phpmail':
        require_once '../app/view/header.php';
        include '../app/view/phpmail.php';
        break;
    case 'verify':
        require_once '../app/view/header.php';
        include '../app/Model/verifymail.php';
        break;
    case 'dbverify':
        require_once '../app/view/header.php';
        include '../app/Model/DbVerify.php';
        break;
    case 'accordering':
        require_once '../app/view/header.php';
        include '../app/view/accordering.php';
        break;
    case 'item':
        require_once '../app/view/header.php';
        include '../app/view/item.php';
        break;
    case 'settings':
        require_once '../app/view/header.php';
        include '../app/view/settings.php';
        break;
    case 'newclient':
        require_once '../app/view/header.php';
        include '../app/view/newclient.php';
        break;
    case 'imageverify':
        include '../app/view/imageverify.php';
        break;
    case 'imagedecline':
        include '../app/view/imagedecline.php';
        break;
    case 'manageclients':
        require_once '../app/view/header.php';
        include '../app/view/manageclients.php';
        break;
    case 'conditions':
        require_once '../app/view/header.php';
        include '../app/view/conditions.php';
        break;
    case 'test':
        require_once '../app/view/header.php';
        include '../app/view/test.php';
        break;
    case 'logout':
        include '../app/view/login/logout.php';
        break;
    case 'register':
        include '../app/view/login/register.php';
        break;
    default:
        include '../app/view/login/login.php';
        break;
}

require_once '../app/view/footer.php';