<?php
#VERIFIES THE MAIL SERVER

require_once 'permissions.php';

/**
 * CREATE Session
 *
 * Creeer een nieuwe sessie voor dingen in op te slaan voor de accordering
 * @var Session
 */

$session = new Session();

/**
 * CREATE DbVerify
 *
 * DbVerify wordt gebruikt om te checken of de email en key die meegestuurd zijn in de mail nog bestaan
 * @var DbVerify
 */

$DbVerify = new DbVerify();

/**
 * Mailcontroller voor ophalen van de maild
 */

$mail = new MailController();

/**
 * Haal de mail met het id op
 */
$session = new Session();
$_GET['id'] = $session->cleantonumber($_GET['id']);
$mymail = $mail->getMailById($_GET['id']);

/**
 * Check of er een id is meegestuurd
 */

if ($mymail) {
    $verifyemail = $mymail['email'];
} else {
    echo TEXT_ERROR_OCCURED;
    return false;
}

/**
 * Check key
 *
 * Is er een key in de database die gelijk is aan die meegegeven in de link
 */

if (isset($_GET['key'])) {
    $_GET['key'] = $session->clean($_GET['key']);
    if ($mymail['key'] == $_GET['key']) {
        $mailkey = ($mymail['key']);
    } else { ?>
        <br>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <strong>Let op!</strong> Het product is al geaccordeerd. Bekijk de status in het overzicht.
        </div>

    <?php }

}

/**
 * Check email & key
 *
 * Als de email en de key bestaan, ga dan door
 */
if (isset($_GET['id']) && isset($mailkey)) {

    $getter = $DbVerify->getVerifiedById($verifyemail, $mailkey);
    $DbVerify->setVerifiedById($getter['id']);

    /**
     * GET User from mail
     *
     * Haal gebruiker informatie op van de mail die verstuurd is naar de klant
     *
     * //Gebruikt voor opslaan van geaccordeede proeven/offertes voor de klant\\
     * Reden: klanten moeten zonder in te loggen kunnen accorderen
     */

    $useracc = $DbVerify->getUserForAccord($verifyemail);

    $session->setMailId($getter['id']);

    /**
     * SET User id
     *
     * Check of er een user ingelogd is
     * If: Het id van de ingelogde user wordt opgehaald
     * Else: Het id van de gebruikerinformatie van de mail wordt opgehald
     *
     */

    if (isset($_SESSION['usr_id'])) {
        $userid = $_SESSION['usr_id'];
    } else {
        $userid = $useracc['id'];
    }

    $user = new UserController();

    if ($user->getPermission($permgroup, 'CAN_ACCORD') == 1) {

    } else {
        $block->Redirect('index.php');
        Session::flash('error', TEXT_NO_PERMISSION);
    }
    $session->setUserId($userid);
    $_SESSION['accord'] = '1';

    /**
     * Redirect to the next page
     */

    $block->Redirect('index.php?page=approve');
} else {
    echo '<div class="alert alert-danger">' . TEXT_ERROR_OCCURED . '</div>';
}