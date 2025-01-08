<?php
require_once(__DIR__.'/../config/db.php');
class User extends DB{
    public function __construct(){
    parent::__construct();
    }
    public function Register($user) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO users(name, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$user[0], $user[1], $user[2]]);
            $lastInsertId = $this->conn->lastInsertId();

            $checkAdmin = "SELECT * FROM users ORDER BY id ASC LIMIT 1";
            $adminResult = $this->conn->query($checkAdmin);
            $admin = $adminResult->fetch(PDO::FETCH_ASSOC);

            if ($user[1] === $admin['email']) {
                $_SESSION['is_admin'] = true;
            } else {
                $_SESSION['is_admin'] = false;
            }
            return $lastInsertId; 
            
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false; 
        }
    }
    public function Login($userD){
        try{
        $result=$this->conn->prepare("SELECT * FROM users WHERE email=?");
        $result->execute([$userD[0]]);
        $user=$result->fetch(PDO::FETCH_ASSOC);
        if($user && password_verify($userD[1],$user["password"])){
        return $user;

    }}
    catch(PDOException $e){
         echo"Error:".$e->getMessage();
    }
    }

    public function GetIdByName() {
        $sql = "SELECT * FROM users";
    }

    
}