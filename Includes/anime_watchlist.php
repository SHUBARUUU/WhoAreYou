<?php
    class AnimeWatchlist{
        private $pdo;
        public function __construct($db){
            $this->pdo = $db->getConnection();
            
        }      
//*     Method for adding a new record/anime in the log
        public function addRecord($userId, $title, $status, $episode, $rating,$verdict,$rewatch){
            try{
                $stmt = $this->pdo->prepare("INSERT INTO anime_watchlist(whoareyou_user_id, title, status, episodes, rating, verdict, rewatch) VALUES(?, ?, ?, ?, ?, ?, ?) ");
                $stmt->execute([$userId, $title, $status, $episode, $rating, $verdict, $rewatch]);

                return true;
            }catch(PDOException $e){
                die("Something went wrong. Please try again later. (" . $e->getMessage() . ")");
            }
        }    

//*     Method for updating an existing record
        public function updateRecord($userId, $animeListId, $title, $status, $episode, $rating,$verdict,$rewatch){
            try{
                $stmt = $this->pdo->prepare("UPDATE anime_watchlist SET title = ?, status = ?, episodes = ?, rating = ?, verdict = ?, rewatch = ? WHERE whoareyou_user_id = ? AND id = ?");
                $stmt->execute([$title, $status, $episode, $rating, $verdict, $rewatch, $userId, $animeListId]);

                return true;
            }catch(PDOException $e){
                die("Something went wrong. Please try again later. (" . $e->getMessage() . ")");
            }
        }
        public function deleteRecord($userId, $animeListId){
            try{
                $stmt = $this->pdo->prepare("DELETE FROM anime_watchlist WHERE whoareyou_user_id = ? AND id = ?");
                $stmt ->execute([$userId, $animeListId]);
                
                return true;
            }catch(PDOException $e){
                die("Something went wrong. Please try again later. (" . $e->getMessage() . ")");
            }
        }

        public function getAll($userId){
            $newRecords = [];

            try{
                $stmt = $this->pdo->prepare("SELECT id, title, status, episodes, rating, verdict, rewatch FROM anime_watchlist WHERE whoareyou_user_id = ?");
                $stmt->execute([$userId]);

                //* Output gets fetch as an associate array
                $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                //* Puts user specific rows to a new associative array to be passed on. 
                $index = 1;
                foreach($records as $row){                    
                    $newRecords[] = [
                        "dbAnimeId" => $row["id"],
                        "listNum"=> $index++,
                        "title"  => $row["title"],
                        "status" => $row["status"], 
                        "episode" => $row["episodes"],
                        "rating" => $row["rating"], 
                        "verdict" =>$row["verdict"], 
                        "rewatch" => ($row["rewatch"] == 1? "Yes" : "No")
                    ];
                
                }
            }catch(PDOException $e){
                 die("Something went wrong. Please try again later. (" . $e->getMessage() . ")");
            }

            return $newRecords; 
        }

        //* Checks the current table if the list for User X is exisitng 
        public function checkList($userId){
            try{
                $stmt = $this->pdo->prepare("SELECT * FROM anime_watchlist WHERE whoareyou_user_id = ?");
                $stmt->execute([$userId]);
                //* Output gets fetch as an associate array
                if( $stmt->fetchAll(PDO::FETCH_ASSOC)) return true;
                
                return false;
            }catch(PDOException $e){
                 die("Something went wrong. Please try again later. (" . $e->getMessage() . ")");
            }
        }

        //* Sanitizes the input for the watchlist table data
        public function sanitize($key){
            return !empty($key) ? htmlspecialchars($key, ENT_QUOTES) : "";
        }

    }
?>