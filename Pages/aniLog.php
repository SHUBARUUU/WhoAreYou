<?php
require_once(__DIR__ . "/../Includes/init.php");
$auth->requireLogin();

//! prevent browser caching
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Adds record to the anime log
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["sbmtAdd"])){
    $title = $watchlist->sanitize($_POST["addTitle"]);
    $status = $watchlist->sanitize($_POST["addStatus"]);
    $episode = $watchlist->sanitize($_POST["addEpisode"]);
    $rating = $watchlist->sanitize($_POST["addRating"]);
    $verdict = $watchlist->sanitize($_POST["addVerdict"]);
    $rewatch = $watchlist->sanitize($_POST["addRewatch"]);

    $added = $watchlist->addRecord($_SESSION["user"],$title, $status, $episode, $rating,$verdict,$rewatch);

    if($added){
        redirect("aniLog.php");
        exit();
    }
}

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
        <a href="dashboard.php">
            <h3>Exit</h3>
        </a>
    </nav>
    <main id="content">
        <div id="aboveBtns">
            <form action="" method="POST">
                <input type="button" name="" value="Add" id="addBtn">
                <input type="button" name="" value="Update" id="updateBtn">
                <input type="button" name="" value="Delete" id="deleteBtn">
                <input type="button" name="" value="Search" id="searchBtn">
                <!-- WIP Search bar addition tentative...  -->
                <!-- ADD CONTAINER (WIP) -->
                <div class="invisiContainers" id="addOuterContainer">
                    <div id="addInnerContainer">
                        <h2>ADD A RECORD</h2>
                        <input type="text" name="addTitle" id="" placeholder="Anime title">
                        <input type="text" name="addStatus" id="" placeholder="Status">
                        <input type="text" name="addEpisode" id="" placeholder="Episodes">
                        <input type="text" name="addRating" id="" placeholder="Rating">
                        <input type="text" name="addVerdict" id="" placeholder="Verdict">
                        <input type="text" name="addRewatch" id="" placeholder="Rewatch">
                        <div class="sbmtBtns">
                            <input type="submit" name="sbmtAdd" id="" value="Add">
                            <input type="button" name="sbmtExit" id="" value="Exit">
                        </div>
                    </div>
                </div>
                <div class="invisiContainers" id="updateOuterContainer">
                    <div id="updateInnerContainer">
                        <h2>UPDATE A RECORD</h2>
                        <input type="text" name="" id="" placeholder="Anime title">
                        <input type="text" name="" id="" placeholder="Status">
                        <input type="text" name="" id="" placeholder="Episodes">
                        <input type="text" name="" id="" placeholder="Rating">
                        <input type="text" name="" id="" placeholder="Verdict">
                        <input type="text" name="" id="" placeholder="Rewatch">

                        <div class="sbmtBtns">
                            <input type="button" name="sbmtUpdate" id="" value="Update">
                            <input type="button" name="sbmtExit" id="" value="Exit">
                        </div>
                    </div>
                </div>
                <div class="invisiContainers" id="deleteOuterContainer">
                    <div id="deleteInnerContainer">
                        <h2>Do you wish to delete this log?</h2>
                        <div class="sbmtBtns">
                            <input type="button" name="sbmtDelete" id="" value="Delete">
                            <input type="button" name="sbmtExit" id="" value="Exit">
                        </div>
                    </div>
                </div>
                <div class="invisiContainers" id="searchOuterContainer">
                    <div id="searchInnerContainer">
                        <h2>SEARCH A RECORD</h2>
                        <input type="text" name="" id="" placeholder="Search record">
                        <div class="sbmtBtns">
                            <input type="button" name="sbmtSearch" id="" value="Search">
                            <input type="button" name="sbmtExit" id="" value="Exit">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div id="container">

        </div>
        <div id="focusContent"></div>
    </main>

</body>

</html>