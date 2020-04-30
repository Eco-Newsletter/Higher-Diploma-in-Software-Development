<?php
session_start();
// credentials
$host = 'hive.csis.ul.ie';
$username = 'group07';
$password = '-zk_2@c!K)G{4Y/[';
$dbname = 'dbgroup07';

//db connection
$con = new mysqli($host, $username, $password,$dbname);


// Check connection
if ($con ->connect_error) {
    die("Connection failed: ".$con->connect_error);
}

?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Recommendations</title>
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
    <link rel="stylesheet" href="css/gijgo.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/slicknav.css">

    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->

    <style>


        .itemid{
            border:none;
            background-color:white;
            font-size: 20px;
            margin-top: 10px;
            margin-bottom: -2px;
        }

        .bg-gra-02 {
            background: -webkit-gradient(linear, left bottom, right top, from(#fc2c77), to(#6c4079));
            background: -webkit-linear-gradient(bottom left, #fc2c77 0%, #6c4079 100%);
            background: -moz-linear-gradient(bottom left, #fc2c77 0%, #6c4079 100%);
            background: -o-linear-gradient(bottom left, #fc2c77 0%, #6c4079 100%);
            background: linear-gradient(to top right, #fc2c77 0%, #6c4079 100%);
        }


    </style>


</head>

<body>


<?php include "header.html" ?>


    <!-- bradcam_area  -->
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>Recommendations</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ bradcam_area  -->


    <?php

    $name= $_SESSION['username'];

    $queryPref = "SELECT * FROM `Preferences` WHERE username= '$name';";

    $resultPref =$con->query($queryPref);
    $res=$resultPref->fetch_assoc();

    $query1 = "SELECT DISTINCT username,location,age_id  FROM Personal_Data pd
                JOIN Location USING (`location_id`)
                JOIN Interest USING (`username`)
                JOIN Interest_Labels USING(`interest_id`)
                JOIN User_ USING(`username`)
                WHERE gender = '{$res["gender_pref"]}'
                AND age_id < {$res["age_id_to"]}
                AND age_id > {$res["age_id_from"]}
                ";

    $localQuery =" AND location_id = '{$res["location_pref_id"]}'";

    $result =$con->query($query1);
	if($result->num_rows == 0){
 header('location:edit_profile1.php');
}

if ($result->num_rows > 0) {
  // output data of each row

// NOTE IF YOU WANT LOCATION PREFERENCES YOU NEED TO INCLUDE IN THE QUERY
// ALSO IN THE SELECT STAMENT IN $query1
    ?>



<!-- featured_candidates_area_start  -->
    <div class="featured_candidates_area bg-gra-02">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title text-center mb-40" style="margin-top: 90px">
                        <h3></h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="candidate_active owl-carousel">

                        <?php while ($row = $result->fetch_assoc()) {
                            $queryPhotos = "SELECT path FROM `Photos` WHERE username= '{$row["username"]}'";
                            $photoRes =$con->query($queryPhotos);
                            $photoPath= $photoRes->fetch_assoc();
                            ?>

                        <div class="single_candidates text-center">
                            <div class="thumb">
                                <img src= "<?php echo $photoPath['path']; ?>" alt="">
                            </div>
                            <form action="view_profile.php" method="post">
                                <input type="hidden"  name="username" value="<?php print $row["username"];?>" >
                                <input class="itemid" type="submit" value="<?php echo $row["username"]; ?>">
                                <br>
                                <p><?php echo $row["location"]; ?>, <?php echo $row["age_id"]." years"; ?></p>
                            </form>
                        </div>

                        <?php }}
                        $con->close();
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- featured_candidates_area_end  -->


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
