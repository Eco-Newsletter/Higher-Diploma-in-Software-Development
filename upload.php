<?php

//upload.php

//db connection
include '../db_connection.php';

// use session to get logged in user name for renaming image and user_id for the path into database
session_start();
$username = $_SESSION['username'];
$user_id = $_SESSION["user_id"];

// if some file is attached
if (!empty($_FILES)) {
  if (is_uploaded_file($_FILES['uploadFile']['tmp_name'])) {
    $_source_path = $_FILES['uploadFile']['tmp_name'];
    // change file name to username_time 
    $file = $_FILES['uploadFile']['name'];
    $array = explode('.', $file);
    $fileName = $username;
    $fileExt = $array[1];
    $newfile = $fileName . "_" . time() . "." . $fileExt;
    
    // file saved to the groupchat_img_upload/ folder
    // relative path
    $target_path = 'groupchat_img_upload/' . $newfile;
    // absolute path
    //$target_path = 'http://hive.csis.ul.ie/cs4116/group07/MatchMaker/chatSystem/groupchat_img_upload/' . $newfile;
    // absolute path to F:\ drive
    //$target_path = 'F:\' . $newfile;
    
    if (move_uploaded_file($_source_path, $target_path)) {
      echo '<p><img src="' . $target_path . '" class="img-thumbnail" width="200" height="160" /></p><br />';
      //Writes the information to the database
      $query = "
 INSERT INTO Photos (username, path)
 VALUES ('$username', '$target_path')
 ";
      //make query for execution
      $statement = $connect->prepare($query);
      // execute query
      $statement->execute();
    } else {
      //Gives and error if its not
      echo "Sorry, there was a problem uploading your file.";

    }
  }
}
