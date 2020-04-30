<?php

session_start();
session_destroy();

// after logout, redirect to login page
header('location:index.php');

?>