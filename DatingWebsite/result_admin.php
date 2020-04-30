

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

	<!-- denisio search result -->
	<link rel="stylesheet" href="dt_search.css">


    <style>
        .item{
            display: grid;
            align-items:center;
            width:400px;
            margin-right: auto;
            padding-left: 50px;
        }
        .itemid{
            border-radius:15px;
            padding:5px;
            margin-top: 5px;
            margin-bottom: 5px;
            background-color: #cc38d3;
            margin-right: 2px;
            width: 30px;
            font-weight:bolder;
        }

        .item_action{
            margin-right:15px;
            width:250px;

            display: grid;
            align-items:center;
        }

        .item_layout{
            background-color:#fafafa;
            border-radius:15px;

            display:flex;
            margin-bottom: 15px;
            min-width: 580px;
            margin-left: 0px;

            
        }


        .item_heading{
            display: inline-flex;
            margin-left: 10%;
            width:230px;
            height: 50px;
            text-align:left;
            font-weight:bolder;
            align-items:center;
        }

        .button_admin{
            background-color: #cc38d3;
            color: white;
            border-radius:70px;
            height: 50px;
            align-items:center;
            padding:5px;
            margin-left: 100px;
            width:250px;
            font-size: 16px;

        }

    </style>

</head>

<body align=center>

<?php include "admin_header.html" ?>


<!-- =======================================================================================-->


<?php


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

    $keywords = mysqli_real_escape_string($con,$_POST['keywords']);

    $query = "SELECT * FROM Personal_Data  
				JOIN User_ USING(`username`) 
                WHERE bio LIKE '%{$keywords}%' ORDER BY username ASC ";

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
?>

    <div class="page-wrapper bg-gra-02 p-t-100 p-b-100" style="margin-left: -50px">
        <div class= "container" style="margin-top: 50px; ">
            <div class="item_layout" style="background-color:#dabeff; height:45px;">

                    <div class="item_heading" > USERNAME </h5></div>
                    <div class="item_heading"> STATUS </h5></div>
                    <div class="item_heading"> BIO </h5></div>
                    <div class="item_heading"> ACTION </h5></div>

        </div>

        <?php  while ($row = $result->fetch_assoc()) {?>
                <div class = "item_layout">
                    <div class="item"> <h5> <?php echo $row["username"]; ?></h5> </div>
                    <div class="item"><h5><?php
                            if ($row["status"] == 0) {
                                $status = "normal";
                            } else if ($row["status"] == 1) {
                                $status = "blocked";
                            } else $status = "removed";
                            echo $status; ?></h5></div>

                        <div class="item_action" style="height: 100px; text-align: left; "> <h5> <?php echo $row["bio"]; ?></h5></div>
                    <div class="item_action" style="display: flex;">

                        <form action="view_profile.php" method="post">
                            <input class="itemid" type="hidden" name="username" value="<?php echo $row["username"]; ?>">
                            <button data-toggle="tooltip" data-placement="top" title="View Profile" class="itemid"
                                    type="submit">V</button>

                        </form>
                        <form action="edit_profile1.php" method="post">
                            <input class="itemid" type="hidden" name="username" value="<?php echo $row["username"]; ?>">
                            <button data-toggle="tooltip" data-placement="right" title="Edit Profile" class="itemid"
                                    type="submit">E</button>

                        </form>
                        <form action="result_admin.php"  method="post">
                            <input class="itemid" type="hidden" name="username" value="<?php echo $row["username"]; ?>">
                            <input class="itemid" type="hidden" name="state" value=0>
                            <button data-toggle="tooltip" data-placement="right" title="Unblock" class="itemid"
                                    type="submit" >U</button>

                        </form>
                        <form action="result_admin.php" method="post">
                            <input class="itemid" type="hidden" name="username" value="<?php echo $row["username"]; ?>">
                            <input class="itemid" type="hidden" name="state" value=1>
                            <button data-toggle="tooltip" data-placement="right" title="block" class="itemid"
                                    type="submit" onclick="myFunction()">B</button>
                        </form>
                        </form>
                        <form action="admin.php" method="post">
                            <input class="itemid" type="hidden" name="username" value="<?php echo $row["username"]; ?>">
                            <input class="itemid" type="hidden" name="state" value="2">
							<button onclick= confirmDelete()  data-toggle="tooltip" data-placement="right" title="Delete" class="itemid"
                                    type="submit" style="background: red">D</button>
                        </form>

                    </div>
                </div>
            <?php }

        echo '</div>';

        $username1 = mysqli_real_escape_string($con, $_POST['username']);
        $state = mysqli_real_escape_string($con, $_POST['state']);
        //$state=1;
        echo $username1 . "  " . $state . " ";
        $queryStatus = "SELECT status, user_id FROM User_ WHERE username = '$username1';";

        $curStatus = $con->query($queryStatus)->fetch_assoc();
        echo $curStatus["status"];
        $userID = $curStatus["user_id"];
        echo $userID;
        echo "<br>";
        if($state=="0" or $state=="1"){
            $updateStatus = "UPDATE User_ SET status='$state' WHERE username = '$username1';";
            $con->query($updateStatus);
        }

        if($state=="2" and $curStatus["status"]=="1" ) {

            $updateStatus = "DELETE FROM User_ WHERE username = '$username1';";
            $con->query($updateStatus);
            $updateStatus = "DELETE FROM Personal_Data WHERE username = '$username1'";
            $con->query($updateStatus);
            $updateStatus = "DELETE FROM Preferences WHERE username = '$username1'";
            $con->query($updateStatus);
            $updateStatus = "DELETE FROM Photos WHERE username = '$username1';";
            $con->query($updateStatus);
            $updateStatus = "DELETE FROM Interest WHERE username = '$username1';";
            echo $updateStatus;
            $con->query($updateStatus);
            $updateStatus = "DELETE FROM Preferences WHERE username = '$username1';";
            $con->query($updateStatus);
            $updateStatus = "DELETE FROM Likes WHERE username_to = '$username1' OR username_from = '$username1';";
            $con->query($updateStatus);
            $updateStatus = "DELETE FROM chart_message WHERE to_user_id = '$userID' OR from_user_id = '$userID';";
            $con->query($updateStatus);
            $updateStatus = "DELETE FROM login_details WHERE user_id = '$userID';";
            echo $updateStatus;
            $con->query($updateStatus);
        }

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
                $(document).ready(function() {
                    $('[data-toggle="tooltip"]').tooltip();
                });
            </script>
			
			
					<!-- JS confirm popup window to delete-->
		<script>
			function confirmDelete() {
				if (confirm('User should be Blocked before deletion. Are you sure do you want to delete?')) {
						location='admin.php';
			
				}
			}
		</script>

		
</body>

</html>
