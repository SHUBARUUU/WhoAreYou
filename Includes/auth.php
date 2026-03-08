<!-- OOP PHP -> auth class - to use the established connection through statements
        using oop ensures a proper SoC (Separation of Concerns), additionally
        coding it once and instantiating the object everytime we need it.
-->

<?php
class Auth{
    private $pdo;

    public function __construct($db){
        $this->pdo = $db->getConnection();
    }

    public function login($email, $password){
        try{
            $stmt = $stmt = $this->pdo->prepare("SELECT id, name, email, password FROM whoareyou_users WHERE email = ?");;
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            //  Function returns true and redirects if user is existing in database
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['email'] = $user['email'];
                return true;
            }

            return false;
        }catch(PDOException $e){
            die("Something went wrong. Please try again later. (" . $e->getMessage() . ")");
        }
        
    }
    public function register($name, $email, $password){
        try{
            if ($this->emailIsExisting($email)) return false;
            $passHashed = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $this->pdo->prepare("INSERT INTO whoareyou_users (name, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, $passHashed]);

            return true;
        }catch(PDOException $e){
            die("Something went wrong. Please try again later. (" . $e->getMessage() . ")");
        }
    }

    public function requireLogin(){
        if (!isset($_SESSION['user'])) {
            redirect(" ../index.php");
            exit;
        }
    }

    private function emailIsExisting($email) {
        // Checks the database if email is existing
        $stmt = $stmt = $this->pdo->prepare("SELECT email FROM whoareyou_users WHERE email = ?");;
        $stmt->execute([$email]);
        
        //  returns true if email exists (fetches a row)
        return (bool) $stmt->fetch();
    }


} // end of auth class
?>