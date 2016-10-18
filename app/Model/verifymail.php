<?php
#VERIFIES THE MAIL SERVER

//TODO Error message voor key (als deze verwijderd is na he accorderen)

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
 * Check email
 *
 * Is er een email in de database die gelijk is aan die meegegeven in de link
 */

if(isset( $_GET['email'] ) ) {
    $verifyemail = $_GET['email'];
} else {
    echo "No e-mail returned. ";
}

/**
 * Check key
 *
 * Is er een key in de database die gelijk is aan die meegegeven in de link
 */

if(isset( $_GET['key'] ) ) {
    $verifykey = $_GET['key'];
} else {
    echo "No key returned. ";
}

/**
 * Check email & key
 *
 * Als de email en de key bestaan, ga dan door
 */
if( isset( $_GET['email'] ) && isset( $_GET['key'] ) ) {
    $getter = $DbVerify->getVerifiedById($verifyemail, $verifykey);
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

    $session->setMailId( $getter['id'] );

    /**
     * SET User id
     *
     * Check of er een user ingelogd is
     * If: Het id van de ingelogde user wordt opgehaald
     * Else: Het id van de gebruikerinformatie van de mail wordt opgehald
     *
     */

    if(isset($_SESSION['usr_id'])) {
        $userid = $_SESSION['usr_id'];
    }
    else {
        $userid = $useracc['id'];
    }

    $session->setUserId( $userid );

    /**
     * Redirect to the next page
     */

    //header('Location: index.php?page=accordering&id='.$getter['id']);
    header('Location: index.php?page=accordering');
}
else {
    echo 'Something went wrong!';
}