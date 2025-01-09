<?php
require_once (__DIR__.'/../models/User.php');
require_once (__DIR__.'/../models/Account.php');
class ClientController extends BaseController {
    private $client; 

    public function __construct() {
        if (!isset($_SESSION['user_logged_in_id'])) {
            header('Location: /login');
            exit;
        }
    }

    function displayTransfer(){
        
        $accountModel = new Account();
        $user_id = $_SESSION['user_logged_in_id'];
        
        $accounts = $accountModel->displayUserAccounts($user_id);
        
        $this->renderView('client/virement', [
            'accounts' => $accounts
        ]);
    }
    public function handleTransfer() {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['transfer'])) {
            $sender_acc = $_POST['sender_account'];
            $amount = $_POST['amount'];
            $beneficiary_acc = $_POST['beneficiary_account'];
            
            if ($sender_acc === $beneficiary_acc) {
                $_SESSION['error'] = "Cannot transfer to the same account";
                header('Location: /virement');
                exit;
            }
            
            if (!is_numeric($amount) || $amount <= 0) {
                $_SESSION['error'] = "Invalid amount";
                header('Location: /virement');
                exit;
            }
            
            $account = new account();
            $result = $account->transfer($sender_acc, $amount, $beneficiary_acc);
            
            if ($result === true) {
                $_SESSION['success'] = "Transfer completed successfully";
                header('Location: /dashboard');
            } else {
                $_SESSION['error'] = "Transfer failed: " . $result;
                header('Location: /virement');
            }
            exit;
        }
        
        header('Location: /virement');
        exit;
    }
    function displayDashboard(){
        $accountModel = new Account();
        $user_id = $_SESSION['user_logged_in_id'];
        
        $accounts = $accountModel->displayUserAccounts($user_id);
        $transactions = $accountModel->getTransactions($user_id);
        
        $this->renderView('client/index', [
            'accounts' => $accounts,
            'transactions' => $transactions
        ]);
    }
    function displayTransactions(){
        $accountModel = new Account();
        $user_id = $_SESSION['user_logged_in_id'];
        $transactions = $accountModel->getTransactions($user_id);
        
        $this->renderView('client/historique', [
            'transactions' => $transactions
        ]);
    }
    function displayAccounts(){
        $accountModel = new Account();
        $user_id = $_SESSION['user_logged_in_id'];
        $accounts = $accountModel->displayUserAccounts($user_id);
        
        $this->renderView('client/compte', [
            'accounts' => $accounts
        ]);
    }
    function displayprofile(){
        $this->renderView('client/profile');
    }




    public function handleAlimenterForm() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $account_id = $_POST['account_id'] ?? null;
            $amount = $_POST['amount'] ?? null;
            $payment_method = $_POST['paymentMethod'] ?? null;

            if (!$account_id || !$amount || !$payment_method || !is_numeric($amount) || $amount <= 0) {
                $_SESSION['error'] = "Veuillez remplir tous les champs correctement";
                header('Location: /dashboard');
                exit;
            }

            $account = new Account();
            $result = $account->alimenter($account_id, $amount);

            if ($result) {
                $_SESSION['success'] = "Compte alimenté avec succès de " . number_format($amount, 2, ',', ' ') . " €";
            } else {
                $_SESSION['error'] = "Erreur lors de l'alimentation du compte";
            }

            header('Location: /dashboard');
            exit;
        }
    }

    public function handleRetraitForm() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $account_id = $_POST['account_id'] ?? null;
            $amount = $_POST['amount'] ?? null;

            if (!$account_id || !$amount || !is_numeric($amount) || $amount <= 0) {
                $_SESSION['error'] = "Montant invalide";
                header('Location: /dashboard');
                exit;
            }

            $account = new Account();
            $result = $account->retrait($account_id, $amount);

            if ($result) {
                $_SESSION['success'] = "Retrait effectué avec succès de " . number_format($amount, 2, ',', ' ') . " €";
            } else {
                $_SESSION['error'] = "Solde insuffisant ou erreur lors du retrait";
            }

            header('Location: /dashboard');
            exit;
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: /login');
        exit;
    }
}
?>
