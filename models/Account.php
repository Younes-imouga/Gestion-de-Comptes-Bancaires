<?php

class Account extends db
{
    public function __construct()
    {
        parent::__construct();
    }
    public function transfer($account_id, $amount, $beneficiary_id)
    {
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

    function displayUserAccounts($user_id)
    {
        try {
            error_log("Searching for accounts with user_id: " . $user_id);
            $sql = "SELECT * FROM accounts WHERE user_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$user_id]);
            $accounts = $stmt->fetchAll(PDO::FETCH_ASSOC);

            error_log("Query results: " . print_r($accounts, true));

            return $accounts;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public function getTransactions($user_id)
    {
        try {
            $sql = "SELECT t.*, 
a1.account_type as sender_account_type,
a1.user_id as sender_user_id,
a2.account_type as beneficiary_account_type,
a2.user_id as beneficiary_user_id
FROM transactions t
JOIN accounts a1 ON t.account_id = a1.id
LEFT JOIN accounts a2 ON t.beneficiary_account_id = a2.id
WHERE a1.user_id = ? OR a2.user_id = ?
ORDER BY t.created_at DESC";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$user_id, $user_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching transactions: " . $e->getMessage());
            return [];
        }
    }

    public function alimenter($account_id, $amount)
    {
        try {
            $this->conn->beginTransaction();


            $sql = "UPDATE accounts SET balance = balance + ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$amount, $account_id]);


            $sql = "INSERT INTO transactions (account_id, transaction_type, amount) VALUES (?, 'depot', ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$account_id, $amount]);

            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            $this->conn->rollBack();
            error_log("Error in alimenter: " . $e->getMessage());
            return false;
        }
    }

    public function retrait($account_id, $amount)
    {
        try {
            $this->conn->beginTransaction();


            $sql = "SELECT balance FROM accounts WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$account_id]);
            $account = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($account['balance'] < $amount) {
                $this->conn->rollBack();
                return false;
            }


            $sql = "UPDATE accounts SET balance = balance - ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$amount, $account_id]);


            $sql = "INSERT INTO transactions (account_id, transaction_type, amount) VALUES (?, 'retrait', ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$account_id, $amount]);

            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            $this->conn->rollBack();
            error_log("Error in retrait: " . $e->getMessage());
            return false;
        }
    }
}
