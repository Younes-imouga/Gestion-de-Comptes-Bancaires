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

    public function displayProfile() {
        $userModel = new User();
        $user = $userModel->getUserById($_SESSION['user_logged_in_id']);
        
        $this->renderView('client/profile', [
            'user' => $user
        ]);
    }

    public function updateProfile() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            
            if (empty($name) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = "Données invalides";
                header('Location: /profile');
                exit;
            }

            $userModel = new User();
            $result = $userModel->updateProfile($_SESSION['user_logged_in_id'], $name, $email);
            
            if ($result) {
                $_SESSION['success'] = "Profil mis à jour avec succès";
            } else {
                $_SESSION['error'] = "Erreur lors de la mise à jour du profil";
            }
            
            header('Location: /profile');
            exit;
        }
    }

    public function updatePassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $current_password = $_POST['current_password'] ?? '';
            $new_password = $_POST['new_password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';
            
            if (empty($current_password) || empty($new_password) || $new_password !== $confirm_password) {
                $_SESSION['error'] = "Mots de passe invalides ou ne correspondent pas";
                header('Location: /profile');
                exit;
            }

            $userModel = new User();
            $result = $userModel->updatePassword($_SESSION['user_logged_in_id'], $current_password, $new_password);
            
            if ($result) {
                $_SESSION['success'] = "Mot de passe mis à jour avec succès";
            } else {
                $_SESSION['error'] = "Mot de passe actuel incorrect";
            }
            
            header('Location: /profile');
            exit;
        }
    }
}
?>
