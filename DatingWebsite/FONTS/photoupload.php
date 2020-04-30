<?php
session_start();

include 'db_connection.php';
  $conn = OpenCon();

if(isset($_POST['submit'])){
 $user = $_SESSION['username'];
  $name = $_FILES['file']['name'];
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["file"]["name"]);

  // Select file type
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Valid file extensions
  $extensions_arr = array("jpg","jpeg","png","gif");

  // Check extension
  if( in_array($imageFileType,$extensions_arr) ){
 
     // Insert record
     $query = "Insert INTO Photos (username, path) values('.$name'.,'$user')";
     mysqli_query($conn,$query);
  
     // Upload file
     move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);

  }
 
}
?>
