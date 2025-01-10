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

    public function getAllTransactions() {
        try {
            $sql = "SELECT t.*, 
                a1.account_type as sender_account_type,
                a1.user_id as sender_user_id,
                u1.name as sender_name,
                a2.account_type as beneficiary_account_type,
                a2.user_id as beneficiary_user_id,
                u2.name as beneficiary_name
                FROM transactions t
                JOIN accounts a1 ON t.account_id = a1.id
                LEFT JOIN accounts a2 ON t.beneficiary_account_id = a2.id
                LEFT JOIN users u1 ON a1.user_id = u1.id
                LEFT JOIN users u2 ON a2.user_id = u2.id
                ORDER BY t.created_at DESC";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            error_log("Error fetching all transactions: " . $e->getMessage());
            return [];
        }
    }
    public function getTransactionStatistics() {
        try {
            // Get total deposits
            $sqlDeposits = "SELECT COALESCE(SUM(amount), 0) as total, COUNT(*) as count 
                           FROM transactions 
                           WHERE transaction_type = 'depot'";
            $stmtDeposits = $this->conn->query($sqlDeposits);
            $deposits = $stmtDeposits->fetch(PDO::FETCH_ASSOC);

            // Get total withdrawals
            $sqlWithdrawals = "SELECT COALESCE(SUM(amount), 0) as total, COUNT(*) as count 
                              FROM transactions 
                              WHERE transaction_type = 'retrait'";
            $stmtWithdrawals = $this->conn->query($sqlWithdrawals);
            $withdrawals = $stmtWithdrawals->fetch(PDO::FETCH_ASSOC);

            // Get total transfers
            $sqlTransfers = "SELECT COALESCE(SUM(amount), 0) as total, COUNT(*) as count 
                            FROM transactions 
                            WHERE transaction_type = 'transfert'";
            $stmtTransfers = $this->conn->query($sqlTransfers);
            $transfers = $stmtTransfers->fetch(PDO::FETCH_ASSOC);

            // Get total volume (sum of all account balances)
            $sqlTotalVolume = "SELECT COALESCE(SUM(balance), 0) as total FROM accounts";
            $stmtTotalVolume = $this->conn->query($sqlTotalVolume);
            $totalVolume = $stmtTotalVolume->fetch(PDO::FETCH_ASSOC)['total'];

            // Get total transaction count
            $totalCount = $deposits['count'] + $withdrawals['count'] + $transfers['count'];

            // Get yesterday's transaction count for comparison
            $sqlYesterday = "SELECT COUNT(*) as count 
                            FROM transactions 
                            WHERE DATE(created_at) = DATE(NOW() - INTERVAL 1 DAY)";
            $stmtYesterday = $this->conn->query($sqlYesterday);
            $yesterdayCount = $stmtYesterday->fetch(PDO::FETCH_ASSOC)['count'];

            // Calculate percentage change
            $percentageChange = $yesterdayCount > 0 
                ? (($totalCount - $yesterdayCount) / $yesterdayCount) * 100 
                : 0;

            return [
                'total_count' => $totalCount,
                'total_volume' => $totalVolume,
                'total_deposits' => $deposits['total'],
                'total_withdrawals' => $withdrawals['total'],
                'total_transfers' => $transfers['total'],
                'percentage_change' => $percentageChange
            ];
        } catch(PDOException $e) {
            error_log("Error getting transaction statistics: " . $e->getMessage());
            return null;
        }
    }

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