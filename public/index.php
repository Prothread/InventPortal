<?php
/**
 * Created by PhpStorm.
 * User: Kevin Ernst
 * Date: 28-Sep-16
 * Time: 12:20
 */

require_once '../config/load.php';

/**
 * Variabele om een sessie class aan te maken
 *
 * @var Session
 */

$session = new Session();

/**
 * Creeren van ?page=
 */

isset($_GET['page']) ? $page = $_GET['page'] : $page = 'dashboard';

/**
 * If: Haal page van url op
 * Anders: pagina is dashboard
 */

if(isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'dashboard';
}

/**
 * TODO EXTRA: Redirect
 * Kan gebruikt worden voor eventuele redirect als er nog niet in gelogd is
 */
//$_SESSION['returnurl'] = ($_SERVER['REQUEST_URI']);

/**
 * If: Als er niemand ingelogd is of de pagina is niet registreren/wachtwoord vergeten of wachtwoord herstellen
 * Dan: De pagina si login
 *
 * Anders: de gebruiker is ingelogd en gaat naar het dashboard
 */

if(!$session->exists('usr_id') && $page !== 'wachtwoordvergeten' && $page !== 'wachtwoordherstellen' && $page !== 'image' && $page !== 'register' && $page !== 'accordering' && $page !== 'verify' && $page !== 'imagedecline' && $page !== 'imageverify' && $page !== 'updatemail' && $page !== 'imagecancel') {
    $page = 'login';
} else if($session->exists('usr_id') && $page=='login') {
    $page = 'dashboard';
}

if(!$session->exists('usr_id') && $page == 'accordering') {
    require_once '../app/view/header.php';
}

if($session->exists('usr_id')){
    if($page !== 'submit') {
        include_once '../app/view/header.php';

    }
}

/**
 * Switch case voor de optie van ?page= in je url
 */

switch($page) {
    case 'dashboard':
        include '../app/view/dashboard.php';
        break;
    case 'overzicht':
        include '../app/view/overzicht.php';
        break;
    case 'uploading':
        include '../app/Model/upload.php';
        break;
    case 'uploadoverzicht':
        include '../app/view/phpmail.php';
        break;
    case 'verify':
        include '../app/Model/verifymail.php';
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
    case 'newuser':
        include '../app/view/newuser.php';
        break;
    case 'imageverify':
        include '../app/view/imageverify.php';
        break;
    case 'imagedecline':
        include '../app/view/imagedecline.php';
        break;
    case 'imagecancel':
        include '../app/view/imagecancel.php';
        break;
    case 'gebruikersoverzicht':
        include '../app/view/profile.php';
        break;
    case 'manageclients':
        include '../app/view/manageclients.php';
        break;
    case 'manageusers':
        include '../app/view/manageusers.php';
        break;
    case 'conditions':
        include '../app/view/conditions.php';
        break;
    case 'test':
        include '../app/view/test.php';
        break;
    case 'logout':
        include '../app/view/logout.php';
        break;
    case 'register':
        include '../app/view/register.php';
        break;
    case 'newpassword':
        include '../app/view/newpassword.php';
        break;
    case 'updatemail':
        include '../app/view/updatemail.php';
        break;
    case 'login':
        include '../app/view/login.php';
        break;
    case 'editclient':
        include '../app/view/editclient.php';
        break;
    case 'image':
        include '../app/view/image.php';
        break;
    case 'clientmail':
        include '../app/view/clientmail.php';
        break;
    case 'download':
        include '../app/view/download.php';
        break;
    case 'settingsupload':
        include '../app/Model/settingupload.php';
        break;
    case 'statusportal':
        include '../app/view/statusportal.php';
        break;
    case 'filter':
        include '../app/Model/Filtering.php';
        break;
    case 'profiel':
        include '../app/view/profiel.php';
        break;
    default:
        include '../app/view/404.php';
        break;
}

require_once '../app/view/footer.php';