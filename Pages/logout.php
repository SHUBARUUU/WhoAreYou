<?php
    require_once(__DIR__ ."/../Includes/init.php");

    session_unset();
    session_destroy();
    redirect("../index.php");
?>