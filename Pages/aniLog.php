<?php
require_once(__DIR__ . "/../Includes/init.php");
$auth->requireLogin();

//! prevent browser caching
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

$hasRecords = false;
if($watchlist->checkList($_SESSION["user"])) {
    $newRecords = $watchlist->getAll($_SESSION["user"]);    
    $hasRecords = true;
}

// Adds record to the anime log
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["sbmtAdd"])){
    require_once(__DIR__ ."/../App/Anime/create.php");  
}
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["sbmtUpdate"]) && $hasRecords){
    require_once(__DIR__ . "/../App/Anime/update.php");
}if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["sbmtDelete"]) && $hasRecords){
    require_once(__DIR__ . "/../App/Anime/delete.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AniLog</title>
    <link rel="shortcut icon" href="../Assets/Img/FaviconGhibli.png" type="image/x-icon">

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
                <div class="invisiContainers" id="addOuterContainer">
                    <div id="addInnerContainer">
                        <h2>ADD A RECORD</h2>
                        <input type="text" name="addTitle" id="addAnimeTitle" placeholder="Anime title">
                        <span id="addTitle-err" class="err"></span>

                        <select name="addStatus" id="">
                            <option value="Plan to Watch">Plan to Watch</option>
                            <option value="Watching">Watching</option>
                            <option value="Completed">Completed</option>
                            <option value="Dropped">Dropped</option>
                        </select>

                        <div class="counters">
                            <h4>Episodes:</h4>
                            <button type="button" id="epMinus">-</button>
                            <input type="number" id="addEpisode" name="addEpisode" value="1" min="1" max="50" placeholder="1">
                            <button type="button" id="epPlus">+</button>
                        </div>
                        <span id="addEp-err" class="err"></span>

                       <div class="counters">
                            <h4>Rating:</h4>
                             <button type="button" id="rateMinus">-</button>
                            <input type="number" id="addRating" name="addRating" value="1" min="1" max="10" placeholder="1">
                            <button type="button" id="ratePlus">+</button>
                        </div>
                        <span id="addRate-err" class="err"></span>

                        <textarea name="addVerdict" id="addAnimeVerdict" placeholder="Verdict"></textarea>
                        <span id="addVerdict-err" class="err"></span>

                        <label class="toggle">
                            <h4>Rewatch?</h4>
                            <input type="checkbox" name="addRewatch" value="1">
                            <span class="slider"></span>
                            <span class="toggleLabel" id="addLbl">No</span>
                        </label>
                        <div class="sbmtBtns">
                            <!-- always in the form but disabled by default (The submit button checker per container) -->
                            <input type="hidden" name="sbmtAdd" id="hiddenSbmtAdd" value="1" disabled>
                            <input type="submit" id="sbmtAdd" value="Add">
                            <input type="button" name="sbmtExit" id="" value="Exit">
                        </div>
                    </div>
                </div>
                <div class="invisiContainers" id="updateOuterContainer">
                    <div id="updateInnerContainer">
                        <h2>UPDATE A RECORD</h2>
                        <input type="text" name="updateTitle" id="updateAnimeTitle" placeholder="Anime title">
                        <span id="updateTitle-err" class="err"></span>

                        <select name="updateStatus" id="">
                            <option value="Plan to Watch">Plan to Watch</option>
                            <option value="Watching">Watching</option>
                            <option value="Completed">Completed</option>
                            <option value="Dropped">Dropped</option>
                        </select>

                        <div class="counters">
                            <h4>Episodes:</h4>
                             <button type="button" id="updateEpMinus">-</button>
                            <input type="number" name="updateEpisode" value="1" min="1" max="50" placeholder="1">
                            <button type="button" id="updateEpPlus">+</button>  
                        </div>

                       <div class="counters">
                            <h4>Rating:</h4>
                            <button type="button" id="updateRateMinus">-</button>
                            <input type="number" name="updateRating" value="1" min="1" max="10" placeholder="1">
                            <button type="button" id="updateRatePlus">+</button> 
                        </div>
                        
                        <textarea name="updateVerdict" id="updateAnimeVerdict" placeholder="Verdict"></textarea>
                        <span id="updateVerdict-err" class="err"></span>

                        <label class="toggle">
                            <h4>Rewatch?</h4>
                            <input type="checkbox" name="updateRewatch" value="1">
                            <span class="slider"></span>
                            <span class="toggleLabel" id="updateLbl">No</span>
                        </label>
                        <div class="sbmtBtns">
                            <input type="hidden" name="sbmtUpdate" id="hiddenSbmtUpdate" value="1" disabled>
                            <input type="submit" name="sbmtUpdate" id="sbmtUpdate" value="Update">
                            <input type="button" name="sbmtExit" id="" value="Exit">
                            <!-- The list id of the data  -->
                            <input type="hidden" value="" name="updateListId" id="updateListId"></input>
                        </div>
                    </div>
                </div>
                <div class="invisiContainers" id="deleteOuterContainer">
                    <div id="deleteInnerContainer">
                        <h2>Do you wish to delete this log?</h2>
                        <div class="sbmtBtns">
                            <input type="hidden" name="sbmtDelete" id="hiddenSbmtRemove" value="1" disabled>
                            <input type="submit" name="sbmtDelete" id="sbmtDelete" value="Delete">
                            <input type="button" name="sbmtExit" id="" value="Exit">
                            <!-- The list id of the data  -->
                            <input type="hidden" value="" name="removeListId" id="removeListId"></input>
                        </div>
                    </div>
                </div>
                <div class="invisiContainers" id="searchOuterContainer">
                    <div id="searchInnerContainer">
                        <h2>SEARCH A RECORD</h2>
                        <input type="text" name="" id="searchValue" placeholder="Search record">
                        <div class="sbmtBtns">
                            <input type="button" id="sbmtSearch" value="Search">
                            <input type="button" name="sbmtExit" id="" value="Exit">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div id="container">
            <?php if($hasRecords): ?>
                <?php include(__DIR__ . "/../App/Anime/read.php") ?>
            <?php else: ?>
                <h2>No anime logged yet. Try again!</h2> 
            <?php endif;?>
        </div>
        <div id="focusContent"></div>
    </main>

</body>

</html>