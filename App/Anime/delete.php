<?php
    $watchlist->deleteRecord($_SESSION["user"], $_POST["removeListId"]);
    redirect("aniLog.php");
?>