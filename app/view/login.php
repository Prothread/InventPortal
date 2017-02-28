<?php
#LOGIN PAGE

$mysqli = mysqli_connect();

$user = new UserController();
$admin = $user->getAdminSettings();

$redirect = NULL;

//check if form is submitted
if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $password = mysqli_real_escape_string($mysqli, $_POST['password']);

    $userinfo = [
        'email' => strip_tags($email),
        'password' => strip_tags($password)
    ];

    if ($row = mysqli_fetch_array($user->getUser($userinfo))) {
        if ($row['active']) {
            $_SESSION['usr_id'] = $row['id'];
            $_SESSION['usr_name'] = $row['naam'];
        } else {
            $errormsg = TEXT_USER_NOT_ACTIVE;
        }
    } else {
        $errormsg = TEXT_WRONG_LOGIN_COMBINATION;
    }

    if (isset($_SESSION['usr_id']) != "") {
        if ($_GET['page'] && $_GET['page'] !== 'login') {
            header("Refresh:0");
        } else {
            $block->Redirect('index.php?page=dashboard');
        }
    }

}

if ($session->exists('flash')) {
    foreach ($session->get('flash') as $flash) {
        echo "<div class='alert alert_{$flash['type']}'>{$flash['message']}</div>";
    }
    $session->remove('flash');
}
?>

<div id="loginbackground"
     style="width: 100%; height: 100%; background-image: url('<?= DIR_PUBLIC . 'background/' . $admin['background'] ?>'); background-size: cover; background-repeat: no-repeat;">
    <div id="h">
        <div class="social hidden-xs">

        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 centered loginbar" id="slide">


                    <form role="form" method="post" name="loginform">
                        <fieldset>
                            <div id="loginheader">
                                <div id="logincenter">
                                    <img src="<?= DIR_PUBLIC . $admin['Logo'] ?>" class="fade-in one">
                                </div>
                            </div>
                            <br>
                            <br>
                            <label for="name"><?= TEXT_EMAIL ?></label>
                            <input type="text" name="email" placeholder="<?= TEXT_EMAIL ?>" required
                                   class="form-control"/>
                            <br/>
                            <label for="name"><?= TEXT_PASSWORD ?></label>
                            <input type="password" name="password" placeholder="<?= TEXT_PASSWORD ?>" required
                                   class="form-control"/>
                            <br/>
                            <input type="submit" name="login" value="Inloggen" class="btn btn-primary"/>
                            <br/>
                            <br/>
                            <a style="color: #fff;" href="index.php?page=forgetpassword"><?= TEXT_PASSWORD_FORGET ?>
                                ?</a>
                            <br/>
                            <br/>
                        </fieldset>
                    </form>
                    <span class="text-danger"><?php if (isset($errormsg)) {
                            echo $errormsg;
                        } ?></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-4 text-center">
                    <br/>
                </div>
            </div>
        </div>

        <script src="js/bootstrap.min.js"></script>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/retina-1.1.0.js"></script>
</div>