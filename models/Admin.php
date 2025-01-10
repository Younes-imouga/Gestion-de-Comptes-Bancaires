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
    public function insertUser($name, $email, $password) {
        $query = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $result = $stmt->execute([$name,$email,$password]);
        return $result;
    }

    public function GetUserID($name) {
        // get The Id of the user
        $query= "SELECT id FROM users WHERE name= ?";
        $stmt=$this->conn->prepare($query);
        $stmt->execute([$name]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['id'];
    }
    
    public function InsertAccount($user_id, $typeCompte) {            
        if($typeCompte === "both") {
          
            // 1 - insert epargne

            $query1="INSERT INTO accounts(user_id,account_type) VALUES (?, 'epargne')"; 
            $stmt1 = $this->conn->prepare($query1);
            $result1 = $stmt1->execute([$user_id]);
            // 2 - insert Courant
            $query2="INSERT INTO accounts(user_id,account_type) VALUES (?, 'courant')"; 
            $stmt2 = $this->conn->prepare($query2);
            $result2 = $stmt2->execute([$user_id]);

            if ($result1 && $result2) {
                return true;
            } else {
                return false;
            }

        } else {
            // insert $typeCompte
            $query="INSERT INTO accounts(user_id,account_type) VALUES (?, ?)"; 
            $stmt = $this->conn->prepare($query);
            $result = $stmt->execute([$user_id,$typeCompte]);
            return $result;
        }
    }

    public function getComptes(){
        $sql= " SELECT accounts.*, users.name AS user_name, users.email AS user_email FROM  accounts 
        JOIN users ON accounts.user_id = users.id ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $accounts= $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $accounts ;
 
    }
    public function activeDesactive($id, $action){
            $sql= "UPDATE accounts SET status = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$action, $id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);  

    }
}