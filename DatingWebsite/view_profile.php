<?php
session_start();
$name= $_SESSION['username'];
$servername = 'hive.csis.ul.ie';

$username = 'group07';
$password = '-zk_2@c!K)G{4Y/[';
$dbname = 'dbgroup07';

if (!isset($_POST['username'])){
    $name= $_SESSION['username'];
} else {
    $name = $_POST['username'];
}


//include 'db_connection.php';
 //   $con = OpenCon();
	//echo "Connected Successfully\n";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}
$sql= "SELECT username, age_id, location, gender, bio, path FROM Personal_Data JOIN Location USING (location_id) JOIN Photos USING (username) WHERE  username = '$name'";
//$sql = "SELECT username, age_id, location, gender, bio, path FROM personal_data JOIN location ON personal_data.location_id = location.location_id WHERE username= '$name'";
$result = $conn->query($sql);
if($result->num_rows == 0){
 header('location:edit_profile1.php');
}

if ($result->num_rows > 0) {
  // output data of each row
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
	  <link rel="stylesheet" type="text/css" href="navbarwebb.css">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
	<style>

	.img-button{
	position:relative;
	padding-top:20px;
	max-width:68%;
	display:block;
	}
	.bio{
		background-color:#732673;
		color:white;
		border-radius:15px;
	}
	.photos{
        display: grid;
		padding-top:50px;
		padding-bottom:50px;
		background-color:#732673;
        align-content: center;
        padding-left:250px;


    .bg-gra-02 {
        background: -webkit-gradient(linear, left bottom, right top, from(#fc2c77), to(#6c4079));
        background: -webkit-linear-gradient(bottom left, #fc2c77 0%, #6c4079 100%);
        background: -moz-linear-gradient(bottom left, #fc2c77 0%, #6c4079 100%);
        background: -o-linear-gradient(bottom left, #fc2c77 0%, #6c4079 100%);
        background: linear-gradient(to top right, #fc2c77 0%, #6c4079 100%);
    }


	}
    </style>
</head>

<div>
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
                                    <a href="recommendation.php">
                                        <img src="img/matchmaker.jpeg" alt="">
                                    </a>
                                </div>
                            </div>
                           <div class="col-xl-6 col-lg-7">
                                <div class="main-menu  d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="recommendation.php">home</a></li>
                                            <li><a href="search.php">Search</a></li>
                                            <li><a href="chatSystem/chat.php">Notification <i class="ti-angle-down"></i></a>
                                            </li>
                                            <li><a href="#">My Profile <i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="view_profile.php">View </a></li>
                                                    <li><a href="edit_profile1.php">Edit </a></li>
                                                    <li><a href="preferences.php">Your Preferences</a></li>
                                                </ul>
                                            </li>
                                            <li><a class="bottom" href="logout.php" onclick=confirmLogout() >Logout</a></li>
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

    <!-- slider_area_start --> <!-- single_slider d-flex align-items-center-->

    <div class="slider_area " >
        <div class="single_slider d-flex align-items-center slider_bg_1">
            <div class="container" >
                <div class="row" >
                    <div class="col-lg-5 col-md-5" align="center" >
                        <div class="profile_pic" >
                            <?php
                            $queryPhotos = "SELECT path FROM `Photos` WHERE username= '{$name}'";
//                            echo $queryPhotos;
                            $photoRes =$conn->query($queryPhotos);
                            $photoPath= $photoRes->fetch_assoc();
//							echo $photoPath['path'];
                            ?>
							<img src = "<?php echo $photoPath['path']?>" alt = "picture" height ="350" width = "350">
						</div>
						<div class="img-button">
							<form method="get" action="chatSystem/chat.php">
                               <button type="submit"class="btn btn-default btn-block"style = "background-color: black;
				color: purple; border-radius: 15px"><b>Get in touch with me<b></button>
                            </form>
						</div>
                    </div>
                    <div class = "col-lg-12 col-md-12 bio" style="margin-left: 80px" >
                        <h3 style="color: white"><?php while($row = $result->fetch_assoc()) {
                                            echo "<br>". $row["username"].
                                                "<br><br>My age: ". $row["age_id"].
                                                "years<br>  from: ".$row["location"].
                                                "<br> Gender: " .$row["gender"].
                                                "<br><br> About me:<br>".$row["bio"].
                                                "<br><br>My interests are:";
                                                }
                                        } else {   // if statement on line 33
                                            echo "0 results";
                                        }?>
                        </h3><?php
                            $sql2= "SELECT DISTINCT interest_name FROM Personal_Data
                                    JOIN Interest USING (username)JOIN Interest_Labels
                                    USING(interest_id) WHERE  username = '$name'";

    //$sql = "SELECT username, age_id, location, gender, bio FROM personal_data JOIN location ON personal_data.location_id = location.location_id WHERE username= '$name'";
                        $result = $conn->query($sql2);
                        if($result->num_rows - 0){
                            echo "";
                        }
                        if ($result->num_rows > 0) {
                          // output data of each row?>
                         <h3 style="color: white"><?php while($row = $result->fetch_assoc())
                                        {
                                            echo $row["interest_name"]."<br>";
                                            }
                                        } else {
                                            echo "0 results";
                                        }
                                        ?></h3>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- slider_area_end -->


  

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
                                findSupport@support.com <br>
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
                <div class="footer_border">
				</div>
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
    <script src="js/gijgo.min.js"></script>



    <!--contact js-->
    <script src="js/contact.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/mail-script.js"></script>


    <script src="js/main.js"></script>
</body>

</html>
