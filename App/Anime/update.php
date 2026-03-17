<?php
    require_once(__DIR__ . "/../../Includes/init.php");

    $title = $watchlist->sanitize($_POST["updateTitle"]);
    $status = $watchlist->sanitize($_POST["updateStatus"]);
    $episode = (int) $watchlist->sanitize($_POST["updateEpisode"]);
    $rating = (int) $watchlist->sanitize($_POST["updateRating"]);
    $verdict = $watchlist->sanitize($_POST["updateVerdict"]);
    $rewatch = $_POST["updateRewatch"] ?? 0;
  
    
    if(!empty($title) && !empty($verdict)){
        $watchlist->updateRecord($_SESSION["user"], $_POST["updateListId"],$title, $status, $episode, $rating, $verdict, $rewatch);
        redirect("aniLog.php");
    }
?>