<?php 

class account extends db {
    public function __construct() {
        parent::__construct();
    }
    public function transfer($account_id, $amount, $beneficiary_id) {
        try {
            $this->conn->beginTransaction();
    
            $balance_sql = "SELECT balance FROM accounts WHERE id = ?";
            $result = $this->conn->prepare($balance_sql);
            $result->execute([$account_id]);
            $row = $result->fetch(PDO::FETCH_ASSOC);
    
            if (!$row) {
                throw new Exception("Sender account not found.");
            }
    
            $sender_balance = $row['balance'];
    
            if ($sender_balance < $amount) {
                throw new Exception("Insufficient balance.");
            }
    
            $new_sender_balance = $sender_balance - $amount;
            $update_sender_sql = "UPDATE accounts SET balance = ? WHERE id = ?";
            $update_sender_stmt = $this->conn->prepare($update_sender_sql);
            $update_sender_stmt->execute([$new_sender_balance, $account_id]);
    
            $beneficiary_sql = "SELECT balance FROM accounts WHERE id = ?";
            $ben_result = $this->conn->prepare($beneficiary_sql);
            $ben_result->execute([$beneficiary_id]);
            $ben_row = $ben_result->fetch(PDO::FETCH_ASSOC);
    
            if (!$ben_row) {
                throw new Exception("Beneficiary account not found.");
            }
    
            $beneficiary_balance = $ben_row['balance'];
    
            $new_beneficiary_balance = $beneficiary_balance + $amount;
            $update_beneficiary_sql = "UPDATE accounts SET balance = ? WHERE id = ?";
            $update_beneficiary_stmt = $this->conn->prepare($update_beneficiary_sql);
            $update_beneficiary_stmt->execute([$new_beneficiary_balance, $beneficiary_id]);
    
            $transaction_sql = "INSERT INTO transactions (account_id, amount, beneficiary_account_id) VALUES (?, ?, ?)";
            $transaction_stmt = $this->conn->prepare($transaction_sql);
            $transaction_stmt->execute([$account_id, $amount, $beneficiary_id]);
    
            $this->conn->commit();
    
            echo "Transfer completed successfully!";
        } catch (Exception $e) {
            $this->conn->rollBack();
            echo "Transfer failed: " . $e->getMessage();
        }
    }
    
}