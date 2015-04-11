<?php

// Prevent script from adding new value to array:
$opt = array();

// Database parameters:
$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_pass = '';
$mysql_db = 'chat';

// Data source name type:
$dsn = "mysql:host=$mysql_host;dbname=$mysql_db";
$opt = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);

$dbh = new PDO($dsn, $mysql_user, $mysql_pass, $opt);
