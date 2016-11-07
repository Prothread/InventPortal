<?php
#MANAGE CLIENTS PAGE

if($user->getPermission($permgroup, 'CAN_SHOW_USERS') == 1){

}
else {
    header('Location: index.php');
    Session::flash('error', 'U heeft hier geen rechten voor.');
}

$user = new UserController();

$offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
$limit = 10;

$table = 'id';
$status = '';
$filter = 'DESC';

//Filter Naam klant dropdwon
if(isset($_POST['NaamASC'])) {
    $filter = 'ASC';
    $table = 'naam';
}
if(isset($_POST['NaamDESC'])) {
    $filter = 'DESC';
    $table = 'naam';
}

//Filter bedrijfsnaam dropdwon
if(isset($_POST['BedrijfnaamASC'])) {
    $filter = 'ASC';
    $table = 'bedrijfsnaam';
}
if(isset($_POST['BedrijfnaamDESC'])) {
    $filter = 'DESC';
    $table = 'bedrijfsnaam';
}

//Filter email dropdwon
if(isset($_POST['EmailASC'])) {
    $filter = 'ASC';
    $table = 'email';
}
if(isset($_POST['EmailDESC'])) {
    $filter = 'DESC';
    $table = 'email';
}

//Filter adres dropdwon
if(isset($_POST['AdresASC'])) {
    $filter = 'ASC';
    $table = 'adres';
}
if(isset($_POST['AdresDESC'])) {
    $filter = 'DESC';
    $table = 'adres';
}

//Filter postcode dropdwon
if(isset($_POST['PostcodeASC'])) {
    $filter = 'ASC';
    $table = 'postcode';
}
if(isset($_POST['PostcodeDESC'])) {
    $filter = 'DESC';
    $table = 'postcode';
}

//Filter postcode dropdwon
if(isset($_POST['PlaatsASC'])) {
    $filter = 'ASC';
    $table = 'plaats';
}
if(isset($_POST['PlaatsDESC'])) {
    $filter = 'DESC';
    $table = 'plaats';
}

$getAllUsers = $user->getAllUsersByPerm($table, $filter, 0, 0, 1);
$get_filled_info = $user->getAllUsersByPerm($table, $filter, $limit, $offset, 1);
$count = count($getAllUsers);

if(isset($_POST['sub'])) {
    $mysqli = mysqli_connect();
    $mail = new MailController();

    $term = mysqli_real_escape_string($mysqli, $_POST['term']);
    $_SESSION['termuser1'] = $term;
}

if(isset($term)) {
    if ($term == '') {
        unset($_SESSION['termuser1']);
    }
}

?>

<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <p class="NameText">Gebruikers beheren</p>
                <hr size="1">

                <form method="post" action="?page=manageusers">
                    <input type="text" size="50" id="TableInput" name="term" placeholder="<?php if(isset($_SESSION['termuser1'])){ echo 'Gesorteerd op: ' . $_SESSION['termuser1'];} else { echo 'Zoek een product..'; }?>">
                    <input id="SendSearch" value="" type="submit" name="sub">
                </form>

                <br>
                <br>
                <a href="index.php?page=newclient"><div id="NewClientButton">Nieuwe gebruiker</div></a>

                <form action="?page=manageusers" method="post">
                <table id="overzicht" class="sortable table-striped">
                    <br><br>
                    <thead>
                    <tr>
                    <tr>
                        <th>
                            <div class="btn-group">
                                <button type="button" style="width: 100%;" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span style="color: #bb2c4c;">Weergavenaam </span> <span style="color: #bb2c4c" class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><input type="submit" id="filterbutton" name="NaamASC" value="A-Z" style="width:100%;"></li>
                                    <br>
                                    <li><input type="submit" id="filterbutton" name="NaamDESC" value="Z-A" style="width:100%;"></li>
                                </ul>
                            </div>
                        </th>

                        <th>
                            <div class="btn-group">
                                <button type="button" style="width: 100%;" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span style="color: #bb2c4c;">Bedrijfsnaam </span> <span style="color: #bb2c4c" class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><input type="submit" id="filterbutton" name="BedrijfnaamASC" value="A-Z" style="width:100%;"></li>
                                    <br>
                                    <li><input type="submit" id="filterbutton" name="BedrijfnaamDESC" value="Z-A" style="width:100%;"></li>
                                </ul>
                            </div>
                        </th>

                        <th>
                            <div class="btn-group">
                                <button type="button" style="width: 100%;" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span style="color: #bb2c4c;">E-mail </span> <span style="color: #bb2c4c" class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><input type="submit" id="filterbutton" name="EmailASC" value="A-Z" style="width:100%;"></li>
                                    <br>
                                    <li><input type="submit" id="filterbutton" name="EmailDESC" value="Z-A" style="width:100%;"></li>
                                </ul>
                            </div>
                        </th>

                        <th>
                            <div class="btn-group">
                                <button type="button" style="width: 100%;" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span style="color: #bb2c4c;">Adres </span> <span style="color: #bb2c4c" class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><input type="submit" id="filterbutton" name="AdresASC" value="A-Z" style="width:100%;"></li>
                                    <br>
                                    <li><input type="submit" id="filterbutton" name="AdresDESC" value="Z-A" style="width:100%;"></li>
                                </ul>
                            </div>
                        </th>

                        <th>
                            <div class="btn-group">
                                <button type="button" style="width: 100%;" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span style="color: #bb2c4c;">Postcode </span> <span style="color: #bb2c4c" class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><input type="submit" id="filterbutton" name="PostcodeASC" value="A-Z" style="width:100%;"></li>
                                    <br>
                                    <li><input type="submit" id="filterbutton" name="PostcodeDESC" value="Z-A" style="width:100%;"></li>
                                </ul>
                            </div>
                        </th>

                        <th>
                            <div class="btn-group">
                                <button type="button" style="width: 100%;" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span style="color: #bb2c4c;">Plaats </span> <span style="color: #bb2c4c" class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><input type="submit" id="filterbutton" name="PlaatsASC" value="A-Z" style="width:100%;"></li>
                                    <br>
                                    <li><input type="submit" id="filterbutton" name="PlaatsDESC" value="Z-A" style="width:100%;"></li>
                                </ul>
                            </div>
                        </th>

                        <th>
                            <b>
                                Edit
                            </b>
                        </th>

                    </tr>
                    </tr>
                    </thead>
                    <tbody>

                    <?php if(isset($_SESSION['termuser1'])) {

                        $count = count( $user->searchTable($_SESSION['termuser1']) );
                        $searchtable = $user->searchTable($_SESSION['termuser1'], $limit, $offset, $table, $filter, '2,3,4');

                        foreach ($searchtable as $client) { ?>
                            <tr>
                                <td>
                                    <?= $client['naam']; ?>
                                </td>
                                <td>
                                    <?= $client['bedrijfsnaam']; ?>
                                </td>
                                <td>
                                    <?= $client['email']; ?>
                                </td>
                                <td>
                                    <?= $client['adres']; ?>
                                </td>
                                <td>
                                    <?= $client['postcode']; ?>
                                </td>
                                <td>
                                    <?= $client['plaats']; ?>
                                </td>
                                <td>
                                    <?php $clientid = $client['id']; ?>
                                    <a href="?page=editclient&id=<?= $clientid ?>"><img
                                            src="../public/img/icons/settings-hover.png" style="width: 24px; height: 24px;">
                                </td>
                            </tr>
                        <?php }
                    }
                    else {
                        foreach ($get_filled_info as $client) { ?>
                            <tr>
                                <td>
                                    <?= $client['naam']; ?>
                                </td>
                                <td>
                                    <?= $client['bedrijfsnaam']; ?>
                                </td>
                                <td>
                                    <?= $client['email']; ?>
                                </td>
                                <td>
                                    <?= $client['adres']; ?>
                                </td>
                                <td>
                                    <?= $client['postcode']; ?>
                                </td>
                                <td>
                                    <?= $client['plaats']; ?>
                                </td>
                                <td>
                                    <?php $clientid = $client['id']; ?>
                                    <a href="?page=editclient&id=<?= $clientid ?>"><img
                                            src="../public/img/icons/settings-hover.png" style="width: 24px; height: 24px;">
                                </td>
                            </tr>
                        <?php }
                    }?>

                    </tbody>
                </table>
                </form>

                <ul class="pagination">
                    <?php for ( $i = 0; $i < ceil( $count / $limit ); $i++ ) : ?>
                        <li>
                            <a href="<?= "index.php?page=manageusers&offset=". $limit * $i ?>"> <?= ( $i + 1 ) ?> </a>
                        </li>
                    <?php endfor; ?>
                </ul>

            </div>
        </div>
    </div>
</div>