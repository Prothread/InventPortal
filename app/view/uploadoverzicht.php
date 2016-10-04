<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 29-Sep-16
 * Time: 12:47
 */
?>
<form action="?page=uploading" method="post" enctype="multipart/form-data">
    <input type="file" name="myFile[]" id="myFile" multiple>
    <input type="submit" value="Upload image" name="submit">
</form>