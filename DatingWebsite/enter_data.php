<?php

//start session
session_start();
//header('location:login.php');  // direct back to login page instead of displaying rest of the page

//db connection


include 'db_connection.php';
$conn = OpenCon();
"Connected Successfully\n";



$name = $_SESSION['username'];
$age_id = $_POST['age_id'];
$gender = $_POST['gender'];
$location_id = $_POST['location_id'];
$bio = $_POST['bio'];

// interest_id in $_POST is an array, as multiselect is enabled
$interest_id = $_POST['interest_id'];
$interest_id2=$_POST['interest_id2'];
$interest_id3=$_POST['interest_id3'];



// insert username and password into db
$edit = " UPDATE Personal_Data SET username='$name',age_id = '$age_id',gender = '$gender',location_id = '$location_id',bio = '$bio' WHERE username='$name';";
$edit .= "INSERT INTO Interest (username, interest_id) VALUES ('$name', '$interest_id');";
$edit .= "INSERT INTO Interest (username, interest_id) VALUES ('$name', '$interest_id2');";
$edit .= "INSERT INTO Interest (username, interest_id) VALUES ('$name', '$interest_id3')";


// // interest_id in $_POST is an array, as multiselect is enabled
// foreach ($interest_id_values as $interest) {
//     $edit .= "INSERT INTO Interest (username, interest_id) VALUES ('$name', '$interest')";
// }


if ($conn->multi_query($edit) === TRUE) {
    echo "New records created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
//if (mysqli_multi_query($conn, $edit)) {
//    echo "New records created successfully";
//} else {
  //  echo "Error: " . $edit . "<br>" . mysqli_error($conn);
//}

mysqli_close($conn);
header('location:preferences.php');
