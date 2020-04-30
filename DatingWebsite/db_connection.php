    <?php
$servername = "localhost";
$username = "root";
$password = "root123";
$dbname = "dbgroup07";
// credentials for hive server
//$host = "hive.csis.ul.ie";
//$username = "group07";
//$password = "-zk_2@c!K)G{4Y/[";
//$dbname = "dbgroup07";
$charset = "utf8mb4";

     // mysqli connection
     function OpenCon()
     {
          global $host, $username, $password, $dbname, $charset; 
          // estabilishing connection
          $conn = new mysqli($host, $username, $password, $dbname) or die("Connect failed: %s\n" . $conn->error);

//query name entered to see if it is already taken
$already_exists = " SELECT * FROM User_";

// saving the result of the query
$result = mysqli_query($conn, $already_exists);

print_r($result);

return $conn;
}

// PDO connection
// $connect = new PDO("mysql:host=localhost;dbname=private_chat;charset=utf8mb4", "root", "");
$connect = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", "$username", "$password");

     function CloseCon($conn)
     {
          $conn->close();
     }

     // ////////////////////////////////////////////////////////////////////////
     // from database_connection.php
     date_default_timezone_set('Europe/Dublin');
     // to get particular user's last activity data
     function fetch_user_last_activity($user_id, $connect)
     {
          // select the last inserted activity login details of particular user
          $query = "
 SELECT * FROM login_details 
 WHERE user_id = '$user_id' 
 ORDER BY last_activity DESC 
 LIMIT 1
 ";
          $statement = $connect->prepare($query); // make query for execution
          $statement->execute(); // execute select query
          $result = $statement->fetchAll(); // fetch data and store it in $result
          foreach ($result as $row) {
               return $row['last_activity'];
          }
     }
     // !!!to display all chat message to particular user
     // function to get all conversation between 2 user
     function fetch_user_chat_history($from_user_id, $to_user_id, $connect)
     {
          // query to get all converstaion between 2 user in descending order
          $query = "
 SELECT * FROM chat_message 
 WHERE (from_user_id = '" . $from_user_id . "' 
 AND to_user_id = '" . $to_user_id . "') 
 OR (from_user_id = '" . $to_user_id . "' 
 AND to_user_id = '" . $from_user_id . "') 
 ORDER BY timestamp DESC
 ";
          // prepare query for execution
          $statement = $connect->prepare($query);
          // execute statement
          $statement->execute();
          // fetch data and save result in variable
          $result = $statement->fetchAll();
          // output saved as unordered list via bootstrap class
          $output = '<ul class="list-unstyled">';
          foreach ($result as $row) {
               $user_name = '';
               $dynamic_background = '';
               $chat_message = '';
               // check, if the message was sent by current user
               if ($row["from_user_id"] == $from_user_id) {
                    //if message was removed (status = 2)
                    if ($row["status"] == '2') {
                         $chat_message = '<em>This message has been removed</em>';
                         // if logged in user has sent message, display 'you'
                         $user_name = '<b class="text-success">You</b>';
                    } else {
                         $chat_message = $row['chat_message'];
                         $user_name = '<button type="button" class="btn btn-danger btn-xs remove_chat" id="' . $row['chat_message_id'] . '">x</button>&nbsp;<b class="text-success">You</b>';
                    }

                    $dynamic_background = 'background-color:#ffe6e6;';
                    // if message is sent by someone else
               } else {
                    if ($row["status"] == '2') {
                         $chat_message = '<em>This message has been removed</em>';
                    } else {
                         $chat_message = $row["chat_message"];
                    }

                    // if other user sent message, display users's name
                    $user_name = '<b class="text-danger">' . get_user_name($row['from_user_id'], $connect) . '</b>';
                    $dynamic_background = 'background-color:#ffffe6;';
               }
               // chain html code for displaying chat message
               // 1. sender's name and message
               // 2. timestamp
               $output .= '
        <li style="border-bottom:1px dotted #ccc;padding-top:8px; padding-left:8px; padding-right:8px;' . $dynamic_background . '">
        <p>' . $user_name . ' - ' . $chat_message . '
            <div align="right">
            - <small><em>' . $row['timestamp'] . '</em></small>
            </div>
        </p>
        </li>
        ';
          }
          $output .= '</ul>';
          // once unseen message is displayed in history, set it to seen (status=0)
          $query = "
 UPDATE chat_message 
 SET status = '0' 
 WHERE from_user_id = '" . $to_user_id . "' 
 AND to_user_id = '" . $from_user_id . "' 
 AND status = '1'
 ";
          // make query for execution
          $statement = $connect->prepare($query);
          // execute update query
          $statement->execute();
          // return chat history between 2 person
          return $output;
     }
     // to get username, who sent the message, if not the logged in user
     function get_user_name($user_id, $connect)
     {
          // create query to fetch username for user_id
          $query = "SELECT username FROM user_ WHERE user_id = '$user_id'";
          // make satement for execution
          $statement = $connect->prepare($query);
          // execute statement
          $statement->execute();
          // fetch data and store in variable
          $result = $statement->fetchAll();
          // should be only one, but loop through result
          foreach ($result as $row) {
               return $row['username'];
          }
     }

     // to display notification on webpage, if someone had sent message
     function count_unseen_message($from_user_id, $to_user_id, $connect)
     {
          //query to return unseen message details
          // status = 1 means message is unseen by receiver user
          $query = "
 SELECT * FROM chat_message 
 WHERE from_user_id = '$from_user_id' 
 AND to_user_id = '$to_user_id' 
 AND status = '1'
 ";
          // make query fro exxecution
          $statement = $connect->prepare($query);
          // execute select query
          $statement->execute();
          // store the number of affected rows
          $count = $statement->rowCount();
          // notification message
          $output = '';
          // if there is unread message
          if ($count > 0) {
               // update notification message to be displayed
               $output = '<span class="label label-success">' . $count . '</span>';
          }
          return $output;
     }

     // function returns particular user's is_type status value
     function fetch_is_type_status($user_id, $connect)
     {
          // get last one activity for is_type
          $query = "
 SELECT is_type FROM login_details 
 WHERE user_id = '" . $user_id . "' 
 ORDER BY last_activity DESC 
 LIMIT 1
 ";
          // prepare query for execution
          $statement = $connect->prepare($query);
          // execute select query
          $statement->execute();
          // fetch query execution result and store in variable
          $result = $statement->fetchAll();
          $output = '';
          // should have only 1 record, but still loop through
          foreach ($result as $row) {
               // if is_type in $result is 'yes'
               if ($row["is_type"] == 'yes') {
                    // $output is set to 'Typing...' othervise blank
                    $output = ' - <small><em><span class="text-muted">Typing...</span></em></small>';
               }
          }
          return $output;
     }

     function fetch_group_chat_history($connect)
     {
          // query to fetch all groupchat message
          $query = "
 SELECT * FROM chat_message 
 WHERE to_user_id = '0'  
 ORDER BY timestamp DESC
 ";
          // make query for execution
          $statement = $connect->prepare($query);
          // execute query
          $statement->execute();
          // save returned result
          $result = $statement->fetchAll();
          // unordered list with list-unstyled bootstrap class 
          $output = '<ul class="list-unstyled">';
          // loop through each line
          foreach ($result as $row) {
               // append sender's username
               $user_name = '';
               // store dinamic chat message to chack if deleted or not
               $chat_message = '';
               $dynamic_background = '';
               // if sender is the user logged in, name = 'you' othervise get username from table
               if ($row["from_user_id"] == $_SESSION["user_id"]) {
                    // if message was deleted
                    if ($row["status"] == '2') {
                         $chat_message = '<em>This message has been removed</em>';
                         $user_name = '<b class="text-success">You</b>';
                         // if message wasn't deleted
                    } else {
                         $chat_message = $row['chat_message'];
                         // dinamic chat remove button
                         $user_name = '<button type="button" class="btn btn-danger btn-xs remove_chat" id="' . $row['chat_message_id'] . '">x</button>&nbsp;<b class="text-success">You</b>';
                    }
                    $dynamic_background = 'background-color:#ffe6e6;';
                    // other than user, who wrote the message
               } else {
                    if ($row["status"] == '2') {
                         $chat_message = '<em>This message has been removed</em>';
                    } else {
                         $chat_message = $row['chat_message'];
                    }
                    $user_name = '<b class="text-danger">' . get_user_name($row['from_user_id'], $connect) . '</b>';
                    $dynamic_background = 'background-color:#ffffe6;';
               }
               // create message to be output on website
               // 1. sender name, message
               // 2. timestamp
               $output .= '
  <li style="border-bottom:1px dotted #ccc;padding-top:8px; padding-left:8px; padding-right:8px;' . $dynamic_background . '">
  <p>' . $user_name . ' - ' . $chat_message . '
      <div align="right">
      - <small><em>' . $row['timestamp'] . '</em></small>
      </div>
  </p>
  </li>
  ';
          }
          $output .= '</ul>';
          // return history of groupchat messaging between all users
          return $output;
     }

     ?>