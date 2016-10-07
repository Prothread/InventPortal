<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 29-Sep-16
 * Time: 12:48
 */
?>
</div>

<script>
    function searchTable() {
        // Declare variables
        var input, filter, table, tbody, tr, td, i;
        input = document.getElementById("TableInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("overzicht");
        tbody = table.getElementsByTagName("tbody");
        tr = table.getElementsByTagName("tr");
        td = table.getElementsByTagName("td");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                    tr[0].style.display = "";
                }
            }
        }
    }
</script>
<script type="text/javascript">
    $(document).ready(function(){

        // Text van input halen
        $(".suggestionsinput").click(function(){
            if($(".suggestionsinput").val() == "Search")
            {
                $(".suggestionsinput").val("");
            }
        })

        // Checken of de button ingedrukt is
        $(".suggestionsinput").keyup(function(event){
            if($(".suggestionsinput").val() != "")
            {
                // make suggestions visible
                $("#suggestions").css('visibility', 'visible');
                $("#suggestions").hide();
                $("#suggestions").fadeIn('slow');
                $(".searchterm").text($(".suggestionsinput").val());
                // $("#suggestions").load('http://URL.to.load');

            } else {
                // Suggesties verbergen
                $("#suggestions").fadeOut('slow', function(){
                    $("#suggestions").css('visibility', 'hidden');
                });

            }
        })
    })
</script>

<!-- Script voor preview uploaden -->
<script>
    var loadFile = function(event) {
        oldimg = $('.preview').attr('src');
        var preview = document.getElementById('preview');
        preview.src = URL.createObjectURL(event.target.files[0]);
        newimg = preview.src;
        if(newimg.indexOf('/null') > -1) {
            preview.src = oldimg;
        }
    };
</script>

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap JS -->
<script src="js/bootstrap.min.js"></script>

<!-- Menuscript -->
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>

</body>
</html>

