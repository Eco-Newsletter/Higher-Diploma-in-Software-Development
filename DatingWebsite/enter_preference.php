<?php

//start session
session_start();
//header('location:login.php');  // direct back to login page instead of displaying rest of the page

//db connection


include 'db_connection.php';
  $conn = OpenCon();
 "Connected Successfully\n";

$name = $_SESSION['username'];
$age_id_from = $_POST['age_id_from'];
$age_id_to = $_POST['age_id_to'];
$gender_pref = $_POST['gender_pref'];
$location_pref_id = $_POST['location_pref_id'];
$interest_id=$_POST['interest_id'];

// insert username and password into db
$editpref= " UPDATE Preferences SET username='$name',age_id_from = '$age_id_from', age_id_to = '$age_id_to', gender_pref = '$gender_pref', location_pref_id = '$location_pref_id' WHERE username='$name'";

mysqli_query($conn, $editpref);


// echo JS popup message then redirect to login page
echo "<script>alert('User updated preferences successfully!');
location='preferences.php';
	</script>";

header('location:preferences.php');


?>