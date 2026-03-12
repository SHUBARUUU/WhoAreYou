<?php
    require_once(__DIR__ . "/../Includes/init.php");
    $auth -> requireLogin();

    //! prevent browser caching
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: 0");



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AniLog</title>

    <link rel="stylesheet" href="../Assets//CSS/global.css">
    <link rel="stylesheet" href="../Assets/CSS/anilog_dsn.css">

    <script src="../Assets/JS/anilog_scpt.js" defer></script>
</head>
<body>
    <nav>
        <div id="totoroNsign">
            <h2>AniLog</h2>
            <img src="../Assets/Img/FaviconGhibli.png" alt="Exit">
        </div>
        <a href="dashboard.php"><h3>Exit</h3></a>
    </nav>
    <main id="content">
        <div id="aboveBtns">
            <form action="" method="POST">
                <input type="button" name="sbmtAdd" value="Add" id="addBtn">
                <input type="button" name="sbmtUpdate" value="Update" id="updateBtn">
                <input type="button" name="sbmtDelete" value="Delete">
                <input type="button" name="sbmtSearch" value="Search">
                <!-- WIP Search bar addition tentative...  -->
                 <!-- ADD CONTAINER (WIP) -->
                <div class="invisiContainers" id="addContainer">
                    <input type="text" name="" id="" placeholder="Anime title">
                    <input type="text" name="" id="" placeholder="Status">
                    <input type="text" name="" id="" placeholder="Episodes">
                    <input type="text" name="" id="" placeholder="Rating">
                    <input type="text" name="" id="" placeholder="Verdict">
                    <input type="text" name="" id="" placeholder="Rewatch">
                </div>
                
                <!-- UPDATE CONTAINER (WIP) -->
                <div class="invisiContainers" id="updateContainer">
                    <input type="text" name="" id="" placeholder="DONT BE RACIST">
                </div>
             </form>
        </div>
        <div id="container">
            
        </div>
        <!-- BACKGROUND UNFOCUSED (DECIDING) -->
        <!-- <div id="unfocusContent"></div> -->
    </main>
    
</body>
</html>