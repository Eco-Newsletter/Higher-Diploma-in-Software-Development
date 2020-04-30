<?php

//fetch_user_chat_history.php

//db connection
include '../db_connection.php';

session_start();
// call function from db_connection.php to fetch history of chat between 2 people
echo fetch_user_chat_history($_SESSION['user_id'], $_POST['to_user_id'], $connect);

?>