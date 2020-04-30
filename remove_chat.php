<?php

//remove_chat.php

//db connection
include '../db_connection.php';

// construct query. status 2 = removed (0 - normal, 1 unopened)
if (isset($_POST["chat_message_id"])) {
    $query = "
 UPDATE chat_message 
 SET status = '2' 
 WHERE chat_message_id = '" . $_POST["chat_message_id"] . "'
 ";
    //make query for execution
    $statement = $connect->prepare($query);
    // execute query
    $statement->execute();
}
