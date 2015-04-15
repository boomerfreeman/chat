<?php

// Set and reset error array:
$show = array();

// Include database connection file:
require_once './db.php';

// If any page is set:
if (isset($_GET['page'])) {
    
    // Scan application folder:
    $pages = scandir('./');
    
    // Stop script if this page does not exist in appfolder:
    if (! in_array($_GET['page'].'.php', $pages)) {
        exit('Access denied.');
    } else {
        
        // Otherwise start new session:
        session_start();
        
        // And stop script if user is not logged in:
        if (! $_SESSION['username']) {
            exit('Please log in.');
        }       
        // Set page variaible:
        $page = htmlspecialchars($_GET['page']);
    }    
} else {
    
    // Or set page name to login:
    $page = 'login';
}

// If username and password exist, set variables:
if (isset($_POST['username'], $_POST['password'])) {
    $user = htmlspecialchars($_POST['username']);
    $pass = md5(htmlspecialchars($_POST['password']));
}

// If Login button is pressed:
if (isset($_POST['login'])) {
    
    // Check username and password:
    $row = checkUserData($dbh, $user);
    
    // If typed data is correct:
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
        $show['error'] = 'Wrong username and password';
    }
    
// If Register button is pressed:
} elseif (isset($_POST['register'])) {
    
    // Check username availability:
    $row = checkUserData($dbh, $user);
    
    // If username is taken:
    if ($user == $row['username']) {
        
        // Send error message:
        require_once './login.php';
        $show['error'] = 'This username is already taken';
    } else {
        
        // Otherwise register new user and send notification:
        registerNewUser($dbh, $user, $pass);
        require_once './login.php';
        $show['error'] = 'New user is registered';
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
        <script src="js/jquery.js"></script>
        <script src="js/checkform.js"></script>
        <script src="js/checkmsg.js"></script>
        <script src="js/bootstrap.js"></script>
    </head>
    <?php
    
    // Include returned page:
    require_once "./$page.php";
    
    // If error exist:
    if (! empty($show)) {?>
    
    <!-- Show error message: -->
    <div id="warning"><h4><?=$show['error'];?></h4></div>
    
    <!-- Else show login page without error: -->
    <?php } else { return false; } ?>
</html>
