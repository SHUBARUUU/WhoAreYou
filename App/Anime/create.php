<?php  
    require_once(__DIR__ . "/../../Includes/init.php");
    
    
    $title = $watchlist->sanitize($_POST["addTitle"]);
    $status = $watchlist->sanitize($_POST["addStatus"]);

//* Added an extra validator for server side (Must be within the range to be added or default to 0)
    $episode = (int) $_POST["addEpisode"] >= 1 && $_POST["addEpisode"] < 500? $_POST["addEpisode"] : 1;
    $episode = (int) $watchlist->sanitize($episode);
    
    $rating = (int) $_POST["addRating"] >= 1 && $_POST["addRating"] < 10? $_POST["addRating"] : 1;
    $rating = (int) $watchlist->sanitize($rating);

    $verdict = $watchlist->sanitize($_POST["addVerdict"]);
    $rewatch = $_POST["addRewatch"] ?? 0;

    if(!empty($title) && !empty($verdict)){
        $watchlist->addRecord($_SESSION["user"],$title, $status, $episode, $rating, $verdict, $rewatch);
        redirect("aniLog.php");
    }
?>