

<!doctype html>
<html class="no-js" lang="zxx" xmlns:aligment="http://www.w3.org/1999/xhtml">

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

	<!-- denisio search result -->
	<link rel="stylesheet" href="dt_search.css">


    <style>


        .item{
            margin-left: 75px;
            display: inline-flex;

        }
        .itemid{
            border-radius:15px;
            width: 100px;
            font-weight:bolder;
            background-color: #cc38d3;
            color: white;
            height: 30px;



        }

        .itemid1{
            border-radius:15px;
            text-align: center;
            background:lightgrey;
            padding:5px;
            width: 100px;


        }

        ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
            color: saddlebrown;
            opacity: 1; /* Firefox */
            font-size: 18px;
        }


        .item_layout{
            background-color:#fafafa;
            border-radius:15px;
            align-content: center;
            margin-bottom: 15px;
            min-width: 180px;
            height: 40px;
            max-width: 500px;
            display: flex;

        }


        .item_admin_search{
            background-color:#fafafa;
            border-radius:10px;
            margin-bottom:30px;
            height: 30px;
            max-width: 500px;
            min-width: 180px;

            display:flex;
            padding:25px;

        }

        .item_heading{
            display: flex;
            margin: auto;
            width:100px;
            height: 50px;
            text-align:center;
            font-weight:bolder;
            align-items:center;
        }

        .button_admin{
            background-color: #cc38d3;
            color: white;
            border-radius:50px;
            height: 35px;
            align-items:center;
            margin-top: 10px;
            margin-left: 50px;
            width:150px;
            font-size: 16px;
            font-weight:bolder;

        }

        .card-21 {
            -moz-box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
            -webkit-border-radius: 20px;
            -moz-border-radius: 10px;
            border-radius: 15px;
            width: 100%;
            display:grid;
            align-content: center;
            margin:auto;

            margin-bottom: 100px;
        }


    </style>

</head>

<body><div style="text-align: center; ">


    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        <?php include "admin_header.html" ?>

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

	echo "Connected successfully<BR>\n ";

//	print "Im here first<br>";


	$query = "SELECT * FROM Interest_Labels ORDER BY interest_name ASC;";


	/*
	Important: if an username does not have any of
	the variable, the search won't show it.
	for instance, if it does not have photo, it won't appear
	if does not have an interest it won't appear
	*/

//	print "Im here at end";
//	print $query;


	$num_rows = $con->query($query)->num_rows;

	// print "number of records found: ".$num_rows;
	$result =$con->query($query);

    $mycondition="false";
?>

    <div class="page-wrapper bg-gra-02 p-b-100" style="padding-top: 150px;  ">

        <div class= "container" style=" width:550px">
            <div >

                <!-- start search-->
                    <form action="updateInterests.php" method="POST" onsubmit="this.submit(); this.reset(); return false;" autocomplete="off">
                        <div  style="display:flex">
                            <input class="item_admin_search" type="text" name="new_interest" placeholder="New interest"
                                   data-toggle="tooltip" data-placement="top"  title="Place a new interest">
                            <input class="itemid" type="hidden" name="state" value="0">
                            <button class="button_admin" type="submit" >Insert</button>
                        </div>
                    </form>
                <!-- end search-->

                <!-- start headings -->
                <div class="item_layout" style="background-color:#dabeff; height:45px; ">
                    <div class="item_heading" style="margin-left: 80px"> INTEREST </h5></div>
                    <div class="item_heading" style="margin-left: 150px;"> ACTIONS </h5></div>
                </div>
                <!-- end headings -->

                <!-- start fetching -->

                <?php    while ($row = $result->fetch_assoc()) { ?>

            <div class="item_layout">
                        <form class="form-inline" style=" margin-left: 40px;" action="updateInterests.php" method="post" onsubmit="this.submit(); this.reset(); return false;">

                            <div class="" style="padding-right: 120px; ">
                                    <h4><input class="itemid1" data-toggle="tooltip" data-placement="top"  title="input the interest to update" type="text" name="new" placeholder="<?php echo $row["interest_name"]; ?>"></h4>
                                        <input type="hidden" name="old" value="<?php echo $row["interest_name"]; ?>">
                                        <input type="hidden"  name="state" value="1">
                            </div>
                            <div >
                                        <button class="itemid"  type="submit" >Update</button>

                                        <input  type="hidden" name="old" value="<?php echo $row["interest_name"]; ?>">
                                        <input  type="hidden" name="state" value="2">
                            </div>
                            <div style="padding-left: 25px">
                                        <button class="itemid" style="background: red;"  type="submit">Delete</button>
                            </div>

                        </form>
            </div>


            <?php }
    echo '</div>';

        $new_interest = mysqli_real_escape_string($con, $_POST['new_interest']);
        $interest_new = mysqli_real_escape_string($con, $_POST['new']);
        echo $interest_new.'<BR>';
        $interest_old = mysqli_real_escape_string($con, $_POST['old']);
        $state = mysqli_real_escape_string($con, $_POST['state']);

        if($state=="0" and $new_interest<>""){
            $queryUpdate = "INSERT INTO Interest_Labels(interest_name) VALUES('$new_interest');";
            echo $queryUpdate;
            $con->query($queryUpdate);

        }

        if($state=="1"){
            $queryUpdate = "UPDATE Interest_Labels SET interest_name='$interest_new' WHERE interest_name = '$interest_old';";
            echo $queryUpdate;
            $con->query($queryUpdate);

            }

        if($state=="2") {

            $updateStatus = "DELETE FROM Interest_Labels WHERE interest_name = '$interest_old';";
            $con->query($updateStatus);

        }
    $con->close();

 ?>
    </div>
  </div>

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
    <!-- <script src="js/gijgo.min.js"></script> -->
    <script src="js/range.js"></script>



    <!--contact js-->
    <script src="js/contact.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/mail-script.js"></script>


    <script src="js/main.js"></script>

            <script>
                if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location.href );
                }
            </script>


        <script>
            $(document).ready(function() {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>



</body>

</html>
