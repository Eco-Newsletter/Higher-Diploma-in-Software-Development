<?php

//update_is_type_status.php

//db connection
include '../db_connection.php';

session_start();
// query to update is_type variable
$query = "
UPDATE login_details 
SET is_type = '".$_POST["is_type"]."' 
WHERE login_details_id = '".$_SESSION["login_details_id"]."'
";
// make query for execution
$statement = $connect->prepare($query);
// execute update query
$statement->execute();

?>
