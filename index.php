<?php

// Include database connection file:
require_once './db.php';

// Return page name from GET array:
if (isset($_GET['page'])) {
    $page = htmlspecialchars($_GET['page']);
} else {
    $page = 'login';
}

// If username and password exist and typed correctly:
if (isset($_POST['username'], $_POST['password'])) {
    $user = htmlspecialchars($_POST['username']);
    $pass = md5(htmlspecialchars($_POST['password']));
}

// If Login button is pressed:
if (isset($_POST['login'])) {

    // Retrieve data from database
    $query = "SELECT username, password "
           . "FROM users "
           . "WHERE username = :username";    
    $stmt = $dbh->prepare($query);

    // Using placeholder for security:
    $stmt->execute(array('username' => $user));
    $row = $stmt->fetch();

    // If typed username and password are equal to database data:
    if (($user == $row['username']) && ($pass == $row['password'])) {

        // Start session and insert username to SESSION array:
        session_start();
        $_SESSION['username'] = $user;

        // Then redirect to chatroom and stop script:
        header("Location: ./index.php?page=chat");
        exit();
    } else {
        
        // Otherwise insert login page template with error message:
        require_once './login.php';
        echo '<div id="warning"><h4>Wrong username and password</h4></div>';
    }
    
// If Register button is pressed:
} elseif (isset($_POST['register'])) {

    // Retrieve data from database
    $query = "SELECT username "
           . "FROM users "
           . "WHERE username = :username";    
    $stmt = $dbh->prepare($query);

    $stmt->execute(array('username' => $user));
    $row = $stmt->fetch();

    // If typed username is equal to database, but password is wrong:
    if ($user == $row['username']) {

        // Send error message:
        require_once './login.php';
        echo '<div id="warning"><h4>This username is already taken</h4></div>';
    } else {

        // Or register new user:
        $query = "INSERT INTO users (user_id, username, password) "
               . "VALUES (:user_id, :username, :password)";
        $stmt = $dbh->prepare($query);

        // Using placeholders:
        $stmt->execute(array('user_id' => null, 'username' => $user, 'password' => $pass));
        
        // With success registration message:
        require_once './login.php';
        echo '<div id="warning"><h4>New user is registered</h4></div>';
    }
}
?>
<!-- Print main template: -->
<!DOCTYPE html>
<html lang="EN">
    <head>
        <title>Chatroom</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/style.css">
        <script type="text/javascript" src="js/jquery.js" charset="UTF-8"></script>
        <script type="text/javascript" src="js/bootstrap.js" charset="UTF-8"></script>
    </head>
    <?php
    
    // Include returned page:
    require_once "./$page.php";
    
    ?>
</html>