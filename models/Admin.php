<?php 
include 'User.php';

class Admin extends User{

    public function __construct(){
        parent::__construct();
        }
    public function displayUsers($user_id){
        try {
            $sql = "SELECT * FROM users WHERE id != ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$user_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            error_log("Error getting users: " . $e->getMessage());
            return [];
        }
    }
    public function getAccounts($user_id){
        $sql= "SELECT * FROM accounts WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }

}