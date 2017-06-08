<?php
/**
 * Created by PhpStorm.
 * User: freek
 * Date: 22-3-2017
 * Time: 16:37
 */

$type = 'tender';

include '../app/view/addItemSetup.php';

?>
<div class="crm-content-wrapper">
    <div class="add-left-content add-content">
        <h1 class="crm-content-header"><?= TEXT_TENDER_CREATE ?></h1>
        <form class="crm-add" action="#" method="post" id="tenderCreate">
            <div>
                <label><?= TABLE_TITLE ?></label>
                <input type="text" name="subject" class="form-control <?php if (isset($tender_subject_error)) {
                    echo "error-input";
                } ?>"
                       value="<?php if (isset($_POST['subject'])) {
                           echo $_POST['subject'];
                       } ?>">
            </div>
            <div>
                <label><?= TEXT_ASSIGNFOR ?></label>
                <select class="form-control <?php if (isset($tender_client_error)) {
                    echo "error-input";
                } ?>" name="client">
                    <option value="0"><?= TEXT_ASSIGNFOR ?></option>
                    <?php
                    foreach ($clients as $client) {
                        echo '<option value="' . $client['id'] . '"';
                        if (isset($_POST['create']) && $client['id'] == $_POST['client']) {
                            echo 'selected';
                        }
                        echo '>' . $client['naam'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div>
                <label><?= TEXT_EMPLOYEE ?></label>
                <select class="form-control <?php if (isset($tender_user_error)) {
                    echo "error-input";
                } ?>" name="userId">
                    <option value="0"><?= TEXT_EMPLOYEE ?></option>
                    <?php
                    foreach ($users as $user) {
                        echo '<option value="' . $user['id'] . '"';
                        if (isset($_POST['create']) && $user['id'] == $_POST['userId']) {
                            echo 'selected';
                        }
                        echo '>' . $user['naam'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div>
                <label><?= TEXT_VALIDITY_DURATION ?></label>
                <input type="number" class="form-control <?php if (isset($tender_validity_error)) {
                    echo "error-input";
                } ?>" name="validity" min="1" value="<?php if (isset($_POST['validity'])) {
                    echo $_POST['validity'];
                } ?>">
            </div>
            <div>
                <label><?= TEXT_VALUE ?></label>
                <input type="number" class="form-control <?php if (isset($tender_value_error)) {
                    echo "error-input";
                } ?>" name="value" value="<?php if (isset($_POST['value'])) {
                    echo $_POST['value'];
                } ?>">
            </div>
            <div>
                <label><?= TEXT_CHANCE ?></label>
                <input type="number" class="form-control <?php if (isset($tender_chance_error)) {
                    echo "error-input";
                } ?>" name="chance" max="100"
                       value="<?php if (isset($_POST['chance'])) {
                           echo $_POST['chance'];
                       } ?>">
            </div>
            <div>
                <label><?= TEXT_CREATION_DATE ?></label>
                <input type="date" class="form-control <?php if (isset($tender_creationDate_error)) {
                    echo "error-input";
                } ?>" name="creationDate"
                       value="<?php if (isset($_POST['creationDate'])) {
                           echo $_POST['creationDate'];
                       } else {
                           echo date("Y-m-d");
                       } ?>" max="<?= date("Y-m-d") ?>">
            </div>
            <div class="description-holder">
                <label><?= TEXT_DESCRIPTION ?></label>
                <textarea name="description" class="<?php if (isset($tender_description_error)) {
                    echo "error-input";
                } ?>"><?php if (isset($_POST['description'])) {
                        echo $_POST['description'];
                    } ?></textarea>
            </div>

            <!--            Bestanden uploaden moet nog toegevoegd worden-->

            <div class="button-holder">
                <div class="button-push"></div>
                <button type="submit" name="create" class="custom-file-upload" onclick="getTasks()" id="addSubmit"><?= TEXT_CREATE_DROPDOWN ?></button>
            </div>
            <input type="hidden" name="defaultTasks" id="defaultTasks">
        </form>
    </div>
    <div class="add-right-content add-content">
        <h1 class="crm-content-header"><?= TEXT_ADD_TASKS ?></h1>
        <div class="crm-add">
            <div>
                <label><?= TEXT_TEMPLATE ?></label>
                <select id="templatelist">
                    <option value=0 selected> -</option>
                    <?php foreach ($templates as $template) { ?>
                        <option value="<?= $template['id'] ?>"> <?= $template['subject'] ?> </option>
                    <?php } ?>
                </select>
            </div>
            <div>
                <label><?= TEXT_TASK_ADD ?></label>
                <select id="tasklist">
                    <option value=0 selected> -</option>
                    <?php foreach ($defaultTask as $task) { ?>
                        <option value="<?= $task['id'] ?>"> <?= $task['subject'] ?> </option>
                    <?php } ?>
                </select>
            </div>
            <div>
                <label><?= TEXT_TASK_OVERVIEW ?></label>
                <div id="taken-lijst">
                    <ul id="sortable">

                    </ul>
                </div>
            </div>
        </div>
        <div id="submitSpace"></div>
        <label for="addSubmit" class="custom-file-upload" id="hiddenSubmit"><?= TEXT_CREATE_DROPDOWN ?></label>
    </div>
</div>


    <script>
        var postForm = [];
        var Files = [];

        Dropzone.options.mydropzone = {
            addRemoveLinks: true,
            autoProcessQueue: false, // this is important as you dont want form to be submitted unless you have clicked the submit button
            autoDiscover: false,
            paramName: 'file', // this is optional Like this one will get accessed in php by writing $_FILE['pic'] // if you dont specify it then bydefault it taked 'file' as paramName eg: $_FILE['file']
            previewsContainer: '#dropzonePreview', // we specify on which div id we must show the files
            maxFilesize: 15, // MB
            acceptedFiles: "application/docx, application/pdf",
            accept: function (file, done) {
                done();
            },
            error: function (file, msg) {
            },
            init: function () {

                this.on("queuecomplete", function () {
                    if (true == processing) {
                        this.options.autoProcessQueue = false;
                        postForm += (Files.join(", "));
                        $.ajax({
                            type: "POST",
                            url: "?page=uploadForm",
                            data: postForm,
                            cache: false,
//                            success: function (result) {
//                                window.location.href = 'index.php?page=overview';
//                            }
                        });
                        event.preventDefault();
                    }
                });

                this.on("processing", function () {
                    this.options.autoProcessQueue = true;

                    processing = true;
                });

                this.on("error", function (file, message) {
                    alert(message);
                    this.removeFile(file);
                });

                var myDropzone = this;

                //now we will submit the form when the button is clicked
                $("#sbmtbtn").on('click', function (e) {
                    e.preventDefault();
                    myDropzone.processQueue(); // this will submit your form to the specified action path
                    postForm = $('form#tenderCreate').serialize() + '&files=';
                });

            }, // init end

            success: function (file, response) {
                Files.push(response);
            }

        };

    </script>





<?php
include '../app/view/taskListScript.php';