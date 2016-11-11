<?php
#OVERZICHT PAGE VAN ALLE ITEMS

if($user->getPermission($permgroup, 'CAN_SHOW_OVERZICHT') == 1){

}
else {
    header('Location: index.php?page=gebruikersoverzicht');
}

$uploads = new BlockController();

$offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
$limit = 10;

$count = $uploads->countBlocks();

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

$get_filled_info = $uploads->getUploads($table, $filter, $limit, $offset, $status);

$items = new MailController();
$get_items_openstaand = $items->getUserMailByStatus(0);
$get_items_bekeken = $items->getUserMailByStatus(1);
$get_items_geweigerd = $items->getUserMailByStatus(3);
$get_items_geaccepteerd = $items->getUserMailByStatus(2);
$allitems = $get_items_geaccepteerd['COUNT(status)']+$get_items_geweigerd['COUNT(status)']+$get_items_openstaand['COUNT(status)']+ $get_items_bekeken['COUNT(status)'];

$openstaand = $get_items_openstaand['COUNT(status)']+$get_items_bekeken['COUNT(status)'];


if(isset($_POST['sub'])) {
    $mysqli = mysqli_connect();
    $mail = new MailController();

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
            <table style="width:100%">
            <tr>
            <th style="text-align: left;"><p class="NameText" style="font-weight: normal;">Overzicht</p></th>
            <th style="text-align: right;"><div class="btn-group">
                <button type="button" style="width: 95px; margin-left: 13px;" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span style="color: #bb2c4c;">Legenda </span> <span style="color: #bb2c4c" class="caret"></span>
                </button>
                <ul class="dropdown-menu pull-right">
                    <li><a href="#"><img alt="Gezien" style="width: 45px; height: 45px;" src="../public/icons/gezien.png">   Item is gezien, maar nog niet geaccordeerd.</a></li>
                    <li><a href="#"><img alt="Geaccepteerd" src="../public/icons/akkoord.png">   Het item is goedgekeurd.</a></li>
                    <li><a href="#"><img alt="Geweigerd" src="../public/icons/geweigerd.png">   Het item is geweigerd.</a></li>
                    <li><a href="#"><img alt="Uploaded" src="../public/icons/uploaded.png">   Het item is geüpload.</a></li>
                </ul>
            </div>
            </th> 
            </tr>
            </table>
            <hr size="1">
            <br>

                <!--<input type="text" size="50" id="TableInput" onkeyup="searchTable()" placeholder="Zoek een product...">-->

                <form method="post" action="?page=overzicht">
                    <input type="text" size="50" id="TableInput" name="term" placeholder="<?php if(isset($_SESSION['term'])){ echo 'Gesorteerd op: ' . $_SESSION['term'];} else { echo 'Zoek een product..'; }?>">
                    <input id="SendSearch" value="" type="submit" name="sub">
                </form>
                <br />

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

            <br>

        
            <br><br><br>
            <form id="filters" action="?page=overzicht" method="post">
                <table id="overzicht" class="table-striped">
                    <thead>
                    <tr>
                        <td>
                            <div class="btn-group">
                                <button type="button" style="width: 100%;" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span style="color: #bb2c4c;">Onderwerp </span> <span style="color: #bb2c4c" class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><input type="submit" id="filterbutton" name="OnderwerpASC" value="A-Z" style="width:100%;"></li>
                                    <br>
                                    <li><input type="submit" id="filterbutton" name="OnderwerpDESC" value="Z-A" style="width:100%;"></li>
                                </ul>
                            </div>
                        </td>

                        <td>
                            <div class="btn-group">
                                <button type="button" style="width: 100%;" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span style="color: #bb2c4c;">Verstuurder </span> <span style="color: #bb2c4c" class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><input type="submit" id="filterbutton" name="VerstuurderASC" value="A-Z" style="width:100%;"></li>
                                    <br>
                                    <li><input type="submit" id="filterbutton" name="VerstuurderDESC" value="Z-A" style="width:100%;"></li>
                                </ul>
                            </div>
                        </td>

                        <td>
                            <div class="btn-group">
                                <button type="button" style="width: 100%;" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span style="color: #bb2c4c;">Naam klant </span> <span style="color: #bb2c4c" class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><input type="submit" id="filterbutton" name="NaamklASC" value="A-Z" style="width:100%;"></li>
                                    <br>
                                    <li><input type="submit" id="filterbutton" name="NaamklDESC" value="Z-A" style="width:100%;"></li>
                                </ul>
                            </div>
                        </td>
                        <td>
                            <div class="btn-group">
                                <button type="button" style="width: 100%;" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span style="color: #bb2c4c;">Datum </span> <span style="color: #bb2c4c" class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><input type="submit" id="filterbutton" name="DatumASC" value="Oud-Nieuw" style="width:100%;"></li>
                                    <br>
                                    <li><input type="submit" id="filterbutton" name="DatumDESC" value="Nieuw-Oud" style="width:100%;"></li>
                                </ul>
                            </div>
                        </td>
                        <td>
                            <div class="btn-group">
                                <button type="button" style="width: 100%;" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span style="color: #bb2c4c;">Status </span> <span style="color: #bb2c4c" class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><input type="submit" id="filterbutton" name="StatusASC" value="Oud-Nieuw" style="width:100%;"></li>
                                    <br>
                                    <li><input type="submit" id="filterbutton" name="StatusDESC" value="Nieuw-Oud" style="width:100%;"></li>
                                    <br />
                                    <li><input type="submit" id="filterbutton" name="OpenASC" value="Open" style="width:100%;"></li>
                                    <br>
                                    <li><input type="submit" id="filterbutton" name="GezienASC" value="Gezien" style="width:100%;"></li>
                                    <br>
                                    <li><input type="submit" id="filterbutton" name="GoedgekeurdASC" value="Goedgekeurd" style="width:100%;"></li>
                                    <br>
                                    <li><input type="submit" id="filterbutton" name="AfgekeurdASC" value="Afgekeurd" style="width:100%;"></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    </thead>
                    <tbody>

                    <?php

                    if(isset($_SESSION['term'])) {

                        $count = count( $mail->searchTable($_SESSION['term']) );
                        $searchtable = $mail->searchTable($_SESSION['term'], $limit, $offset, $table, $filter, '', $status);

                        if (!empty($searchtable)) {
                            foreach ($searchtable as $upload) {
                                ?>
                                <tr>
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
                    else if ($get_filled_info !== null && isset($get_filled_info)) {
                        foreach ($get_filled_info as $upload) {
                            ?>
                            <tr>
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
                            <div class="alert alert-danger" role="alert">
                                Er zijn nog geen items. Voeg eerst een item toe via de upload pagina.
                            </div>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </form>

            <ul class="pagination">
            <table>
              <tr>
                <?php for ( $i = 0; $i < ceil( $count / $limit ); $i++ ) : ?>
                    <li>
                            <th><form id="PaginationForm" method="post" action="<?= "index.php?page=overzicht&offset=". $limit * $i ?>">
                                <input type="hidden" id="TableInput" name="term" value="<?php if(isset($_SESSION['term'])){ echo $_SESSION['term']; }else{ echo ''; }?>">
                                <input class="btn btn-default" id="PaginationButton" value="<?= ( $i + 1 ) ?>" type="submit" name="sub">
                            </form></th>
                        
                    </li>
                <?php endfor; ?>
                </tr>
                </table>
            </ul>
            <hr size="1">
        </div>
    </div>
</div>
</div>