<!--
//chat.php
!-->

<?php

//db connection
include 'db_connection.php';

session_start();
// if not logged in, redirects to login.php to login
if (!isset($_SESSION['user_id'])) {
    header('location:../login.php');
}
?>

<html>

<head>
    <title>Chat Application using PHP Ajax Jquery</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>

</head>

<body>
    <div class="background">
        <?php include "header.html" ?>

        <div style="padding-top: 150px; >
    <div class=" container">

            <h3 align="center">Send message or start chatting with your perfect match</a></h3><br />
            <br />
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 bg-light text-dark">

                    <div class="col-md-8 col-sm-6">
                        <h4>Online User</h4>
                    </div>
                    <div class="col-md-2 col-sm-3">
                        <!--identify if groupchat dialog box open or not-->
                        <input type="hidden" id="is_active_group_chat_window" value="no" />
                        <!--group chat button-->
                        <button type="button" name="group_chat" id="group_chat" class="btn btn-warning btn-xs">Group Chat</button>
                    </div>
                </div>
            </div>
            <!--display registered users-->
            <div class="table-responsive">

                <!--display user deatils on webpage-->
                <div id="user_details"></div>
                <div id="user_model_details"></div>
            </div>
        </div>
    </div>
    </div>
    <?php include "../footer.html" ?>
</body>

</html>

<!--create group chat dialog box with JQuery interface library-->
<!--title to be seen on top pf the dialog box-->
<div id="group_chat_dialog" title="Group Chat Window">
    <!-- for group chat history-->
    <div id="group_chat_history">

    </div>
    <!--text area where user can type message-->
    <div class="form-group">
        <!-- <textarea name="group_chat_message" id="group_chat_message" class="form-control"></textarea>   -->
        <div class="chat_message_area">
            <div id="group_chat_message" contenteditable class="form-control">

            </div>
            <div class="image_upload">
                <form id="uploadImage" method="post" action="upload.php">
                    <label for="uploadFile"><img src="upload.png" /></label>
                    <input type="file" name="uploadFile" id="uploadFile" accept=".jpg, .png" />
                </form>
            </div>
        </div>
    </div>
    <!--send button-->
    <div class="form-group" align="right">
        <button type="button" name="send_group_chat" id="send_group_chat" class="btn btn-info">Send</button>
    </div>
</div>


<!--JQuery function to fetch user details from login table and display it on webpage (all users, who is logged in and who isn't) -->
<script>
    $(document).ready(function() {
        // call fetch_user() when page loads
        fetch_user();
        // update user_detail table with user activity in every 5 sec with ajax
        setInterval(function() {
            update_last_activity();
            // refresh user status on webpage
            fetch_user();
            // refresh chat dialog box (with updated data)
            update_chat_history_data();
            // refresh groupchat dialog box
            fetch_group_chat_history();
        }, 5000);

        function fetch_user() {

            $.ajax({
                // send request to fetch_user.php
                url: "fetch_user.php",
                // post method to send data to server
                method: "POST",
                // success callback function called if request completed successfuly and receives data form server, what we can access form data argument
                success: function(data) {
                    // dispaly user details under user_details <div> tag (line 37)
                    $('#user_details').html(data);
                }
            })
        }
        // send ajax request to update user's last login activity in db
        function update_last_activity() {
            $.ajax({
                // send request to update_last_activity.php page
                url: "update_last_activity.php",
                // this function is called if request completed successfully
                success: function() {

                }
            })
        }
        // make dinamic chat dialogue box for every user when start chat button is clicked
        function make_chat_dialog_box(to_user_id, to_user_name) {
            //thiss part dinamicaly generates name and id
            var modal_content = '<div id="user_dialog_' + to_user_id + '" class="user_dialog" title="You have chat with ' + to_user_name + '">';
            // append chat history
            modal_content += '<div class="chat_history" data-touserid="' + to_user_id + '" id="chat_history_' + to_user_id + '">';
            // to display chat message on dialog box pop-up
            modal_content += fetch_user_chat_history(to_user_id);
            // append close div (html)
            modal_content += '</div>';
            modal_content += '<div class="form-group">';
            // append textarea section to thml
            modal_content += '<textarea name="chat_message_' + to_user_id + '" id="chat_message_' + to_user_id + '" class="form-control chat_message"></textarea>'; // append 'send' button
            modal_content += '</div><div class="form-group" align="right">';
            modal_content += '<button type="button" name="send_chat" id="' + to_user_id + '" class="btn btn-info send_chat">Send</button></div></div>';
            // for storing jQuery ui dialogue box
            $('#user_model_details').html(modal_content);
        }
        // dialogue box will pop-up when chat button is clicked
        $(document).on('click', '.start_chat', function() {
            // fetch value of user_id and username from data
            var to_user_id = $(this).data('touserid');
            var to_user_name = $(this).data('tousername');
            // make dinamic chat dialogue box for particular user
            make_chat_dialog_box(to_user_id, to_user_name);
            //initialize jQuery dialog box plug-in on webpage
            $("#user_dialog_" + to_user_id).dialog({
                // initially hide caht window on webpage
                autoOpen: false,
                width: 400
            });
            // show dialogue box pop-up on webpage
            $('#user_dialog_' + to_user_id).dialog('open');
            // initialize emoji plugin in textarea field
            $('#chat_message_' + to_user_id).emojioneArea({
                // place emlji box at top of textarea
                pickerPosition: "top",

            });

        });
        // !!!insert chat message into database
        $(document).on('click', '.send_chat', function() {
            // fetch 'id' attribute and store in lariable
            var to_user_id = $(this).attr('id');
            // fetch value of textarea and stores it in variable
            var chat_message = $('#chat_message_' + to_user_id).val();
            // ajax request to insert message to db
            $.ajax({
                url: "insert_chat.php",
                method: "POST",
                data: {
                    to_user_id: to_user_id,
                    chat_message: chat_message
                },
                success: function(data) {
                    // if query was successful, clear textarea
                    //$('#chat_message_'+to_user_id).val('');
                    // because of emojies, replace above line to clear textarea with emoji
                    var element = $('#chat_message_' + to_user_id).emojioneArea();
                    element[0].emojioneArea.setText('');
                    // update chat history
                    $('#chat_history_' + to_user_id).html(data);
                }
            })
        });
        //function to fetch particular user chat history
        function fetch_user_chat_history(to_user_id) {
            // ajax request to fetch user chat history
            $.ajax({
                url: "fetch_user_chat_history.php",
                method: "POST",
                // user_id will be sent to server
                data: {
                    to_user_id: to_user_id
                },
                // if request completed successfully and received chat history from server, store it as 'data'
                success: function(data) {
                    // display chat history data under division tag
                    $('#chat_history_' + to_user_id).html(data);
                }
            })
        }
        // to update chat history in real time
        // fetch that history data of all user and display under chat dialog box
        function update_chat_history_data() {
            // access all html field who's calss is chat_history
            $('.chat_history').each(function() {
                // fetch value of 'this data' to_user_id attribute and store it in variable
                var to_user_id = $(this).data('touserid');
                // fetch chat history of particular user and display it under chat dialog box
                fetch_user_chat_history(to_user_id);
            });
        }

        $(document).on('click', '.ui-button-icon', function() {
            $('.user_dialog').dialog('destroy').remove();
            $('#is_active_group_chat_window').val('no');
        });

        // !!!to introduce 'typing...' while sender types
        // this code executes if cursor comes into textarea field
        $(document).on('focus', '.chat_message', function() {
            // if cursor in textarea, is_type enum set to 'yes' othervise 'no'
            var is_type = 'yes';
            // dinamic ajax request to server
            $.ajax({
                url: "update_is_type_status.php",
                method: "POST",
                // data to be sent to the server
                data: {
                    is_type: is_type
                },
                // if request has completed successfully
                success: function() {

                }
            })
        });

        // if cursor left the textarea, is_type enum set back to 'no'
        $(document).on('blur', '.chat_message', function() {
            var is_type = 'no';
            // dinamic ajax request to server
            $.ajax({
                url: "update_is_type_status.php",
                method: "POST",
                // data to be sent to the server
                data: {
                    is_type: is_type
                },
                // callback function is called, if request has completed successfully
                success: function() {

                }
            })
        });
        // to initialize JQuery UI dialog plugin on '#group_chat_dialog' tag for groupchat dialog
        $('#group_chat_dialog').dialog({
            // not to pop-up on page load
            autoOpen: false,
            width: 400
        });
        // !!!pop-up groupchat dilaog box
        // when we clicked on groupchat button, this block of code will execute
        $('#group_chat').click(function() {
            // to pop-up dialog box
            $('#group_chat_dialog').dialog('open');
            // change hiden field value to yes
            $('#is_active_group_chat_window').val('yes');
            // when groupchat button clicked, user can see latest messages
            fetch_group_chat_history();
        });
        // insert group chat message
        // when we have clicked on send button
        $('#send_group_chat').click(function() {
            //store textarea field value in variable
            var chat_message = $.trim($('#group_chat_message').html());
            // store insert_data operation in variable
            var action = 'insert_data';
            if (chat_message != '') {
                // ajax request to server
                $.ajax({
                    url: "group_chat.php",
                    method: "POST",
                    // vata values to be sent to the server
                    data: {
                        chat_message: chat_message,
                        action: action
                    },
                    //  if request completed successfully and will receive data from server
                    success: function(data) {
                        //clear value for textarea field
                        $('#group_chat_message').html('');
                        // display latest history message
                        $('#group_chat_history').html(data);
                    }
                })
            } else {
                alert('Type something');
            }
        });
        // fetch latest data of groupchat message
        function fetch_group_chat_history() {
            // store hidden field value
            var group_chat_dialog_active = $('#is_active_group_chat_window').val();
            // define action
            var action = "fetch_data";
            // id groupchat dialog window is active
            if (group_chat_dialog_active == 'yes') {
                // ajax server request
                $.ajax({
                    url: "group_chat.php",
                    method: "POST",
                    // data to be sent to server
                    data: {
                        action: action
                    },
                    // if request completes successfully
                    success: function(data) {
                        // diaplay latest groupchat message in dialog box
                        $('#group_chat_history').html(data);
                    }
                })
            }
        }

        // to upload picture file
        $('#uploadFile').on('change', function() {
            $('#uploadImage').ajaxSubmit({
                target: "#group_chat_message",
                resetForm: true
            });
        });

        // to remove chat, when user clicks on remove button, this will execute
        $(document).on('click', '.remove_chat', function() {
            // fetch message id to be removed
            var chat_message_id = $(this).attr('id');
            // confirm pop-up
            if (confirm("Are you sure you want to remove this chat?")) {
                // id ok clicked, ajax request executed
                $.ajax({
                    url: "remove_chat.php",
                    method: "POST",
                    data: {
                        chat_message_id: chat_message_id
                    },
                    // success callback function
                    success: function(data) {
                        // fetch latest message data (without the removed message)
                        update_chat_history_data();
                    }
                })
            }
        });
    });
</script>