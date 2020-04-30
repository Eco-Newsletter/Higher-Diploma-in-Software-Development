<?php

//update_last_activity.php

//db connection
include '../db_connection.php';

session_start();
// query to update user status (logged in or not) in login_details table
$query = "
UPDATE login_details 
SET last_activity = now() 
WHERE login_details_id = '".$_SESSION["login_details_id"]."'
";
// prepare query
$statement = $connect->prepare($query);
// execute query
$statement->execute();

?>