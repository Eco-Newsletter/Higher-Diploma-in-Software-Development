<?php
ob_start();
session_start();
// if not logged in, redirects to login.php to login
if (!isset($_SESSION['user_id'])) {
    header('login.php');
}
?>


<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Match Maker</title>
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
	
	<style>
    .title{
        max-width: 100%;
        padding: 0px;
        margin: 0px;
        font-family:Bahnschrift Light;

        letter-spacing: 2px;
    }
    .subtitle{
        max-width: 100%;
        padding-bottom: 100px;
        margin: 0px;
        font-family:Bahnschrift Light;
        font-size: 16px;
        letter-spacing:;
        color:wheat;
    }

</style>
	
</head>

<body>


<?php include "header.html" ?>


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
  $queryNewUser = "SELECT username, age_id FROM `Personal_Data` JOIN User_ USING(username)  
                  WHERE user_id={$_SESSION['user_id']} AND age_id IS NOT NULL;";

//echo $queryNewUser;

$num_rows = $con->query($queryNewUser)->num_rows;


if($num_rows>0){
    header('location:recommendation.php');
}
?>

    <!-- slider_area_start -->

    <div class="slider_area">
        <div class="single_slider  d-flex align-items-center slider_bg_1" style="padding-top: 150px; ">
            <div class="container">
                <div class="row align-items-center" >
                    <div class="col-lg-7 col-md-6">
                        <div class="slider_text" >
                            <div class="title">
                                <h3 >Welcome <br><?php echo $_SESSION['username']; ?>
                                <br>Discover Your Dream Match</h3>
                            </div>
                            <div class="subtitle" > Please if you haven't complete your profile and edit
                                your preferences, do it to have maximum enjoyment of this website! <br><br>
                                <button type="button" class="btn btn-success" ><a href="edit_profile1.php">Continue</a></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider_area_end -->


    <?php include "footer.html" ?>



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
    <script src="js/gijgo.min.js"></script>



    <!--contact js-->
    <script src="js/contact.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/mail-script.js"></script>


    <script src="js/main.js"></script>

			<!-- JS confirm popup window for logout-->
		<script>
			function confirmLogout() {
				if (confirm('Sure to log out?')) {
						location='logout.php';
				} else {
						location='welcome.php';
				}
			}
		</script>



</body>

</html>
