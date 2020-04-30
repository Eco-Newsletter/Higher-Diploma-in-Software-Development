<?php

$host = 'hive.csis.ul.ie';
$username = 'group07';
$password = '-zk_2@c!K)G{4Y/[';
$dbname = 'dbgroup07';

//db connection
$con = new mysqli($host, $username, $password,$dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}


$query = "SELECT location, COUNT(location) AS nloc FROM Personal_Data
				JOIN Location USING (`location_id`)
				JOIN Interest USING (`username`)
				JOIN Interest_Labels USING(`interest_id`)
				JOIN User_ USING(`username`) GROUP BY (location_id);";

$query1 = "SELECT age_id, COUNT(age_id) AS nage FROM Personal_Data
				JOIN Location USING (`location_id`)
				JOIN Interest USING (`username`)
				JOIN Interest_Labels USING(`interest_id`)
				JOIN User_ USING(`username`) GROUP BY (age_id);";

$query2 = "SELECT interest_name, COUNT(interest_id) AS inter FROM Personal_Data
				JOIN Location USING (`location_id`)
				JOIN Interest USING (`username`)
				JOIN Interest_Labels USING(`interest_id`)
				JOIN User_ USING(`username`) GROUP BY (interest_id);";

$query3 = "SELECT gender, COUNT(*) AS gr FROM Personal_Data
				JOIN Location USING (`location_id`)
				JOIN Interest USING (`username`)
				JOIN Interest_Labels USING(`interest_id`)
				JOIN User_ USING(`username`) GROUP BY (gender);";

?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Location', 'Number of Subscribers'],
                <?php
                $result =$con->query($query);
                while ($row = $result->fetch_assoc()) {
                    echo "['".$row['location']."'," .$row['nloc']."],"; }?>

            ]);

            var options = {
                title: 'Clients location',legend: {position: 'none'}, orientation: 'horizontal'

            };

            var chart = new google.visualization.BarChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }


        google.setOnLoadCallback(drawChart1);
        function drawChart1() {
            var data = google.visualization.arrayToDataTable([
                ['Interest', ''],
                <?php
                $result =$con->query($query2);
                while ($row = $result->fetch_assoc()) {
                    echo "['".$row['interest_name']."'," .$row['inter']."],"; }?>
            ]);

            var options = {
                title: 'Interest',
                legend: {position: 'none'}, orientation: 'vertical'
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div1'));
            chart.draw(data, options);
        }


        google.setOnLoadCallback(drawChart2);
        function drawChart2() {
            var data = google.visualization.arrayToDataTable([
                ['Age', ''],
                <?php
                $result =$con->query($query1);
                while ($row = $result->fetch_assoc()) {
                    echo "['".$row['age_id']."'," .$row['nage']."],"; }?>
            ]);

            var options = {
                title: 'Clients age',
                hAxis: {title: 'Years',  titleTextStyle: {color: '#333'}},
                vAxis: {minValue: 0},
                legend: {position: 'none'}
            };

            var chart = new google.visualization.AreaChart(document.getElementById('chart_div2'));
            chart.draw(data, options);
        }

        google.charts.setOnLoadCallback(drawChart3);

        function drawChart3() {

            var data = google.visualization.arrayToDataTable([
                ['Gender', 'Number of Subscribers'],
                <?php
                $result =$con->query($query3);
                while ($row = $result->fetch_assoc()) {
                    echo "['".$row['gender']."'," .$row['gr']."],"; }?>

            ]);

            var options = {
                title: 'Gender',is3D: true,sliceVisibilityThreshold: .2

            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart1'));

            chart.draw(data, options);
        }


    $(window).resize(function(){
            drawChart1();
            drawChart2();
        });

        // Reminder: you need to put https://www.google.com/jsapi in the head of your document or as an external resource on codepen //



    </script>




    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Administrator</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/gijgo.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/slicknav.css">

    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">




<style>


    .chart {
        width: 100%;
        min-height: 450px;
        margin-top: 50px;

    }


    .row {
        margin:0 !important;
    }

</style>




</head>

<body>

    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong>
browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <!-- header-start -->
    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid ">
                    <div class="header_bottom_border">
                        <div class="row align-items-center">
                            <div class="col-xl-3 col-lg-2">
                                <div class="logo">
                                    <!--<a href="#">-->
                                        <img src="img/matchmaker.jpeg" alt="">
                                    </a>
                                </div>
                            </div>
                            <div style="margin-left:0%  ; margin-right: 100px">
                                <div class="main-menu  d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="#"></a></li>
                                            <li><a href="admin.php">Main</a></li>
                                            <li><a href="#">Update <i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="updateLogin.php">Login Settings</a></li>
                                                    <li><a href="updateInterests.php">Interest </a></li>
                                                    <li><a href="stats.php">Statistics</a></li>
                                                </ul>
                                            </li>
                                            <li><a class="bottom" href="logout.php" onclick=confirmLogout() > Logout</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <!--div class="col-xl-3 col-lg-3 d-none d-lg-block">
                                <div class="Appointment">
                                    <div class="phone_num d-none d-xl-block">
                                        <a href="#">Log in</a>
                                    </div>
                                    <div class="d-none d-lg-block">
                                        <a class="boxed-btn3" href="#">Sign Up</a>
                                    </div>
                                </div>
                            </div -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->




    <div  class=" bg-gra-02" style="padding-top:240px; padding-bottom:70px; margin-left: -50px; ">

        <div class= "container" style="padding-left: 50px;">
            <h1 align="center" style="">Database situation as of</h1>
            <p align="center" style="color:white">Date/Time: <span id="datetime"></span></p>
            <div class="row" >

                <div class="col-md-6">
                    <div id="piechart" class="chart"></div>
                </div>

                <div class="col-md-6">
                    <div id="chart_div1" class="chart"></div>
                </div>
                <div class="col-md-6">
                    <div id="chart_div2" class="chart"></div>
                </div>

                <div class="col-md-6">
                    <div id="piechart1" class="chart"></div>
                </div>

            </div>
        </div>
    </div>








<!-- =======================================================================================-->




    <!-- job_listing_area_end  -->

    <!-- footer start -->
    <footer class="footer">
        <div class="footer_top">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-md-6 col-lg-3">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                            <div class="footer_logo">
                                <a href="#">
                                    <img src="img/matchmaker.jpeg" alt="">
                                </a>
                            </div>
                            <p>
                                finloan@support.com <br>
                                +10 873 672 6782 <br>
                                600/D, Green road, NewYork
                            </p>
                            <div class="socail_links">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <i class="ti-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-google-plus"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-lg-2">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1.1s" data-wow-delay=".4s">
                            <h3 class="footer_title">
                                Company
                            </h3>
                            <ul>
                                <li><a href="#">About </a></li>
                                <li><a href="#"> Pricing</a></li>
                                <li><a href="#">Carrier Tips</a></li>
                                <li><a href="#">FAQ</a></li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copy-right_text wow fadeInUp" data-wow-duration="1.4s" data-wow-delay=".3s">
            <div class="container">
                <div class="footer_border"></div>
                <div class="row">
                    <div class="col-xl-12">
                        <p class="copy_right text-center">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--/ footer end  -->

    <!-- link that opens popup -->
    <!-- JS here -->
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/ajax-form.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/scrollIt.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/nice-select.min.js"></script>
    <script src="js/jquery.slicknav.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/plugins.js"></script>
    <!-- <script src="js/gijgo.min.js"></script> -->
    <script src="js/range.js"></script>



    <!--contact js-->
    <script src="js/contact.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/mail-script.js"></script>


    <script src="js/main.js">


    </script>

    <script>
        var dt = new Date();
        document.getElementById("datetime").innerHTML = dt.toLocaleString();
    </script>


</body>

</html>
