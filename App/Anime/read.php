<?php

//? Deciding whether or not to include listNum variable.. (Newly made number of records per user) 
    foreach($newRecords as $record) {
    echo "
        <div class='animeCard'>
                <div class='cardHeader'>
                    <input type='checkbox' class='animeSelect' data-list-id='{$record["dbAnimeId"]}'>
                    <h3 title='{$record["title"]}'>{$record["title"]}</h3>
                    <span class='rating' data-rating='{$record["rating"]}'>{$record["rating"]}/10</span>
                </div>
                <div class='cardBody'>
                    <span class='status' data-status='{$record["status"]}'>{$record["status"]}</span>
                    <p>{$record["episode"]} episode/s</p>
                    <p class='verdict'>{$record["verdict"]}</p>
                    <span class='readMore'>read more</span>
                    <p>Rewatch: {$record["rewatch"]}</p>
                </div>
        </div>
                ";
    }
?>