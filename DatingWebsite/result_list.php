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

	<!-- denisio search result -->
	<link rel="stylesheet" href="dt_search.css">



	<style>
	.search_item{
        margin: auto;
        width:150px;
        text-align:center;
	}

    .search_item_layout{
        background-color:#fafafa;
        border-radius:15px;
        padding:5px;
        align-items:center;
        display:flex;
    }

    .itemid{
        border-radius:15px;
        padding:-5px;
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
						<h3>DISCOVER YOUR DREAM MATCH</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ bradcam_area  -->

<!-- =======================================================================================-->

<?php

//start session
//session_start();
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
	if ($con->connect_error) {
		die("Connection failed: " . $con->connect_error);
	}
//echo "Connected successfully<BR>\n ";
	$username1 = mysqli_real_escape_string($con,$_POST['username']);
	$keywords = mysqli_real_escape_string($con,$_POST['keywords']);
    $minAge = mysqli_real_escape_string($con,$_POST['minAge']);
	$maxAge = mysqli_real_escape_string($con,$_POST['maxAge']);
	$gender = mysqli_real_escape_string($con,$_POST['gender']);
	$photos = mysqli_real_escape_string($con,$_POST['photos']);
	$location = mysqli_real_escape_string($con,$_POST['location']);
	$interest = mysqli_real_escape_string($con,$_POST['interest']);
	$coumpound = false;
	//print "Im here first<br>";
	
					
$query1 = "SELECT DISTINCT username, age_id, gender, bio, location, interest_name,password, user_id
                FROM Personal_Data pd 
				JOIN Location USING (`location_id`)
				JOIN Interest USING (`username`)
				JOIN Interest_Labels USING(`interest_id`)
				JOIN User_ USING(`username`)
				JOIN Photos USING(`username`)";


// we can implement another clause WHERE status=0; to not include blocked users

	//photos
    if (isset($photos)&& $photos!=="") {
		if ($photos=="n"){
			$query = $query1." WHERE 
		    (path = 'img/candiateds/xx.png'
            OR path = 'img/candiateds/xy.png') 
            AND ";
          //  echo "NO PHOTOS HERE!!<BR>";

			}
		else {
          //  echo "YES PHOTOS HERE!!<BR>";
		    $query = $query1." WHERE 
		    path <> 'img/candiateds/xx.png'
            AND path <> 'img/candiateds/xy.png' 
            AND ";
		}
	}
	
	//username
    if (isset($username1) && $username1!=="") {

		$query .= "username='$username1' ";	
		$compound = true;
	}
	//keywords
    if (isset($keywords)&& $keywords!=="") {
	
		$query .= addQ($compound)."bio LIKE '%{$keywords}%' ";		
		$compound = true;
	}
	
	//gender
    if (isset($gender)&& $gender!=="") {
	
		$query .= addQ($compound)."gender= '$gender' ";		
		$compound = true;
	}
	
	//location
    if (isset($location)&& $location!=="") {
	
		$query .= addQ($compound)."location= '$location' ";		
		$compound = true;
	}
	
	//interest
    if (isset($interest)&& $interest!=="") {
	
		$query .= addQ($compound)."interest_name= '$interest' ";		
		$compound = true;
	}
	
	// minAge maxAge
    if ((isset($minAge)&& $minAge!=="") && 
		(isset($maxAge)&& $maxAge!=="") ) {
		if($minAge>=$maxAge){ 
			print "Your age selection is not correct. Try again!";
			die(mysql_error());
			}
		else{
			$query .= addQ($compound)."age_id>='$minAge' 
							AND age_id<='$maxAge' 
							ORDER BY age_id ASC	 ";
			$compound = true;
			}
		}
			
//	print "Im here at end";
	//print $query;
	
	function addQ($state){
		if ($state==true) {
			return "AND ";
			}
		return "";
		}
		
	function changeG($g){
		if ($g=='f') {
			return 'Woman';
			}
		return 'Man';
		}	
	
	
	$num_rows = $con->query($query)->num_rows;

	// print "number of records found: ".$num_rows;
	$result =$con->query($query);
	
	 if($num_rows>=1) {
echo '<div class="page-wrapper bg-gra-02 p-t-100 p-b-100">';		 
echo '<div class= "container">';
        while ($row = $result->fetch_assoc()) {
            $queryPhotos = "SELECT path FROM `Photos` WHERE username= '{$row["username"]}'";
            $photoRes =$con->query($queryPhotos);
            $photoPath= $photoRes->fetch_assoc();
            ?>
			<div class = "search_item_layout">
                <div >	<img src= "<?php echo $photoPath['path']; ?>" alt="" width="40" height="38"></div>
                <div class = "search_item">
                    <form action="view_profile.php" method="post">
                        <input type="hidden"  name="username" value="<?php print $row["username"];?>" >
                        <input class="itemid" type="submit" value="<?php echo $row["username"]; ?>">
                    </form>

                </div>
                <div class = "search_item"> <h5><?php echo $row["location"]; ?></h5></div>
                <div class = "search_item"> <h5 ><?php echo $row["age_id"]." years"; ?></h5></div>
                <div class = "search_item width:150px"> <h5><?php echo $row["interest_name"]; ?></h5></div>
			</div>
		<div style="color:transparent;">.</div>
		<?php		
        }

        
	 }
	 else {echo "<br><h3 style='text-align: center; padding-bottom: 20px'> Sorry, no results found!</h3>";}

echo '</div>';
echo '</div>';
    $con->close();
 ?>			

    <!-- job_listing_area_end  -->


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
    <script src="jquery.js" type="text/javascript"></script>
    <!-- <script src="js/gijgo.min.js"></script> -->
    <script src="js/range.js"></script>



    <!--contact js-->
    <script src="js/contact.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/mail-script.js"></script>


    <script src="js/main.js"></script>


    <script language="JavaScript" type="text/javascript">

//        document.getElementById('myForm').submit();

    </script>
	
		
</body>

</html>
