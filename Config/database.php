<!-- OOP PHP -> Db class - to establish a connection for the database
        using oop ensures a proper SoC (Separation of Concerns), additionally
        coding it once and instantiating the object everytime we need it.
-->

<?php
class Db{
    private $pdo;
    
    public function __construct(){
        try {
            $this->pdo = new PDO("mysql:host=" . DB_HOST .";dbname=" . DB_NAME , DB_USER, DB_PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Something went wrong. Please try again later. (" . $e->getMessage() . ")");
        }
    }

    public function getConnection(){
        return $this->pdo;
    }
    
} // end of Db class
