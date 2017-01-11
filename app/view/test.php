<html>
<head>
    <script type="text/javascript" src="js/jquery.form.js"></script>
    <script>
        $(document).ready(function()
        {
            $('form').ajaxForm(function()
            {
                alert("Uploaded SuccessFully");
            });
        });

        function preview_image()
        {
            var total_file=document.getElementById("upload_file").files.length;
            for(var i=0;i<total_file;i++)
            {
                $('#image_preview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"' width='auto' height='200px'>");
            }
        }
    </script>
</head>
<body>
<div id="wrapper">
    <form action="?page=lala" method="post" enctype="multipart/form-data">
        <input type="file" id="upload_file" name="myFile[]" onchange="preview_image();" multiple/>
        <input type="submit" name='submit_image' value="Upload Image"/>
    </form>
    <div id="image_preview"></div>
</div>
</body>
</html>