<?php

require_once (__DIR__.'/../models/Client.php');
class ClientController extends BaseController {
    private $client; 

    public function __construct() {
        $this->client = new Client();
    }
    function displayTransfer(){
        $accountModel = new account;
        $user_id = $_SESSION['user_logged_in_id'];

        $accounts = $accountModel->displayUserAccounts($user_id);

        $this->renderView('client/virement');
    }
    public function handleTransfer(){
      
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['transfer'])){
            $sender_acc = $_POST['sender_account'];
            $amount = $_POST['amount'];
            $beneficiary_acc = $_POST['beneficiary_account'];
            
            $account = new account();
            $account->transfer($sender_acc, $amount, $beneficiary_acc);
            
            exit;

        } else {
            echo "failed";die;
        }
    }
    function displayDashboard(){
        $this->renderView('client/index');
    }
    
    public function handleAlimenterForm() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $account_id = $_POST['account_id'] ?? null;
            $amount = $_POST['amount'] ?? null;
        

            if (empty($account_id) || empty($amount)) {
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
