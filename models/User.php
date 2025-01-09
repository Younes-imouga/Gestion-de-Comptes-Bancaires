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
                $checkAdmin = "SELECT * FROM users ORDER BY id ASC LIMIT 1";
                $adminResult = $this->conn->query($checkAdmin);
                $admin = $adminResult->fetch(PDO::FETCH_ASSOC);
                
                if ($user['email'] === $admin['email']) {   
                    $_SESSION['is_admin'] = true;
                } else {
                    $_SESSION['is_admin'] = false;
                } 

                return $user;
            } else {
                return false;
            }
        }
        catch(PDOException $e){
            echo"Error:".$e->getMessage();
            return false;
        }
    }

    public function GetIdByName() {
        $sql = "SELECT * FROM users";
    }

    public function getUserById($id) {
        try {
            $sql = "SELECT id, name, email FROM users WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            error_log("Error getting user: " . $e->getMessage());
            return null;
        }
    }

    public function updateProfile($id, $name, $email) {
        try {
            $sql = "UPDATE users SET name = ?, email = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$name, $email, $id]);
        } catch(PDOException $e) {
            error_log("Error updating profile: " . $e->getMessage());
            return false;
        }
    }

    public function updatePassword($id, $current_password, $new_password) {
        try {
            $sql = "SELECT password FROM users WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!password_verify($current_password, $user['password'])) {
                return false;
                die;
            }

            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET password = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$hashed_password, $id]);
        } catch(PDOException $e) {
            error_log("Error updating password: " . $e->getMessage());
            return false;
            die;
        }
    }

    public function getAllUsers() {
        try {
            $sql = "SELECT id, name, email FROM users WHERE role = 'client'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            error_log("Error getting users: " . $e->getMessage());
            return [];
        }
    }

}