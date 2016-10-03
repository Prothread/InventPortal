<?php
/**
 * Created by PhpStorm.
 * User: Gijsv2
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

//$page = $_GET['page'];

switch($page) {
    case 'upload':
        include '../app/view/uploadoverzicht.php';
        break;
    case 'dashboard':
        include '../app/view/dashboard.php';
        break;
    case 'uploading':
        include '../app/Model/upload.php';
        break;
    case 'phpmail':
        include '../app/view/phpmail.php';
        break;
    default:
        break;
}

?>

<?php require_once '../app/view/footer.php'; ?>