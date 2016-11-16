<?php
#PAGE VOOR EEN NIEUW WACHTWOORD OP TE GEVEN

$user = new UserController();
$session = new Session();

if(isset($_GET['token'])) {
    $token = $_GET['token'];
    $token = $session->clean($token);
}
else {
    echo 'Sessie wachtwoord vergeten is verlopen';
    return false;
}

$getbyemail = $user->getUserByEmail($_GET['email']);
if($getbyemail !== null) {
    $verify = 1;
    $_SESSION['resetemail'] = $_GET['email'];
    $_SESSION['token'] = $token;
}
else {
    $verify = 0;
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 centered">
            <form role="form" method="post" action="?page=passreset" id="form">
                <fieldset>
                    <legend>Wachtwoord vergeten</legend>

                    <div class="form-group">
                        <label for="name">Nieuw wachtwoord</label>
                        <input type="password" name="password" placeholder="Wachtwoord" required class="form-control" />
                        <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="name">Herhalen nieuw wachtwoord</label>
                        <input type="password" name="cpassword" placeholder="Nieuw wachtwoord" required class="form-control" />
                        <span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
                    </div>

                    <div class="form-group">
                        <input type="submit" name="newpassword" value="Aanpassen" class="btn btn-primary" />
                    </div>
                </fieldset>
            </form>
            <span id="verify"></span>
            <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
            <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
        </div>
    </div>
</div>

<script>
    $( "#form" ).submit(function( event ) {
        if ( <?= $verify ?> == 1) {
            // $( "#verify" ).text( "Uw wachtwoord wordt veranderd!" ).show();
            return true;
        }

        $( "#verify" ).text( "Er is iets misgegaan!" ).show().fadeOut( 5000 );
        event.preventDefault();
    });
</script>