<?php
    
// Start new session:
session_start();

// Redirect to chatroom if session is active:
if ($_SESSION['logged'] == true) {
    $_GET['page'] = 'chat';
}

// Set and reset error array:
$show = array();

// Include database connection file:
require_once './models/db.php';

// Include query file:
require_once './models/functions.php';

// If any page is set:
if (isset($_GET['page'])) {
    
    // Stop script if this page does not exist:
    if (! file_exists('./views/' . $_GET['page'] . '.php')) {
        header("HTTP/1.0 404 Not Found");
        exit;
    } else {
        
        // And stop script if user is not logged in:
        if (! $_SESSION['username']) {
            header("HTTP/1.0 404 Not Found");
            exit('You should log in first.');
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
    preg_match('/^[а-яa-z0-9_.-]{2,20}$/i', $_POST['username'], $user_match);
    preg_match('/^[а-яa-z0-9_.-]{3,}$/i', $_POST['password'], $pass_match);
    
    if (($user_match[0] == true) && ($pass_match[0] == true)) {
        $user = htmlspecialchars($_POST['username']);
        $pass = md5(htmlspecialchars($_POST['password']));
    }
}

// If Login button is pressed:
if (isset($_POST['login'])) {
    
    // Check username and password:
    $row = checkUserData($dbh, $user);
    
    // If typed data is correct:
    if (($user == $row['username']) && ($pass == $row['password'])) {
        
        // Set username and log in status to SESSION array:
        $_SESSION['username'] = $user;
        $_SESSION['logged'] = true;
        
        // Then redirect to chatroom and stop script:
        header("Location: ./index.php?page=chat");
        exit;
    } else {
        
        // Otherwise insert login page template with error message:
        require_once './views/login.php';
        $show['error'] = 'Wrong username and password';
    }
    
// If Register button is pressed:
} elseif (isset($_POST['register'])) {
    
    // Check username availability:
    $row = checkUserData($dbh, $user);
    
    // If username is taken:
    if ($user == $row['username']) {
        
        // Send error message:
        require_once './views/login.php';
        $show['error'] = 'This username is already taken';
    } else {
        
        // Otherwise register new user and send notification:
        registerNewUser($dbh, $user, $pass);
        require_once './views/login.php';
        $show['error'] = 'New user is registered';
    }
}

// If Log out button is pressed:
if (isset($_POST['logout'])) {
    unset($_SESSION);
    session_destroy();
    session_write_close();
    header("Location: ./index.php");
    exit;
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
    require_once "./views/$page.php";
    
    // If error exist:
    if (! empty($show)): ?>
    
    <!-- Show error message: -->
    <div id="warning"><h4><?=$show['error'];?></h4></div>
    
    <!-- Else show login page without error: -->
    <?php endif; ?>
</html>
