<?php
#OVERZICHT PAGE VAN ALLE ITEMS

if($user->getPermission($permgroup, 'CAN_SHOW_USEROVERZICHT') == 1){

}
else {
    header('Location: index.php');
    Session::flash('error', 'U heeft hier geen rechten voor.');
}

$uploads = new BlockController();

$offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
$limit = 10;

$items = new MailController();

// Haal gebruiker id op
    $userid = $_SESSION['usr_id'];


//Haal mail van de gebruiker op met zijn id en een status
    $myuser = $items->getUserMail($userid, 2);

    if($myuser == null) {
        echo '<div class="alert alert-danger" role="alert">U heeft nog geen proeven of offertes op uw account staan </div>';
        return false;
    }

// Tel aantal items er zijn voor die gebruiker
    $count = $items->countUserMailByUserId($userid);


// Haal geaccepteerde/geweigerde per gebruiker op
    $get_items_openstaand = $items->CountUserMailbyIdStatus($userid, 0);
    $get_items_bekeken = $items->CountUserMailbyIdStatus($userid, 1);
    $get_items_geweigerd = $items->CountUserMailbyIdStatus($userid, 3);
    $get_items_geaccepteerd = $items->CountUserMailbyIdStatus($userid, 2);
    $allitems = $get_items_geaccepteerd['COUNT(status)']+$get_items_geweigerd['COUNT(status)']+$get_items_openstaand['COUNT(status)']+ $get_items_bekeken['COUNT(status)'];

    $geaccepteerd_percent = ($get_items_geaccepteerd['COUNT(status)']/$allitems)*100;
    $geweigerd_percent =  ($get_items_geweigerd['COUNT(status)']/$allitems)*100;
    $openstaand_percent = 100-($geaccepteerd_percent+$geweigerd_percent);
    if($geaccepteerd_percent==0){
        $openstaand_percent-=5;
    }
    if($geweigerd_percent==0){
        $openstaand_percent-=5;
    }



$table = 'id';
$status = '';
$filter = 'DESC';

//Filter onderwerp drodpown
if(isset($_POST['OnderwerpASC'])) {
    $filter = 'ASC';
    $table = 'Onderwerp';
}
if(isset($_POST['OnderwerpDESC'])) {
    $filter = 'DESC';
    $table = 'Onderwerp';
}

//Filter verstuurder dropdown
if(isset($_POST['VerstuurderASC'])) {
    $filter = 'ASC';
    $table = 'Verstuurder';
}
if(isset($_POST['VerstuurderDESC'])) {
    $filter = 'DESC';
    $table = 'Verstuurder';
}

//Filter Naam klant dropdwon
if(isset($_POST['NaamklASC'])) {
    $filter = 'ASC';
    $table = 'naam';
}
if(isset($_POST['NaamklDESC'])) {
    $filter = 'DESC';
    $table = 'naam';
}

//Filter Datum dropdown
if(isset($_POST['DatumASC'])) {
    $filter = 'ASC';
    $table = 'datum';
}
if(isset($_POST['DatumDESC'])) {
    $filter = 'DESC';
    $table = 'datum';
}

//Filter Status dropdown
if(isset($_POST['StatusASC'])) {
    $filter = 'ASC';
    $table = 'verified';
}
if(isset($_POST['StatusDESC'])) {
    $filter = 'DESC';
    $table = 'verified';
}

if(isset($_POST['OpenASC'])) {
    $filter = 'ASC';
    $status = '0';
    $table = 'verified';
}
if(isset($_POST['GezienASC'])) {
    $filter = 'ASC';
    $status = '1';
    $table = 'verified';
}
if(isset($_POST['GoedgekeurdASC'])) {
    $filter = 'ASC';
    $status = '2';
    $table = 'verified';
}
if(isset($_POST['AfgekeurdASC'])) {
    $filter = 'ASC';
    $status = '3';
    $table = 'verified';
}

//Makkelijker manier
/* $gaa = new DbMail();
$gad = $gaa->testfunction();
var_dump( $gad[8]['id'] ); */

//Zet alle mails in een array met een offset en een limit
    $getAllUserItems = $items->getUserMailByUserId($userid, $limit, $offset);
    foreach($getAllUserItems as $UserItem) {
        $mail = $items->getMailById($UserItem['mailid']);
        $getMails[] = $mail;
    }

// Tel het aantal items die er zijn
    $getAllUserItems1 = $items->getUserMailByUserId($userid, 0, 0);
    foreach($getAllUserItems1 as $UserItem1) {
        $mail1 = $items->getMailById($UserItem1['mailid']);
        $getAllMails[] = $mail1;
    }

// Haal alle items van de gebruiker op en zet deze in een array
    foreach($getAllMails as $AllMails) {
        $TheMails[] = intval( $AllMails['id'] );
    }
$searchMail = (implode(",", $TheMails));

if(isset($_POST['sub'])) {
    $mysqli = mysqli_connect();
    $user = new UserController();
    $term = mysqli_real_escape_string($mysqli, $_POST['term']);
    $_SESSION['myterm'] = $term;
}

if(isset($term)) {
    if ($term == '') {
        unset($_SESSION['myterm']);
    }
}
?>

<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <p class="NameText">Uw overzicht</p>
                <hr size="1">
            </div>
        </div>
    </div>
</div>