<?php
#FOOTER
?>
</div>
</body>

<div id="footer">

    <script>
        var autoSizeText;

        autoSizeText = function () {
            var el, elements, i, len, results;
            elements = $('#LoggedInAs');
            console.log(elements);
            if (elements.length < 0) {
                return;
            }
            results = [];
            for (i = 0, len = elements.length; i < len; i++) {
                el = elements[i];
                results.push((function (el) {
                    var resizeText, results1;
                    resizeText = function () {
                        var elNewFontSize;
                        elNewFontSize = (parseInt($(el).css('font-size').slice(0, -2)) - 1) + 'px';
                        return $(el).css('font-size', elNewFontSize);
                    };
                    results1 = [];
                    while (el.scrollHeight > el.offsetHeight) {
                        results1.push(resizeText());
                    }
                    return results1;
                })(el));
            }
            return results;
        };

        $(document).ready(function () {
            return autoSizeText();
        });
    </script>

    <script type="text/javascript">

        //alert(window.navigator.language);
        $(document).ready(function () {

            var urllang = window.location.href;
            if (urllang.indexOf('login') >= 0) {
                if (urllang.indexOf('lang') >= 0) {
                    // Found world
                }
                else {
                    var url = window.location.href,
                        separator = (url.indexOf("?") === -1) ? "?" : "&",
                        newParam = separator + "lang=" + window.navigator.language;

                    newUrl = url.replace(newParam, "");
                    newUrl += newParam;
                    window.location.href = newUrl;
                }
            }
        });

        jQuery(document).ready(function () {
            jQuery("#password").keyup(function () {
                passwordStrength(jQuery(this).val());
            });
        });

        function passwordStrength(password) {

            var desc = [{'width': '0px'}, {'width': '20%'}, {'width': '40%'}, {'width': '60%'}, {'width': '80%'}, {'width': '100%'}];

            var descClass = ['', 'progress-bar-danger', 'progress-bar-danger', 'progress-bar-warning', 'progress-bar-success', 'progress-bar-success'];

            var score = 0;

            //if password bigger than 6 give 1 point
            if (password.length > 6) score++;

            //if password has both lower and uppercase characters give 1 point
            if ((password.match(/[a-z]/)) && (password.match(/[A-Z]/))) score++;

            //if password has at least one number give 1 point
            if (password.match(/\d+/)) score++;

            //if password has at least one special caracther give 1 point
            if (password.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) score++;

            //if password bigger than 12 give another 1 point
            if (password.length > 10) score++;

            // display indicator
            $("#jak_pstrength").removeClass(descClass[score - 1]).addClass(descClass[score]).css(desc[score]);
        }
    </script>

    <script>
        $(function () {
            $("#datepicker").datepicker({
                showOtherMonths: true,
                selectOtherMonths: true,
                minDate: 0,
                dateFormat: "dd-mm-yy"
            });
        });
    </script>

    <script>
        if ($('#myChart').length) {
            $.getScript('js/Chart.js', function () {

                if ( <?=round($_SESSION['geweigerd_percent']) ?> !==
                0.0 || <?= round($_SESSION['geaccepteerd_percent'])?> !== 0.0
                )
                {
                    var data = [{
                        label: "Geweigerd",
                        value: <?= round($_SESSION['geweigerd_percent']) ?>,
                        color: "#dd2c4c"
                    }, {
                        label: "Goedgekeurd",
                        value: <?= round($_SESSION['geaccepteerd_percent']) ?>,
                        color: "#5c1863"
                    }
                    ];
                }
                else
                {
                    var data = [
                        {
                            label: "Geen proeven",
                            value: 1,
                            color: "#696969"
                        }
                    ];
                }

                var options = {
                    animateRotate: true
                };

                //Get the context of the canvas element we want to select
                var c = $('#myChart');
                var ct = c.get(0).getContext('2d');
                var ctx = document.getElementById("myChart").getContext("2d");
                /*************************************************************************/
                myNewChart = new Chart(ct).Doughnut(data, options);

            })
        }
    </script>

    <script>
        jQuery(document).ready(function () {
            jQuery('.skillbar').each(function () {
                jQuery(this).find('.skillbar-bar').animate({
                    width: jQuery(this).attr('data-percent')
                }, 2000);
            });
        });
    </script>

    <script>
        $(document).ready(function () {
        });

        if ($('#ProcAcc').length) {
            $.getScript('js/Chart.js', function () {

                var data = [{
                    label: "Davy",
                    value: 40,
                    color: "#b20a30"
                }, {
                    label: "Alexander",
                    value: 20,
                    color: "#dd2c4c"
                },
                    {
                        label: "Dylan",
                        value: 20,
                        color: "#5c1863"
                    },
                    {
                        label: "Marc",
                        value: 30,
                        color: "#822b8b"
                    },
                ]

                var options = {
                    animateScale: true
                };

                //Get the context of the canvas element we want to select
                var c = $('#ProcAcc');
                var ct = c.get(0).getContext('2d');
                var ctx = document.getElementById("ProcAcc").getContext("2d");
                /*************************************************************************/
                ProcAcc = new Chart(ct).Doughnut(data, options);

            })
        }
    </script>

    <script>
        $('.counter').each(function () {
            var $this = $(this),
                countTo = $this.attr('data-count');

            $({countNum: $this.text()}).animate({
                    countNum: countTo
                },

                {

                    duration: 2000,
                    easing: 'linear',
                    step: function () {
                        $this.text(Math.floor(this.countNum));
                    },
                    complete: function () {
                        $this.text(this.countNum);
                        //alert('finished');
                    }

                });


        });
    </script>

    <script>
        var vote;
        $("#AccButton, #AccButton1,#AccButton2").click(function (event) {
            vote = $(this).val();
        });

        $("form#mybuttons").submit(function (event) {
            //$form = $(this);
            var imgid = $(this).children('input#ImageID').val();
            var refs = $(this).children('input#refreshcount').val();
            var ref = '#' + 'refresh' + refs;

            var dataString = $('form#mybuttons').serialize() + '&img=' + imgid + '&vote=' + vote;

            $.ajax({
                type: "POST",
                url: "?page=imageverify",
                data: dataString,
                cache: false,
                success: function (result) {
                    $(ref).load("?page=approve " + ref);
                    $('#refsa').load("?page=approve #refsa");
                    $('#refsh').load("?page=approve #refsh");
                    $('#refer1').load("?page=approve #refer1");
                    $('#refer').load("?page=approve #refer");
                }
            });

            event.preventDefault();
        });
    </script>

    <script>
        $("form#createclient").submit(function (event) {

            var postForm = $('form#createclient').serialize(); //Fetch form information

            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "?page=clientmail",
                data: postForm,
                cache: false,
                success: function (result) {
                    //$('.popup').show().fadeOut(3200);

                    if (result.status == 'error') {
                        alert(result.message);
                        return false;
                    }
                    else {
                        var url = window.location.href;
                        if (url.indexOf('uploadoverview') >= 0) {
                            $('.demclients1').load('?page=uploadoverview .demclients1');

                            $('.demclients').load('?page=uploadoverview' + ' .demclients', function () {
                                //success load event
                                $("#allclients option:not([value])").remove();
                                $("#allclients").select2();
                            });

                            $(function () {
                                $('#myModal').modal('toggle');
                            });
                        }
                        else if (url.indexOf('newclient') >= 0) {
                            window.location = 'index.php?page=manageclients';
                        }
                        else {
                            window.location = 'index.php?page=manageusers';
                        }
                    }

                }
            });
            event.preventDefault();

        });
    </script>

    <script>
        var id;
        var itemid;
        $(".imgdownload").on('click', function (event) {
            id = $(this).attr('id');
            itemid = $(this).attr('class');
            itemid = itemid.replace('imgdownload', '');
            itemid = itemid.replace(' id', '');
        });

        $("form#downloadbuttons").on('submit', function (event) {

            var linkid = ' .' + id;

            var dataString = $('form#downloadbuttons').serialize() + '&id=' + id + '&vote=' + 1;

            $.ajax({
                type: "POST",
                url: "?page=setimagedownload",
                data: dataString,
                cache: false,
                success: function (result) {
                    $(linkid).load("?page=item&id=" + itemid + linkid);
                }
            });

            event.preventDefault();
        });
    </script>

    <div id="selfer">
        <div id="self">
            <script>
                var filter;
                var filtername;
                var filtersort;


                $("#filterbutton, #filterbutton1").click(function (event) {
                    filter = $(this).attr("name");
                    alert(filter);

                    filter = (filter.split("-"));
                    filtername = filter[0];
                    filtersort = filter[1];
                });


                $("form#filtertable").submit(function (event) {
                    event.preventDefault();

                    var dataString = $('form#filtertable').serialize() + '&filter=' + filtersort + '&table=' + filtername;
                    alert(dataString);

                    $.ajax({
                        type: "POST",
                        url: "?page=filter",
                        data: dataString,
                        cache: false,
                        success: function (result) {
                            //$(ref).load("?page=approve " + ref);
                            $('.row').load("?page=manageusers .col-lg-12");
                            $('#filterrefresh').load("?page=manageusers #filterrefresh");
                            $('.pagination').load("?page=manageusers .pagination");
                            //$('#selfer').load("?page=footer #self");
                        }
                    });

                });


                /* Coole functie?
                 $( "#cart" ).on( "mouseenter mouseleave", function( event ) {
                 $( this ).toggleClass( "active" );
                 }); */
            </script>
        </div>
    </div>

    <script>
        var vote;
        $("#filterbutton").click(function (event) {
            vote = $(this).val();
        });

        $("form#filterz").submit(function (event) {
            //$form = $(this);
            var imgid = $(this).children('input#ImageID').val();
            var refs = $(this).children('input#refreshcount').val();
            var ref = '#' + 'refresh' + refs;

            var dataString = $('form#mybuttons').serialize() + '&img=' + imgid + '&vote=' + vote;

            $.ajax({
                type: "POST",
                url: "?page=imageverify",
                data: dataString,
                cache: false,
                success: function (result) {
                    $(ref).load("?page=approve " + ref);
                    $('#refsh').load("?page=approve #refsh");
                    $('#refsa').load("?page=approve #refsa");
                }
            });

            event.preventDefault();
        });
    </script>

    <script>
        if ($('#file-upload').length) {
            function handleFileSelect(evt) {
                var files = evt.target.files; // FileList object

                // files is a FileList of File objects. List some properties.
                var output = [];
                for (var i = 0, f; f = files[i]; i++) {

                    output.push('<li><strong>', escape(f.name), '</strong> (', f.type || 'n/a', ') - ',
                        f.size, ' bytes, last modified: ',
                        f.lastModifiedDate ? f.lastModifiedDate.toLocaleDateString() : 'n/a',
                        '</li>');
                }
                document.getElementById('list').innerHTML = '<ul>' + output.join('') + '</ul>';
            }

            document.getElementById('file-upload').addEventListener('change', handleFileSelect, false);
        }

        if ($('#file-upload1').length) {
            function handleFileSelect1(evt) {
                var files = evt.target.files; // FileList object

                // files is a FileList of File objects. List some properties.
                var output = [];
                for (var i = 0, f; f = files[i]; i++) {

                    output.push('<li><strong>', escape(f.name), '</strong> (', f.type || 'n/a', ') - ',
                        f.size, ' bytes, last modified: ',
                        f.lastModifiedDate ? f.lastModifiedDate.toLocaleDateString() : 'n/a',
                        '</li>');
                }
                document.getElementById('list1').innerHTML = '<ul>' + output.join('') + '</ul>';
            }

            document.getElementById('file-upload1').addEventListener('change', handleFileSelect1, false);
        }

    </script>

    <script>

        $(function () {
            $(".imgInp").change(function () {
                if (typeof (FileReader) != "undefined") {
                    var dvPreview = $("#fileList");
                    dvPreview.html("");
                    var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.pdf)$/;
                    $($(this)[0].files).each(function () {
                        var file = $(this);
                        if (regex.test(file[0].name.toLowerCase())) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                if (file[0].name.indexOf('.pdf') == -1) {
                                    var img = $("<img />");
                                    img.attr("style", "height:200px;width: auto");
                                    img.attr("src", e.target.result);
                                }
                                else {
                                    var img = $("<embed />");
                                    img.attr("style", "height:200px;width: auto");
                                    img.attr("src", e.target.result);
                                }
                                dvPreview.append(img);
                            }
                            reader.readAsDataURL(file[0]);
                        } else {
                            alert(file[0].name + " is not a valid image file.");
                            dvPreview.html("");
                            return false;
                        }
                    });
                } else {
                    alert("This browser does not support HTML5 FileReader.");
                }
            });
        });

        $(function () {
            $(".imgInp1").change(function () {
                if (typeof (FileReader) != "undefined") {
                    var dvPreview = $("#fileList1");
                    dvPreview.html("");
                    var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.pdf)$/;
                    $($(this)[0].files).each(function () {
                        var file = $(this);
                        if (regex.test(file[0].name.toLowerCase())) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                if (file[0].name.indexOf('.pdf') == -1) {
                                    var img = $("<img />");
                                    img.attr("style", "height:200px;width: auto");
                                    img.attr("src", e.target.result);
                                }
                                else {
                                    var img = $("<embed />");
                                    img.attr("style", "height:200px;width: auto");
                                    img.attr("src", e.target.result);
                                }
                                dvPreview.append(img);
                            }
                            reader.readAsDataURL(file[0]);
                        } else {
                            alert(file[0].name + " is not a valid image file.");
                            dvPreview.html("");
                            return false;
                        }
                    });
                } else {
                    alert("This browser does not support HTML5 FileReader.");
                }
            });
        });

    </script>

    <script>
        $(document).ready(function () {
            //Initialize tooltips
            $('.nav-tabs > li a[title]').tooltip();

            //Wizard
            $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

                var $target = $(e.target);

                if ($target.parent().hasClass('disabled')) {
                    return false;
                }
            });

            $(".next-step").click(function (e) {

                var $active = $('.wizard .nav-tabs li.active');
                $active.next().removeClass('disabled');
                nextTab($active);
                window.scrollTo(0, 0);
            });
            $(".prev-step").click(function (e) {

                var $active = $('.wizard .nav-tabs li.active');
                prevTab($active);

            });
        });

        function nextTab(elem) {
            $(elem).next().find('a[data-toggle="tab"]').click();
        }
        function prevTab(elem) {
            $(elem).prev().find('a[data-toggle="tab"]').click();
        }
    </script>

    <script>
        function toggleInputError() {
            $(".error-input").css("border", "solid 1px #ccc");
        }
        $(window).load(function () {
            // Animate loader off screen
            $(".se-pre-con").fadeOut("slow");
            setTimeout(
                function () {
                    toggleInputError()
                }, 2000);
        });
    </script>

    <script>
        $(document).ready(function () {

            /*! Fades in page on load */
            $('body').css('display', 'none');
            $('body').fadeIn(200);

        });
    </script>
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

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
        $(document).ready(function () {

            // Text van input halen
            $(".suggestionsinput").click(function () {
                if ($(".suggestionsinput").val() == "Search") {
                    $(".suggestionsinput").val("");
                }
            })

            // Checken of de button ingedrukt is
            $(".suggestionsinput").keyup(function (event) {
                if ($(".suggestionsinput").val() != "") {
                    // make suggestions visible
                    $("#suggestions").css('visibility', 'visible');
                    $("#suggestions").hide();
                    $("#suggestions").fadeIn('slow');
                    $(".searchterm").text($(".suggestionsinput").val());
                    $("#suggestions").load('?page=uploadoverview #myclients');


                } else {
                    // Suggesties verbergen
                    $("#suggestions").fadeOut('slow', function () {
                        $("#suggestions").css('visibility', 'hidden');
                    });

                }
            })
        })
    </script>

    <!-- Script voor preview uploaden -->
    <script>
        var loadFile = function (event) {
            oldimg = $('.preview').attr('src');
            var preview = document.getElementById('preview');
            preview.src = URL.createObjectURL(event.target.files[0]);
            newimg = preview.src;
            if (newimg.indexOf('/null') > -1) {
                preview.src = oldimg;
            }
        };

    </script>


    <!-- Menuscript -->
    <script>
        $("#menu-toggle").click(function (e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
            $("html").toggleClass("toggled");
        });
        $("#overviews-link").click(function (e) {
                e.preventDefault();
                $("#overview-dropdown").toggleClass("toggled")
            }
        );
        $("#create-link").click(function (e) {
                e.preventDefault();
                $("#create-dropdown").toggleClass("toggled")
            }
        );
    </script>
</div>
</html>

