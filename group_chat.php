<?php

//group_chat.php

//db connection
include '../db_connection.php';

session_start();

if ($_POST["action"] == "insert_data") {
  $data = array(
    // from user_id is the current user logged in
    ':from_user_id'  => $_SESSION["user_id"],
    // message text
    ':chat_message'  => $_POST['chat_message'],
    // unread message inserted
    ':status'   => '1'
  );
  // sql query to insert data to db (to_user is 0 --not real user--, if just left out, won't save it in db)
  $query = "
  INSERT INTO chat_message 
  (to_user_id, from_user_id, chat_message, status) 
  VALUES (0, :from_user_id, :chat_message, :status)
  ";
  // make query for execution
  $statement = $connect->prepare($query);
  // if executed successfuly 
  if ($statement->execute($data)) {
    // return all groupchat history of all user in the group
    echo fetch_group_chat_history($connect);
  // } else{
  //   echo '<script type="text/javascript">alert("'.$message.'");</script>';
  }
}
// fetch data was requested from chat.php:
if ($_POST["action"] == "fetch_data") {
  //send latest groupchat message to ajax function in 'fetch_group_chat_history'
  echo fetch_group_chat_history($connect);
}
