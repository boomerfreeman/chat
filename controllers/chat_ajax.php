<?php

// Set Estonian timezone:
date_default_timezone_set("Europe/Tallinn");

// Include database connection file:
require_once '../models/db.php';

// Include query file:
require_once '../models/functions.php';

// Retrieve login parameter:
session_start();

// If typed message is acceptable:
if (isset($_POST['message'])) {
    
    // Retrieve urgent data:
    $user = $_SESSION['username'];
    $message = htmlspecialchars($_POST['message']);
    $time = date("Y-m-d H:i:s");
    
    // Add new message to database:
    sendNewMessage($dbh, $user, $message, $time);
    
    // And show it in chatroom:
    echo "<h5><strong>$user: </strong> $message</h5>";    
}
