<?php

//fetch_user.php

//db connection
include '../db_connection.php';

session_start();
// query to select all users except currently logged in user
$query = "
SELECT * FROM User_ 
WHERE user_id != '" . $_SESSION['user_id'] . "' 
";
// make query for execution
$statement = $connect->prepare($query);
// execute query
$statement->execute();
// fetch data and store in variable
$result = $statement->fetchAll();
// output variable stores html table with 3 columns
$output = '
<div class="col-sm-6 col-sm-offset-3 bg-light text-dark">
<table class="table table-bordered table-dark">
 <tr>
  <th width="70%">Username</td>
  <th width="20%">Status</td>
  <th width="10%">Action</td>
 </tr>
 </div>
';
// loop through $result variable 
foreach ($result as $row) {
   //to display status of user
   $status = '';
   // store current unix time -10 sec
   $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
   // format current time from unix time to date-time
   $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
   // store the returned last activity data
   $user_last_activity = fetch_user_last_activity($row['user_id'], $connect);
   // if user_last_activity (refreshed in every 5 sec) is after current_time (-10sec), user is online
   if ($user_last_activity > $current_timestamp)
   // status saved as online or offine
   {
      $status = '<span class="label label-success">Online</span>';
   } else {
      $status = '<span class="label label-danger">Offline</span>';
   }
   // append details to $output variable 
   // 1. all username (excluding self) with unseen message notification
   // 2. status (online or offline from above)
   // 3. strt chat button (to particular user)
   $output .= '
 <tr>
  <td>' . $row['username'] . ' ' . count_unseen_message($row['user_id'], $_SESSION['user_id'], $connect) . ' ' . fetch_is_type_status($row['user_id'], $connect) . '</td>
  <td>' . $status . '</td>
  <td><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="' . $row['user_id'] . '" data-tousername="' . $row['username'] . '">Start Chat</button></td>
 </tr>
 ';
}
// finish the table html format with colse </table> tab
$output .= '</table>';
// send data to ajax function
echo $output;
