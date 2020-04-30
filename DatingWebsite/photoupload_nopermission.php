<?php
//start session
session_start();
//header('location:login.php');  // direct back to login page instead of displaying rest of the page

//db connection
include 'db_connection.php';
$conn = OpenCon();
echo "Connected Successfully\n";
$name = $_SESSION['username'];

if(isset($_POST['submit'])){
	$file = $_FILES['file'];
	
	$fileName = $_FILES['file']['name'];
	$fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
	$fileError = $_FILES['file']['error'];
	$fileType= $_FILES['file']['type'];


	$fileExt = explode('.', $fileName );
	$fileActualExt = strtolower(end($fileExt));


	$allowed = array('jpg','jpeg','png','pdf');

	
	if( in_array($fileActualExt, $allowed)){
	
		if($fileError === 0){
			if($fileSize < 500000){
				$fileNameNew = uniqid ('', true).".".$fileActualExt;
				$fileDestination = 'uploads/'.$fileNameNew;
				(move_uploaded_file($fileTmpName,$fileDestination));
				$sql= "INSERT INTO Photos (username, path) VALUES ('$name', '$fileDestination')";
				$result = mysqli_query($conn, $sql);
				header("Location:edit_profile1.php?uploadsuccess");
			
			}else{
					echo"Your file too big";
			}
			
			}else{
					echo "There was an error";
			}
	
	}else{
	echo "You cannot upload files of this type";
	}




}

$photo= " INSERT INTO photos (username, path) VALUES ('$name', '$fileDestination)";

//$edit= " INSERT INTO Personal_Data (username, age_id, gender, location_id, bio) VALUES ('Laz','22','m','3001','Hello hardcoded from form')";
mysqli_query($conn, $photo);
// echo JS popup message then redirect to login page
echo "<script>alert('User profile edited successfuly!');
location='edit_profile1.php';
	</script>";
?>
