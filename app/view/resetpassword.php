<?php
#PAGE FOR MAKING A NEW PASSWORD

$user = new UserController();
$session = new Session();

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $token = $session->clean($token);
} else {
    echo TEXT_PASSWORD_FORGET_ERROR;
    return false;
}

$getbyemail = $user->getUserByEmail($_GET['email']);
if ($getbyemail !== null) {
    $verify = 1;
    $_SESSION['resetemail'] = $_GET['email'];
    $_SESSION['token'] = $token;
} else {
    $verify = 0;
}

$date = date('Y-m-d h:i:s');

if (strtotime($getbyemail['passresetdate']) > 0) {
    if ($getbyemail['passresetdate'] > $date) {

    } else {
        echo '<div class="alert alert-info">' . TEXT_PASSWORD_FORGET_EXPIRES . '</div>';
        echo '<br /><a style="color: black" href="index.php">' . TEXT_GO_TO_STARTPAGEE . '</a>';
        return false;
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 centered">
            <form role="form" method="post" action="?page=passreset" id="form">
                <fieldset>
                    <legend><?= TEXT_NEW_PASSWORD ?></legend>

                    <div class="form-group">
                        <label for="name"><?= TEXT_NEW_PASSWORD ?></label>
                        <input type="password" name="password" placeholder="<?= TEXT_NEW_PASSWORD ?>" required
                               class="form-control"/>
                        <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="name"><?= TEXT_NEW_PASSWORD_REPEAT ?></label>
                        <input type="password" name="cpassword" placeholder="<?= TEXT_NEW_PASSWORD ?>" required
                               class="form-control"/>
                        <span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
                    </div>

                    <div class="form-group">
                        <input type="submit" name="newpassword" value="Aanpassen" class="btn btn-primary"/>
                    </div>
                </fieldset>
            </form>
            <span id="verify"></span>
            <span class="text-success"><?php if (isset($successmsg)) {
                    echo $successmsg;
                } ?></span>
            <span class="text-danger"><?php if (isset($errormsg)) {
                    echo $errormsg;
                } ?></span>
        </div>
    </div>
</div>

<script>
    $("#form").submit(function (event) {
        if ( <?= $verify ?> == 1
        )
        {
            return true;
        }

        $("#verify").text("Er is iets misgegaan!").show().fadeOut(5000);
        event.preventDefault();
    });
</script>
