<?php
#OVERZICHT PAGE VAN ALLE ITEMS
$uploads = new BlockController();

$offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
$limit = 10;

$items = new MailController();

// Haal gebruiker id op
    $userid = 20;


//Haal mail van de gebruiker op met zijn id en een status
    $myuser = $items->getUserMail($userid, 2);


// Tel aantal items er zijn voor die gebruiker
    $count = $items->countUserMailByUserId($userid);


// Haal geaccepteerde/geweigerde per gebruiker op
    $get_items_openstaand = $items->CountUserMailbyIdStatus($userid, 0);
    $get_items_bekeken = $items->CountUserMailbyIdStatus($userid, 1);
    $get_items_geweigerd = $items->CountUserMailbyIdStatus($userid, 3);
    $get_items_geaccepteerd = $items->CountUserMailbyIdStatus($userid, 2);
    $allitems = $get_items_geaccepteerd['COUNT(status)']+$get_items_geweigerd['COUNT(status)']+$get_items_openstaand['COUNT(status)']+ $get_items_bekeken['COUNT(status)'];


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
    $_SESSION['term'] = $term;
}

if(isset($term)) {
    if ($term == '') {
        unset($_SESSION['term']);
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
                <div class="well well-m">
                    <br>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success progress-bar-striped active" style="min-width: 4em;width: <?= ($get_items_geaccepteerd['COUNT(status)']/$allitems)*100 ?>%">
                            <a id="statusbartext" href="#"><span class="glyphicon glyphicon-ok-sign"></span>  <span class="badge"><?= $get_items_geaccepteerd['COUNT(status)'] ?></span></a>
                        </div>
                        <div class="progress-bar progress-bar-danger progress-bar-striped active" style="min-width: 4em;width: <?= ($get_items_geweigerd['COUNT(status)']/$allitems)*100 ?>%">
                            <a id="statusbartext" href="#"><span class="glyphicon glyphicon-remove-sign"></span>  <span class="badge"><?= $get_items_geweigerd['COUNT(status)'] ?></span></a>
                        </div>
                        <div class="progress-bar progress-bar-warning progress-bar-striped active" style="min-width: 4em;width: <?= (($get_items_openstaand['COUNT(status)']+$get_items_bekeken['COUNT(status)'])/$allitems)*100 ?>%">
                            <a id="statusbartext" href="#"><span class="glyphicon glyphicon-question-sign"></span>  <span class="badge"><?= $get_items_openstaand['COUNT(status)'] + $get_items_bekeken['COUNT(status)'] ?></span></a>
                        </div>
                    </div>
                    <div class="btn-group">
                        <button type="button" style="width: 95px;" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <span style="color: #bb2c4c;">Legenda </span> <span style="color: #bb2c4c" class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#" class="glyphicon glyphicon-ok-sign"> Goedgekeurd</a></li>
                            <li><a href="#" class="glyphicon glyphicon-remove-sign"> Geweigerd</a></li>
                            <li><a href="#" class="glyphicon glyphicon-question-sign"> Open</a></li>
                        </ul>
                    </div>
                </div>
                <!--<input type="text" size="50" id="TableInput" onkeyup="searchTable()" placeholder="Zoek een product...">-->

                <form method="post" action="?page=profile">
                    <input type="text" size="50" id="TableInput" name="term" placeholder="<?php if(isset($term)){ echo 'Gesorteerd op: ' . $term;} else { echo 'Zoek een product..'; }?>">
                    <input type="submit" name="sub">
                </form>

                <div id="form-content"></div>

                <!--<script>
                    $('#reg-form').submit(function(e){
                        e.preventDefault(); // Prevent Default Submission
                        $.post('?page=submit', $(this).serialize() )
                            .done(function(data){
                                $('#form-content').fadeOut('slow', function(){
                                    $('#form-content').fadeIn('slow').html(data);
                                });
                            })
                            .fail(function(){
                                alert('Ajax Submit Failed ...');
                            });
                    });
                </script>-->

            </div>

            <br><br>

            <div class="btn-group">
                <button type="button" style="width: 95px;" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span style="color: #bb2c4c;">Legenda </span> <span style="color: #bb2c4c" class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#"><img alt="Gezien" style="width: 45px; height: 45px;" src="../public/icons/gezien.png">   Item is gezien, maar nog niet geaccordeerd.</a></li>
                    <li><a href="#"><img alt="Geaccepteerd" src="../public/icons/akkoord.png">   Het item is goedgekeurd.</a></li>
                    <li><a href="#"><img alt="Geweigerd" src="../public/icons/geweigerd.png">   Het item is geweigerd.</a></li>
                    <li><a href="#"><img alt="Uploaded" src="../public/icons/uploaded.png">   Het item is geüpload.</a></li>
                </ul>
            </div>

            <table id="overzicht" class="sortable table-striped">
                <thead>
                <tr>
                    <td><b>ID</b></td>
                    <td><b>Onderwerp</b></td>
                    <td><b>Verstuurder</b></td>
                    <td><b>Naam klant</b></td>
                    <td><b>Datum</b></td>
                    <td><b>Status</b></td>
                </tr>
                </thead>
                <tbody>
                <?php
                if( isset($_SESSION['term']) ) {
                    $count = count( $user->searchTable($_SESSION['term'], 0, 0, $searchMail) );
                    $searchtable = $user->searchTable($_SESSION['term'], $limit, $offset, $searchMail);
                    if (!empty($searchtable)) {
                        foreach ($searchtable as $upload) {
                            ?>
                            <tr>
                            <td>
                                <?= $upload['id'] ?>
                            </td>
                            <td>
                                <a href="?page=item&id=<?= $upload['id'] ?>"><?= $upload['onderwerp'] ?></a>
                            </td>
                            <td>
                                <?= $upload['verstuurder'] ?>
                            </td>
                            <td>
                                <?= $upload['naam'] ?>
                            </td>
                            <td>
                                <?= date("d-m-Y", strtotime($upload['datum'])); ?>
                            </td>
                            <td>
                                <?php if ($upload['verified'] == 1) { ?>
                                    <img alt="Gezien" style="width: 50px; height: 50px;"
                                         src="../public/icons/gezien.png">
                                <?php } elseif ($upload['verified'] == 2) { ?>
                                    <img alt="Geaccepteerd" src="../public/icons/akkoord.png">
                                <?php } elseif ($upload['verified'] == 3) { ?>
                                    <img alt="Geweigerd" src="../public/icons/geweigerd.png">
                                <?php } else { ?>
                                    <img alt="Uploaded" src="../public/icons/uploaded.png">
                                <?php } ?>
                            </td>
                            </tr><?php }
                    } else { ?>
                        <tr>
                            <td>De zoekterm die U heeft meegegeven is niet gevonden.</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    <?php }
                }
                else if ($getMails !== null && isset($getMails)) {
                    foreach ($getMails as $upload) { ?>
                        <tr>
                            <td>
                                <?= $upload['id'] ?>
                            </td>
                            <td>
                                <a href="?page=item&id=<?= $upload['id'] ?>"><?= $upload['onderwerp'] ?></a>
                            </td>
                            <td>
                                <?= $upload['verstuurder'] ?>
                            </td>
                            <td>
                                <?= $upload['naam'] ?>
                            </td>
                            <td>
                                <?= date("d-m-Y", strtotime($upload['datum'])); ?>
                            </td>
                            <td>
                                <?php if ($upload['verified'] == 1) { ?>
                                    <img alt="Gezien" style="width: 50px; height: 50px;"
                                         src="../public/icons/gezien.png">
                                <?php } elseif ($upload['verified'] == 2) { ?>
                                    <img alt="Geaccepteerd" src="../public/icons/akkoord.png">
                                <?php } elseif ($upload['verified'] == 3) { ?>
                                    <img alt="Geweigerd" src="../public/icons/geweigerd.png">
                                <?php } else { ?>
                                    <img alt="Uploaded" src="../public/icons/uploaded.png">
                                <?php } ?>
                            </td>
                        </tr>
                    <?php }
                }
                else {
                    ?>
                    <tr>
                        <td>
                            Er zijn nog geen items. Voeg eerst een item toe via de upload pagina.
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
            <ul class="pagination">
                <?php for ( $i = 0; $i < ceil( $count / $limit ); $i++ ) : ?>
                    <li>
                        <a href="<?= "index.php?page=profile&offset=". $limit * $i ?>"> <?= ( $i + 1 ) ?> </a>
                    </li>
                <?php endfor; ?>
            </ul>
            <hr size="1">
        </div>
    </div>
</div>
</div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          