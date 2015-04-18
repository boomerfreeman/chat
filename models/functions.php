<?php

// Retrieve login and password data function:
function checkUserData($dbh, $user)
{
    $query = "SELECT username, password 
              FROM users 
              WHERE username = :username";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array('username' => $user));
    $row = $stmt->fetch();
    return $row;
}

// Register new user function:
function registerNewUser($dbh, $user, $pass)
{
    $query = "INSERT INTO users (user_id, username, password) 
              VALUES (:user_id, :username, :password)";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array('user_id' => null, 'username' => $user, 'password' => $pass));
}

// Add message to database function:
function sendNewMessage($dbh, $user, $message, $time)
{
    // Retrieve user_id of logged in person:
    $query = "SELECT user_id 
              FROM users 
              WHERE username = :username";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array('username' => $user));
    $row = $stmt->fetch();
    $user_id = $row['user_id'];
    
    // Add new message:
    $query = "INSERT INTO messages (msg_id, user_id, message, time) 
              VALUES (:msg_id, :user_id, :message, :time)";
    $stmt = $dbh->prepare($query);
    $row = $stmt->execute(array('msg_id' => null, 'user_id' => $user_id, 'message' => $message, 'time' => $time));
}
