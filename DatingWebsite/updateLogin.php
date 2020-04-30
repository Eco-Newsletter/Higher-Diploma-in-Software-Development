<!--
//Administrator - PASSWORD UPDATE
!-->

<?php

//db connection
include 'db_connection.php';

session_start();
// variable for validation error message
$message = '';
// if user is already logged in, cannot access register page
//if (isset($_SESSION['user_id'])) {
//    header('location:home.php');
//}
// validate form data for registration
if (isset($_POST["register"])) {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    // check if username is already taken or not
    $check_query = "SELECT * FROM User_  WHERE username = :username";
    // make query for execution
    $statement = $connect->prepare($check_query);
    $check_data = array(
        ':username'  => $username
    );
    // execute query (check if username already in database)
    if ($statement->execute($check_data)) {
        // if username found
        if ($statement->rowCount() > 0) {
            //$message .= '<p><label>Username already taken</label></p>';

            // if username was left empty
            if (empty($username)) {
                $message .= '<p><label>Username is required</label></p>';
            }
            // if password was left empty
            if (empty($password)) {
                $message .= '<p><label>Password is required</label></p>';
            } else {
                // if password different than confirm password
                if ($password != $_POST['confirm_password']) {
                    $message .= '<p><label>Password not match</label></p>';
                }
            }
            // if no error occured (and saved in in $message)
            if ($message == '') {
                $data = array(
                    ':username'  => $username,
                    //convert password to has string format
                    ':password'  => password_hash($password, PASSWORD_DEFAULT)
                );
                // sql insert query
                $query = "UPDATE User_ SET password =:password WHERE  username= :username;";
                $statement = $connect->prepare($query);
                if ($statement->execute($data)) {
                    $message = "<label>Password changes Completed</label>";
					session_destroy();
                    header('location:login.php');
                }

            }
        }
		else $message .= '<p><label>Username not correct</label></p>';
    }
}

?>


<!doctype html>
<html class="no-js" lang="zxx">

<head>


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
    .card-2 {
        -webkit-box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
        -moz-box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
        box-shadow: 10px 18px 50px 0px rgba(0, 0, 0, 0.15);
        -webkit-border-radius: 20px;
        -moz-border-radius: 10px;
        border-radius: 15px;
        width: 90%;
        display: table;
        background: rgba(161, 57, 158, 0.75);
        margin-left: auto;
        margin-top: 100px;
        margin-bottom: 100px;
    }

    .panel-body{

        padding: 50px;
        background: white;
        border-radius: 15px;
    }


    ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
        color: saddlebrown;
        opacity: 1; /* Firefox */
        font-size: 18px;
    }


</style>



</head>

<body>
<div  class="card-3 bg-gra-02 p-t-180 p-b-100" style="margin-left: -50px">
    <div class= "container">
        <br />
        <!--center table on webpage-->
        <div class="card-2">
            <div >
                <div class="panel-body">
                    <form method="post">
                        <span class="text-danger"><?php echo $message; ?></span>
                        <div class="form-group">
                            <!--enter user details-->
                            <label>Enter Username</label>
                            <input type="text" name="username" class="form-control" />
                        </div>
                        <div class="form-group">
                            <!--enter user details-->
                            <label>Enter New Password</label>
                            <input type="password" name="password" class="form-control" />
                        </div>
                        <div class="form-group">
                            <!--enter user details-->
                            <label>Re-enter New Password</label>
                            <input type="password" name="confirm_password" class="form-control" />
                        </div>
                        <div class="form-group" style="margin-top: 50px;background:mediumorchid;">
                            <!--to submit registration details-->
                            <input type="submit" name="register" class="btn" value="Submit" />
                        </div>
                    </form>
                </div>
            </div>
        </div>





















    </div>
</div>

    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
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


    <!-- bradcam_area
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
						<h3>DISCOVER YOUR DREAM MATCH</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    < bradcam_area  -->

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


    <script src="js/main.js"></script>


</body>

</html>
