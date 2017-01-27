<?php
#NEWPASSWORD PROCESSING PAGE

$mysqli = mysqli_connect();
$user = new UserController();

//set validation error flag as false
$error = false;


//check if form is submitted
if (isset($_POST['newpassword'])) {

    $id = $_SESSION['usr_id'];
    $myuser = $user->getUserById($id);

    $password = mysqli_real_escape_string($mysqli, $_POST['password']);
    $oldhash = $myuser['paswoord'];

    $cpassword = mysqli_real_escape_string($mysqli, $_POST['cpassword']);
    $newcpassword = mysqli_real_escape_string($mysqli, $_POST['newcpassword']);

    //name can contain only alpha characters and space
    if (strlen($cpassword) < 6) {
        $error = true;
        $password_error = TEXT_MINIMAL_LENGTH_6;
    }

    if ($oldhash !== hash('sha256', $password)) {
        $error = true;
        $password_error = TEXT_WRONG_PASSWORD;
    }

    if ($cpassword !== $newcpassword) {
        $error = true;
        $password_error = TEXT_PASSWORDS_DONT_MATCH;
    }

    if (!$error) {

        $npassword = hash('sha256', $cpassword);

        if ($user->updateUser($id, $npassword)) {
            $successmsg = TEXT_PASSWORD_CHANGED;
        } else {
            $errormsg = TEXT_ERROR_OCCURED;
        }

    }
}
?>

<div id="h">
    <div class="social hidden-xs">

    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 centered">
                <form role="form" method="post" name="signupform">
                    <fieldset>
                        <br>
                        <div class="form-group">
                            <label for="name"><?= TEXT_CURRENT_PASSWORD ?></label>
                            <input type="password" name="password" placeholder="<?= TEXT_CURRENT_PASSWORD ?>" required
                                   class="form-control"/>
                            <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
                        </div>

                        <div class="form-group">
                            <label for="name"><?= TEXT_NEW_PASSWORD ?></label>
                            <input type="password" id="password" name="cpassword" placeholder="<?= TEXT_NEW_PASSWORD ?>"
                                   required class="form-control"/>
                            <span
                                class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
                        </div>

                        <div class="form-group">
                            <label for="name"><?= TEXT_NEW_PASSWORD_REPEAT ?></label>
                            <input type="password" name="newcpassword" placeholder="<?= TEXT_NEW_PASSWORD ?>" required
                                   class="form-control"/>
                            <span
                                class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
                        </div>
                        <br>
                        <p style="font-size: 16px;"><?= TEXT_PASSWORD_STRENGTH ?></p>
                        <div class="progress progress-striped active">
                            <div id="jak_pstrength" class="progress-bar" role="progressbar" aria-valuenow="0"
                                 aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                        </div>
                        <br>
                        <div class="form-group">
                            <input type="submit" name="newpassword" value="<?= BUTTON_SAVE ?>" class="btn btn-primary"/>
                        </div>
                    </fieldset>
                </form>
                <span class="text-success"><?php if (isset($successmsg)) {
                        echo $successmsg;
                    } ?></span>
                <span class="text-danger"><?php if (isset($errormsg)) {
                        echo $errormsg;
                    } ?></span>
            </div>
        </div>
    </div>
</div>
<script src="../public/js/jquery-1.10.2.js"></script>
<script src="../public/js/bootstrap.min.js"></script>
</div>
</div><!--/row-->
</div><!--/container-->
</div><!-- /H -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="../public/js/jquery.min.js"></script>
<script src="../public/js/bootstrap.min.js"></script>
<script src="../public/js/retina-1.1.0.js"></script>
</body>
</html>