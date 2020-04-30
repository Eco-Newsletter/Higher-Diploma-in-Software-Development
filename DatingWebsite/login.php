<!--
//login.php
!-->

<?php

//db connection
include 'db_connection.php';

session_start();
// store error message
$message = '';
// if user is already logged in, deny access to login page, redirect ot welcome.php
if (isset($_SESSION['user_id'])) {
  header('location:welcome.php');
}
// if trying to log in, get records form db to see username exists
if (isset($_POST["login"])) {
  $query = "
   SELECT * FROM User_
    WHERE username = :username
 ";
  $statement = $connect->prepare($query);
  // execute query
  $statement->execute(
    array(
      ':username' => $_POST["username"]
    )
  );
  // return number of rows matching (should > 0)
  $count = $statement->rowCount();
  if ($count > 0) {
    $result = $statement->fetchAll();
    // fetch date from $result
    foreach ($result as $row) {
      // correct password
      if (password_verify($_POST["password"], $row["password"])) {
        //save user_id, username values in session
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['username'] = $row['username'];
        // enter login details to login_details table (to see if logged in or not)
        $sub_query = "
        INSERT INTO login_details
        (user_id)
        VALUES ('" . $row['user_id'] . "')
        ";
        $statement = $connect->prepare($sub_query);
        // execute an insert login details
        $statement->execute();
        // return id of last inserted id
        $_SESSION['login_details_id'] = $connect->lastInsertId();
        if( $_SESSION['username'] == 'administrator'){
          // redirect administrator to admin.php
          header("location:admin.php");
        } else{
          // redirect to welcome.php
          header("location:welcome.php");
        }


      }
      // wring password
      else {
        $message = "<label>Wrong Password</label>";
      }
    }
  }
  // wrong user name
  else {
    $message = "<label>Wrong Username</labe>";
  }
}

?>

<html>

<head>
  <title>MatchMaker registration</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Edit</title>
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
  <div class="bradcam_area bradcam_bg_1">
      <!--<div class="container">-->
          <div class="row">
              <div class="col-xl-12">
                  <div class="bradcam_text">
                      <!--<h3>DISCOVER YOUR DREAM MATCH</h3>-->
                  </div>
              </div>
          </div>
    <!--  </div>-->

  <div class="container">
    <br />

    <h3 align="center">Please enter your username and password to login to MatchMaker</a></h3><br />
    <br />
    <!--center table on webpage-->
    <div class="col-sm-6 col-sm-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">MatchMaker Login</div>
        <div class="panel-body">
          <p class="text-danger"><?php echo $message; ?></p>
          <!-- form for loging in. Username and psw need to be filled out before submission-->
          <form method="post">
            <!--display error message, if occured-->
            <div class="form-group">
              <label>Enter Username</label>
              <input type="text" name="username" class="form-control" required />
            </div>

            <div class="form-group">
              <label>Enter Password</label>
              <input type="password" name="password" class="form-control" required />
            </div>
            <div class="form-group">
              <input type="submit" name="login" class="btn btn-info" value="Login" />
            </div>
            <div align="center">
              <a href="register.php" >Register</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include "footer.html" ?>
</body>

</html>
