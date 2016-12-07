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
 * If: Als er niemand ingelogd is of de pagina is niet registreren/wachtwoord vergeten of wachtwoord herstellen
 * Dan: De pagina si login
 *
 * Anders: de gebruiker is ingelogd en gaat naar het dashboard
 */

if(!$session->exists('usr_id') && $page !== 'forgetpassword' && $page !== 'resetpassword' && $page !== 'passreset' && $page !== 'wachtwoordherstellen' && $page !== 'image' && $page !== 'register' && $page !== 'approve' && $page !== 'verify' && $page !== 'imageverify' && $page !== 'updatemail' && $page !== 'imagecancel') {
    $page = 'login';
} else if($session->exists('usr_id') && $page=='login') {
    $page = 'dashboard';
}

if(!$session->exists('usr_id') && $page == 'approve') {
    require_once '../app/view/header.php';
}

if(!$session->exists('usr_id') && $page !== 'approve') {
    require_once '../app/view/header2.php';
}

if($session->exists('usr_id')){
    if($page !== 'submit' && $page !== 'item2' && $page !== 'image') {
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
    case 'overview':
        include '../app/view/overview.php';
        break;
    case 'uploading':
        include '../app/Model/upload.php';
        break;
    case 'uploadoverview':
        include '../app/view/phpmail.php';
        break;
    case 'verify':
        include '../app/Model/verifymail.php';
        break;
    case 'approve':
        include '../app/view/approve.php';
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
    case 'statusitem':
        include '../app/view/statusitem.php';
        break;
    case 'newuser':
        include '../app/view/newuser.php';
        break;
    case 'imageverify':
        include '../app/view/imageverify.php';
        break;
    case 'imagecancel':
        include '../app/view/imagecancel.php';
        break;
    case 'useroverview':
        include '../app/view/userprofile.php';
        break;
    case 'userdashboard':
        include '../app/view/userdashboard.php';
        break;
    case 'setimagedownload':
        include '../app/view/setimagedownload.php';
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
    case 'forgetpassword':
        include '../app/view/forgetpassword.php';
        break;
    case 'newpassword':
        include '../app/view/newpassword.php';
        break;
    case 'editprofile':
        include '../app/view/editprofile.php';
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
    case 'profile':
        include '../app/view/profile.php';
        break;
    case 'showuserprofile':
        include '../app/view/showuserprofile.php';
        break;
    case 'resetpassword':
        include '../app/view/resetpassword.php';
        break;
    case 'passreset':
        include '../app/Model/passreset.php';
        break;
    case 'editingprofile':
        include '../app/Model/editingprofile.php';
        break;
    case 'filter':
        include '../app/Model/Filtering.php';
        break;
    case 'allimgdown':
        include '../app/view/allimgdown.php';
        break;
    case 'item2':
        include '../app/view/item2.php';
        break;
    case 'nieuwstatusitem':
        include '../app/view/nieuwstatusitem.php';
        break;
    case 'updateopenmails':
        include '../app/view/updateOpenMails.php';
        break;
    case 'updatestatusitem':
        include '../app/view/updatestatusitem.php';
        break;
    case 'deletestatusitem':
        include '../app/view/deletestatusitem.php';
        break;
    case 'changefilter':
        include '../app/Model/ChangeFilter.php';
        break;
    default:
        include '../app/view/404.php';
        break;
}

require_once '../app/view/footer.php';