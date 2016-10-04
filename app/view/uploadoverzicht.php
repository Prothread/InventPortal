<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 29-Sep-16
 * Time: 12:47
 */
?>
<!--
<form action="?page=uploading" method="post" enctype="multipart/form-data">
    Select an image to upload
    <input type="file" name="fileToUpload" id="fileToUpload" multiple="multiple">
    <input type="submit" value="Upload image" name="submit">
</form>
-->
<!doctype html>
<html>
<head>
    <title>Test</title>
</head>
<body>
<form action="?page=uploading" method="post" enctype="multipart/form-data">
    <input type="file" name="myFile[]" id="myFile" multiple>
    <input type="submit" value="Upload image" name="submit">
</form>
</body>
</html>