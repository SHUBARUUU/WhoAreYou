<!-- init.php (initializes/ sets up the website)  
    This file is required at the top of every page. Sets up everything the website needs to run:
    - starts session
    - connects to database
    - loads all functions to classes
-->
<?php
    session_start(); // Starts the session -> Initializes session

    //  __DIR__ -> magic constant (the folder of the current file/adjusts where to look for file paths)
    require_once(__DIR__ . '/../Config/config.php');
    require_once(__DIR__ .'/../Config/database.php'); // Gets database
    require_once(__DIR__ .'/../Includes/auth.php'); // Gets auth php
    require_once(__DIR__ .'/../Includes/helpers.php'); // Gets helper php

    //  Passes the Db object to auth classs
    $auth = new Auth(new Db());
?>