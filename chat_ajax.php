<?php

// Set Estonian timezone:
date_default_timezone_set("Europe/Tallinn");

// Include database connection file:
require_once './db.php';

// Retrieve login parameter:
session_start();

// If typed message is acceptable:
if (isset($_POST['message'])) {
    
    // Retrieve urgent data:
    $user = $_SESSION['username'];
    $message = htmlspecialchars($_POST['message']);
    $time = date("Y-m-d H:i:s");
    
    // Retrieve user_id of logged in person:
    $query = "SELECT user_id "
           . "FROM users WHERE username = :username";
    
    $stmt = $dbh->prepare($query);
    $stmt->execute(array('username' => $user));
    $row = $stmt->fetch();
    $user_id = $row['user_id'];
    
    // Add message to database
    $query = "INSERT INTO messages (msg_id, user_id, message, time) "
           . "VALUES (:msg_id, :user_id, :message, :time)";
    
    $stmt = $dbh->prepare($query);
    $row = $stmt->execute(array('msg_id' => null, 'user_id' => $user_id, 'message' => $message, 'time' => $time));
    
    // And show it in chatroom:
    echo "<h5><strong>$user: </strong> $message</h5>";    
}
