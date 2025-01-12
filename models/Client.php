<?php 
include 'User.php';

class client extends User{

    public function __construct(){
        parent::__construct();
        }
       
    function insertTransaction( $amount, $beneficiary_account_id, $transaction_type) {
        try {
            $sql = "INSERT INTO transactions ( amount, beneficiary_account_id, transaction_type)
                    VALUES (?,?,?)";
            
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':account_id', $account_id, PDO::PARAM_INT);
            $stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
            $stmt->bindParam(':beneficiary_account_id', $beneficiary_account_id, PDO::PARAM_INT);
            $stmt->bindParam(':transaction_type', $transaction_type, PDO::PARAM_STR);

            if ($stmt->execute()) {
                return "Transaction insérée avec succès.";
            } else {
                return "Erreur lors de l'insertion de la transaction.";
            }
        } catch (PDOException $e) {
            return "Erreur PDO : " . $e->getMessage();
        }
    }

    
    }
    ?>

