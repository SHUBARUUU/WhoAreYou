<?php
    class anime_watchlist{
        private $pdo;
        public function __construct($db){
            $this->pdo = $db->getConnection();
            
        }      
        public function addRecord($userId, $title, $status, $episode, $rating,$verdict,$rewatch){
            try{
                if($title == "" || $status == "" || $episode == ""|| $rating == ""|| $verdict == "")return false;

                $stmt = $this->pdo->prepare("INSERT INTO anime_watchlist(whoareyou_user_id, title, status, episodes, rating, verdict, rewatch) VALUES(?, ?, ?, ?, ?, ?, ?) ");
                $stmt->execute([$userId, $title, $status, $episode, $rating, $verdict, $rewatch]);

                return true;
            }catch(PDOException $e){
                die("Something went wrong. Please try again later. (" . $e->getMessage() . ")");
            }
        }    

        public function sanitize($key){
            return !empty($key) ? htmlspecialchars($key, ENT_QUOTES) : "";
        }

    }
?>