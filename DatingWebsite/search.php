<!doctype html>

<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Search</title>
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

</head>

<body>

<?php

/*
 * THIS SEARCH PAGE ALLOWS TO AUTOMATIC UPDATE THE CHOICE FIELDS WHEN THE CORRESPONDING VALUES ARE UPDATED
 * IN THE DATABASE. THAT IS, FOR AGE, LOCATION AND INTEREST. IF THESE VALUES ARE CHANGED IN THE DB THEY WILL
 * ALSO BE CHANGED HERE.
 */



//start session
session_start();
// header('location:login.php');  // direct back to login page instead of showing message

//db connection
//require_once 'db_connection.php';

// credentials
$host = 'hive.csis.ul.ie';
$username = 'group07';
$password = '-zk_2@c!K)G{4Y/[';
$dbname = 'dbgroup07';

//db connection
$con = new mysqli($host, $username, $password,$dbname);

// Check connection
if ($con-> connect_error) {
die("Connection failed: " . $con->connect_error);
}
?>


<?php include "header.html" ?>


    <!-- bradcam_area  -->
    <div class="bradcam_bg_1 bradcam_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>DISCOVER YOUR DREAM MATCH</h3>
                    </div>
                </div>
            </div>
        </div>


    <!--/ bradcam_area  -->

    <!-- slider_area_start -->
    <!--page-wrapper p-t-130 p-b-100-->

    <div class=" p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">

                    <form action="result_list.php" method="POST" onsubmit="this.submit(); this.reset(); return false;">
                        <div class="row row-space">
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <label class="label">Username</label>
                                    <input class="input--style-4" type="text" name="username">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <label class="label">Keywords</label>
                                    <input class="input--style-4" type="text" name="keywords">
                                </div>
                            </div>
                        </div>


                        <div class="row row-space">
                            <div class="col-lg-4">

                                <div class="input-group">
                                    <label class="label">Age</label>
                                    <div class="p-t-10">
                                    <div class="row row-space">
                                        <div class="col-lg-6">
                                            <div class="input-group">

                                                <div class="rs-select2 js-select-simple select--no-search">
                                                    <select name="minAge">
                                                        <option disabled="disabled" selected="selected">From</option>
                                                        <?php
                                                        $query = "SELECT DISTINCT age_id FROM Age ORDER BY age_id ASC";
                                                        $result =$con->query($query);
                                                        while ($row = $result->fetch_assoc()) { ?>
                                                            <option><?php echo $row["age_id"]; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>

                                                    <div class="select-dropdown"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="input-group">
                                                <!-- <label class="label">Interests</label> -->
                                                <div class="rs-select2 js-select-simple select--no-search">
                                                    <select name="maxAge">
                                                        <option disabled="disabled" selected="selected">To</option>
                                                        <?php
                                                        $query = "SELECT DISTINCT age_id FROM Age ORDER BY age_id ASC";
                                                        $result =$con->query($query);
                                                        while ($row = $result->fetch_assoc()) { ?>
                                                            <option><?php echo $row["age_id"]; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="select-dropdown"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="input-group">
                                    <label class="label">Gender</label>
                                    <div class="p-t-10">
                                        <label class="radio-container m-r-45">Male
                                            <input type="radio"  name="gender" value="m">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio-container">Female
                                            <input type="radio"  name="gender" value="f">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="input-group">
                                    <label class="label">Photos</label>
                                    <div class="p-t-10">
                                        <label class="radio-container m-r-45">Yes
                                            <input type="radio" checked="checked" name="photos" value="y">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio-container">No
                                            <input type="radio" name="photos" value="n">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-lg-6">
                              <div class="input-group">
                                <!--<label class="label">Location</label> -->

                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="location">
                                            <option disabled="disabled" selected="selected">Location</option>
                                            <?php
                                            $query = "SELECT DISTINCT location FROM Location ORDER BY Location ASC";
                                            $result =$con->query($query);
                                            while ($row = $result->fetch_assoc()) { ?>
                                            <option><?php echo $row["location"]; ?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>

                              </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="input-group">
                                    <!-- <label class="label">Interests</label> -->
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="interest">
                                            <option disabled="disabled" selected="selected">Interests</option>
                                            <?php
                                            $query = "SELECT DISTINCT interest_name FROM Interest_Labels ORDER BY interest_name ASC";
                                            $result =$con->query($query);
                                            while ($row = $result->fetch_assoc()) { ?>
                                                <option><?php echo $row["interest_name"]; ?></option>
                                                <?php
                                                }
                                            ?>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-t-15">
                            <button class="btn btn--radius-2 btn--magenta" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <?php $con->close(); ?>


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
    <!-- <script src="js/gijgo.min.js"></script> -->
    <script src="js/range.js"></script>



    <!--contact js-->
    <script src="js/contact.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/mail-script.js"></script>


    <script src="js/main.js"></script>



    <!-- Jquery JS-->
   <!-- <script src="vendor/jquery/jquery.min.js"></script> -->

    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

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
