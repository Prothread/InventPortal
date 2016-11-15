<?php
#PAGE FOR CREATING CLIENTS

if($user->getPermission($permgroup, 'CAN_CREATE_CLIENT') == 1){

}
else {
    header('Location: index.php');
    Session::flash('error', 'U heeft hier geen rechten voor.');
}
?>

<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 profile">
<div class="container">
    <p class="NameText">Profiel</p>
    <hr>

    <div class="row">
      <!-- left column -->
      <div class="col-md-3">
        <div class="text-center">
          <img src="https://s-media-cache-ak0.pinimg.com/originals/4b/cf/83/4bcf8321d96c3470cea9bdd84b6d577c.png" width="100px" height="100px;" class="avatar img-circle" alt="avatar">
          
          <input class="form-control" type="file">
        </div>
      </div>
      
      <!-- edit form column -->
      <div class="col-md-9 personal-info">
      <form class="form-horizontal" role="form">
          <div class="form-group">
            <label class="col-lg-3 control-label">Naam</label>
            <div class="col-lg-8">
              <input disabled class="form-control" value="Jeffrey" type="text">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Bedrijfsnaam:</label>
            <div class="col-lg-8">
              <input disabled class="form-control" value="Voorbeeldbedrijf" type="text">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Email:</label>
            <div class="col-lg-8">
              <input disabled class="form-control" value="valckxj@outlook.com" type="text">
            </div>
          </div>
                    <div class="form-group">
            <label class="col-lg-3 control-label">Adres:</label>
            <div class="col-lg-8">
              <input disabled class="form-control" value="Bossestraat 50A" type="text">
            </div>
          </div>
           <div class="form-group">
            <label class="col-lg-3 control-label">Postcode:</label>
            <div class="col-lg-8">
              <input disabled class="form-control" size="6" value="4581BG" type="text">
            </div>
          </div>
           <div class="form-group">
            <label class="col-lg-3 control-label">Plaats:</label>
            <div class="col-lg-8">
              <input disabled class="form-control" value="Vogelwaarde" type="text">
            </div>
          </div>
          <!--<div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <input disabled class="btn btn-primary" value="Opslaan" type="button">-->
              <span></span>
            </div>
          </div>
        </form>
      </div>
  </div>
</div>
<hr>



</div>
</div>
</fieldset>
</form>
</div>
</div>
</div>
</div>

