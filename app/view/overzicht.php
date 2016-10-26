<?php
#OVERZICHT PAGE VAN ALLE ITEMS

$uploads = new BlockController();

$offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
$limit = 10;

$count = $uploads->countBlocks();
$get_filled_info = $uploads->getUploads($limit, $offset);

$items = new MailController();
$get_items_openstaand = $items->getUserMailByStatus(0);
$get_items_bekeken = $items->getUserMailByStatus(1);
$get_items_geweigerd = $items->getUserMailByStatus(3);
$get_items_geaccepteerd = $items->getUserMailByStatus(2);

if(isset($_POST['sub'])) {
    $mysqli = mysqli_connect();
    $user = new UserController();

    $term = mysqli_real_escape_string($mysqli, $_POST['term']);
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
                        <div class="progress-bar progress-bar-success progress-bar-striped active" style="width: 60%">
                            <a id="statusbartext" href="#"><span class="glyphicon glyphicon-ok-sign"></span>  Geaccepteerd &nbsp;&nbsp;<span class="badge"><?= $get_items_geaccepteerd['COUNT(status)'] ?></span></a>
                        </div>
                        <div class="progress-bar progress-bar-danger progress-bar-striped active" style="width: 25%">
                            <a id="statusbartext" href="#"><span class="glyphicon glyphicon-remove-sign"></span>  Geweigerd &nbsp;&nbsp;<span class="badge"><?= $get_items_geweigerd['COUNT(status)'] ?></span></a>
                        </div>
                        <div class="progress-bar progress-bar-warning progress-bar-striped active" style="width: 15%">
                            <a id="statusbartext" href="#"><span class="glyphicon glyphicon-question-sign"></span>  Openstaand &nbsp;&nbsp;<span class="badge"><?= $get_items_openstaand['COUNT(status)'] + $get_items_bekeken['COUNT(status)'] ?></span></a>
                        </div>
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

                    if(isset($term)) {

                        $searchtable = $user->searchTable($term);

                        if(!empty($searchtable)){
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

                        }
                        else { ?>
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