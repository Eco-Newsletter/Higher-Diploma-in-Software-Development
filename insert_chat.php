<?php

//insert_chat.php

//db connection
include '../db_connection.php';

session_start();

$data = array(
    // user id to whom we send the message (from POST[])
 ':to_user_id'  => $_POST['to_user_id'],
    // logged in user id (from SESSION[]) 
 ':from_user_id'  => $_SESSION['user_id'],
    //  message (from POST[])
 ':chat_message'  => $_POST['chat_message'],
    // status set to 1 to indicate it was sent and yet unseen
 ':status'   => '1'
);

$query = "
INSERT INTO chat_message 
(to_user_id, from_user_id, chat_message, status) 
VALUES (:to_user_id, :from_user_id, :chat_message, :status)
";
// prepare query for execution
$statement = $connect->prepare($query);
// execute query
if($statement->execute($data))
{
    // if successful, send message to ajax request, which display chat message dialog box
 echo fetch_user_chat_history($_SESSION['user_id'], $_POST['to_user_id'], $connect);
}

?>
