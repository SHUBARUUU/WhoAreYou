<?php  
    require_once(__DIR__ . "/../../Includes/init.php");
    
    
    $title = $watchlist->sanitize($_POST["addTitle"]);
    $status = $watchlist->sanitize($_POST["addStatus"]);
    $episode = (int) $watchlist->sanitize($_POST["addEpisode"]);
    $rating = (int) $watchlist->sanitize($_POST["addRating"]);
    $verdict = $watchlist->sanitize($_POST["addVerdict"]);
    $rewatch = $_POST["addRewatch"] ?? 0;

    if(!empty($title) && !empty($verdict)){
        $watchlist->addRecord($_SESSION["user"],$title, $status, $episode, $rating, $verdict, $rewatch);
        redirect("aniLog.php");
    }
?>