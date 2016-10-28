<?php
#OVERZICHT PAGE VAN ALLE ITEMS

$uploads = new BlockController();

$offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
$limit = 10;

$count = $uploads->countBlocks();

$table = 'id';
$filter = 'DESC';
$get_filled_info = $uploads->getUploads($table, $filter, $limit, $offset);

$items = new MailController();
$get_items_openstaand = $items->getUserMailByStatus(0);
$get_items_bekeken = $items->getUserMailByStatus(1);
$get_items_geweigerd = $items->getUserMailByStatus(3);
$get_items_geaccepteerd = $items->getUserMailByStatus(2);
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
                <p class="NameText">Overzicht</p>
                <hr size="1">
                <div class="well well-m">
                    <br>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success progress-bar-striped active" style="min-width: 5%;width: <?= $geaccepteerd_percent ?>%">
                            <a id="statusbartext" href="#"><span class="glyphicon glyphicon-ok-sign"></span>  <span class="badge"><?= $get_items_geaccepteerd['COUNT(status)'] ?></span></a>
                        </div>
                        <div class="progress-bar progress-bar-danger progress-bar-striped active" style="min-width: 5%;width: <?= $geweigerd_percent ?>%">
                            <a id="statusbartext" href="#"><span class="glyphicon glyphicon-remove-sign"></span>  <span class="badge"><?= $get_items_geweigerd['COUNT(status)'] ?></span></a>
                        </div>
                        <div class="progress-bar progress-bar-warning progress-bar-striped active" style="min-width: 5%;width: <?= $openstaand_percent ?>%">
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

                <form method="post" action="?page=overzicht">
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

                    if(isset($_SESSION['term'])) {

                        $count = count( $user->searchTable($_SESSION['term']) );
                        $searchtable = $user->searchTable($_SESSION['term'], $limit, $offset);

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
                        else if ($get_filled_info !== null && isset($get_filled_info)) {
                            foreach ($get_filled_info as $upload) { ?>
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
                            <a href="<?= "index.php?page=overzicht&offset=". $limit * $i ?>"> <?= ( $i + 1 ) ?> </a>
                        </li>
                    <?php endfor; ?>
                </ul>
                <hr size="1">
            </div>
        </div>
    </div>
</div>