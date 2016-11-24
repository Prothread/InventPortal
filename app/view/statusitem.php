<?php 

if($user->getPermission($permgroup, 'CAN_SHOW_OVERZICHT') == 1){

}
else {
    header('Location: index.php');
    Session::flash('error', 'U heeft hier geen rechten voor.');
}

$session = new Session();
$status = new StatusController();
$user = new UserController();

if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $id = $session->cleantonumber($id);
}
else {
  return 'Er is geen item gevonden';
}

$fetchall = $status->getItemById($id);
$users = $user->getAllUsersByPerm(1);
?>
<table style="width:100%">
            <br/>
            <tr>
              <th align="left" style="font-weight: normal;"><p class="NameText">Item bewerken</p></th>
              <th style="text-align: right;"><a href="?page=statusportal"><div id="NewClientButton" style="background-color: #dd2c4c;" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Terug</div></a>
              </th>
            </tr>
            </table>
                <hr size="1">

    <form action="?page=updatestatusitem" method="post" enctype="multipart/form-data" class="form-horizontal">
          <fieldset>

              <br />
              <br />
              <input value="<?= $fetchall['id'] ?>" type="hidden" name="id">

              <div class="form-group">
                  <label class="col-md-4 control-label" for="textinput">Onderwerp</label>
                  <div class="col-md-4">
                      <input class="form-control input-md" maxlength="40" value="<?= $fetchall['subject'] ?>" id="textinput" type="text" name="onderwerp" placeholder="Onderwerp">
                  </div>
              </div>


              <div class="form-group">
                  <label class="col-md-4 control-label" for="textinput">Persoon</label>
                  <div class="col-md-4">
                      <?php if($users !== null || !empty($users)) { ?>
                    <select class="form-control" name="name">

                      <?php foreach($users as $user) { ?> 
                        <?php if( $fetchall['person'] == $user['id']) { ?>
                          <option selected="selected" required class="form-control input-md" value="<?= $user['id']?>"><?= $user['naam'] ?></option> 
                        <?php } else {?>                    
                          <option required class="form-control input-md" value="<?= $user['id']?>"><?= $user['naam'] ?></option>
                        <?php } ?>
                      <?php } ?>

                    </select>
                    <?php } ?>
                  </div>
              </div>


              <div class="form-group">
                  <label class="col-md-4 control-label" for="textinput">Deadline</label>
                  <div class="col-md-4">
                      <input class="form-control input-md" id="textinput" type="date" value="<?= date("d-m-Y", strtotime($fetchall['deadline'])); ?>" name="deadline" size="50" placeholder="Deadline opdracht">
                  </div>
              </div>

              <div class="form-group">
                  <label class="col-md-4 control-label" for="textinput">Opmerking</label>
                  <div class="col-md-4">
                      <textarea class="form-control input-md" id="textinput" type="text" name="comment" value="<?= $fetchall['comment'] ?>" placeholder="Opmerking"><?= $fetchall['comment'] ?></textarea>
                  </div>
              </div>

              <div class="form-group">
                  <label class="col-md-4 control-label" for="textinput">Categorie</label>

                  <div class="col-md-4">
                    <select class="form-control" name="category" value="<?= $fetchall['category'] ?>" selected="selected">
                    <?php if($fetchall['category'] == 'Lead') {?>
                      <option selected="selected">Lead</option>
                    <?php } else { ?>
                        <option>Lead</option>
                    <?php } ?>

                    <?php if($fetchall['category'] == 'Offerte') {?>
                      <option selected="selected">Offerte</option>
                    <?php } else { ?>
                        <option>Offerte</option>
                    <?php } ?>

                    <?php if($fetchall['category'] == 'Project') {?>
                      <option selected="selected">Project</option>
                    <?php } else { ?>
                        <option>Project</option>
                    <?php } ?>

                    <?php if($fetchall['category'] == 'To-do') {?>
                      <option selected="selected">To-do</option>
                    <?php } else { ?>
                        <option>To-do</option>
                    <?php } ?>
                    </select>
                  </div>
              </div>

              <div class="form-group">
                  <label class="col-md-4 control-label" for="textinput"></label>
                  <div class="col-md-4">
                      <input class="btn btn-primary btn-success" name="submit"  style="float:left; max-width: 100px; background-color: #bb2c4c; border: 1px solid #dd2c4c" type="submit" value="Opslaan">
                  <a class="abutton centered" data-toggle="modal" data-target="#deleteModal" href="#">Verwijderen</a>                    
                  </div>

              </div>
          </fieldset>
      </form>



      <!-- Modal -->
<div class="modal fade" id="deleteModal" role="dialog">
<div class="modal-dialog">

  <!-- Modal content-->
  <div class="modal-content">
    <div style="text-align: center;" class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Item verwijderen</h4>
    </div>
    <div style="text-align: center;" class="modal-body">
      <br>
      <p> U staat op het punt om een <?= $fetchall['category'] ?> met de naam <?= $fetchall['subject'] ?> te verwijderen. <br/><br/>
      Weet u dit zeker?<br/><br/></p>
      <a class="abuttonmodal" href="?page=deletestatusitem&id=<?= $fetchall['id'] ?>">Verwijder</a>
<br/>
<br/>
    </div>
    <div class="modal-footer">

    </div>
  </div>

</div>
</div>