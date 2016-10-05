<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 28-Sep-16
 */
?>
<html lang="nl">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="Madalco Klantenportaal">
    <meta name="author" content="Madalco Media">

    <title>Madalco Portal | Upload</title>

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Eigen CSS -->
    <link href="css/styles.css" rel="stylesheet">

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">
        google.load("jquery", "1.3.2");
    </script>
    <!--Sort table-->
    <script src="js/sorttable.js" type="text/javascript"></script>

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Eigen CSS -->
    <link href="css/styles.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


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
    </script>    <script type="text/javascript">
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

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

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

        $('.submit-button').on('click', function(event) {
            alert('This is a dummy submit button. It does nothing.');
            event.preventDefault();
        });
    </script>
</head>

<body>
<div id="header">
    <div id="MenuSide">
        <div id="MenuButton">
            <a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><img src="https://cdn4.iconfinder.com/data/icons/wirecons-free-vector-icons/32/menu-alt-20.png"></a>
        </div>
    </div>

    <div id="NameSide">
        <div id="UserPhoto">
        </div>
        <h3 id="LoggedInAs">Testadmin</h3>
        <a id="LogOut" href="#"><h6 id="LogOut">Uitloggen</h6></a>
    </div>
</div>

    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">

                <li class="nav-button-home">
                    <a href="index.php?page=dashboard">Home</a>
                </li>
                <li class="nav-button-upload">
                    <a href="index.php?page=phpmail">Upload</a>
                </li>
                <li class="nav-button-all">
                    <a href="index.php?page=overzicht">Overzicht</a>
                </li>
                <li class="nav-button-settings">
                    <a href="index.php?page=#">Instellingen</a>
                </li>
                <br>
                <li class="nav-button-logout">
                    <a href="#">Uitloggen</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->