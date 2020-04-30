<!--
//register.php
!-->

<?php

//db connection
include 'db_connection.php';

session_start();
// variable for validation error message
$message = '';
// if user is already logged in, cannot access register page
if (isset($_SESSION['user_id'])) {
    header('location:home.php');
}
// validate form data for registration
if (isset($_POST["register"])) {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    // check if username is already taken or not
    $check_query = "

 SELECT * FROM User_ 
 WHERE username = :username
 ";
    // make query for execution
    $statement = $connect->prepare($check_query);
    $check_data = array(
        ':username'  => $username
    );
    // execute query (check if username already in database)
    if ($statement->execute($check_data)) {
        // if username found
        if ($statement->rowCount() > 0) {
            $message .= '<p><label>Username already taken</label></p>';
        } else {
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
                $query = "
                INSERT INTO User_ 
                (username, password, status) 
                VALUES (:username, :password, '0')
                ";
                $statement = $connect->prepare($query);
                if ($statement->execute($data)) {
                    $message = "<label>Registration Completed</label>";
                    header('location:login.php');
                }
            }
        }
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
</head>

<body>
    <div class="container">
        <br />

        <h3 align="center">Please chose your username and password and register to MatchMaker</a></h3><br />
        <br />
        <!--center table on webpage-->
        <div class="col-sm-6 col-sm-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">MatchMaker Register</div>
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
                            <label>Enter Password</label>
                            <input type="password" name="password" class="form-control" />
                        </div>
                        <div class="form-group">
                            <!--enter user details-->
                            <label>Re-enter Password</label>
                            <input type="password" name="confirm_password" class="form-control" />
                        </div>
                        <div class="form-group">
                            <!--to submit registration details-->
                            <input type="submit" name="register" class="btn btn-info" value="Register" />
                        </div>
                        <div align="center">
                            <!-- clicking login button redirects to login page -->
                            <a href="login.php">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>