<?php

require_once (__DIR__.'/../models/User.php');
class ClientController extends BaseController {
    private $client; 

    public function __construct() {
        parent::__construct();
        $this->client = new Client();
    }
    function displayTransfer(){
        $this->renderView('client/virement');
    }
    public function handleTransfer(){
      
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
          
            if (isset($_POST['transfer'])) {
                $sender_acc = $_POST['sender_account'];
                
                exit;
            } else {
            echo "failed";die;
            }
        }
    }
    function displayDashboard(){
        $this->renderView('client/index');
    }
    public function handleAlimenterForm() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $account_id = $_POST['account_id'] ?? null;
            $amount = $_POST['amount'] ?? null;
            $beneficiary_account_id = $_POST['beneficiary_account_id'] ?? null;
            $transaction_type = $_POST['paymentMethod'] ?? null;

            if (empty($account_id) || empty($amount) || empty($transaction_type)) {
                echo "Tous les champs obligatoires doivent être remplis.";
                return;
            }

            if (!is_numeric($amount) || $amount <= 0) {
                echo "Le montant doit être un nombre positif.";
                return;
            }
            $result = $this->client->insertTransaction($account_id, $amount, $beneficiary_account_id, $transaction_type);
            echo $result;
        } else {
            echo "Méthode non autorisée.";
        }
    }
}
?>
