<?php
require_once '../models/Admin.php';
class AdminController extends BaseController {

    public function __construct() {
        if (!isset($_SESSION['user_logged_in_id'])) {
            header('Location: /login');
            exit;
        } else {
            if(!isset($_SESSION['is_admin'])){
                header('Location: /dashboard');
            }
        }
    }
    

    function displayDashboardAdmin(){
        $adminModel = new Admin();
        $statistics = $adminModel->getDashboardStatistics();
        
        $this->renderAdmin('index', [
            'statistics' => $statistics
        ]);
    }
    function displayClientAdmin(){
        $adminModel = new Admin();
        $user_id = $_SESSION['user_logged_in_id'];
        $users = $adminModel->displayUsers($user_id);
        foreach ($users as $key => $user) {
            $accounts = $adminModel->getAccounts($user['id']);
            $users[$key]['accounts'] = $accounts;
        }
        
        $this->renderView('admin/clients', [
            'users' => $users
        ]);
    }
    
    function displaytransactionsAdmin(){
        $adminModel = new Admin();
        $transactions = $adminModel->getAllTransactions();
        $statistics = $adminModel->getTransactionStatistics();
        
        $this->renderView('admin/transactions', [
            'transactions' => $transactions,
            'statistics' => $statistics
        ]);
    }
    
    public function AddUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouterUtilisateur'])) {
            $adminModel = new Admin();
            $name = htmlspecialchars(trim($_POST['name']));
            $email = htmlspecialchars(trim($_POST['mail']));
            $password = htmlspecialchars(trim($_POST['mdp']));
            $typeCompte = htmlspecialchars(trim($_POST['compteType']));

            if (empty($name) || empty($email) || empty($password) || empty($typeCompte)) {
                return "Veuillez remplir tous les champs.";
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return "Adresse email invalide.";
            }
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $success = $adminModel->insertUser($name, $email, $hashed_password);
            if ($success) {
                $user_id = $adminModel->GetUserID($name);
                $valide = $adminModel->InsertAccount($user_id, $typeCompte);
                header('location: /clients');

                exit();
            } else {
                return "Erreur lors de l'insertion dans la base de données.";
            }
        }
    }
    function displayAccountsAdmin(){
        $adminModel = new Admin();
        $accounts = $adminModel->getComptes();
        $statistics = $adminModel->getAccountStatistics();
        
        $this->renderView('admin/compte', [
            'accounts' => $accounts,
            'statistics' => $statistics
        ]);
    }

    function activation(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['account_action'])) {
            $id = $_POST['id'];
            $action = $_POST['account_action'];
            $adminModel = new Admin();

            $result = $adminModel->activeDesactive($id, $action);
            if ($result) {
                header('location: /compte');
            }
        }
    }

    public function displayComptes() {
        $adminModel = new Admin();
        $accounts = $adminModel->getComptes();
        $statistics = $adminModel->getAccountStatistics();
        
        $this->renderView('admin/compte', [
            'accounts' => $accounts,
            'statistics' => $statistics
        ]);
    }

    public function updateUserController() {
        $id = $_POST['id'];
        $nom = $_POST['name'];
        $email = $_POST['email'];
        $userModel = new User();

       $result= $userModel->updateUser($id, $nom, $email) ;
        if ($result) {
            header('Location: /compte');
        } else {
            echo "Erreur lors de la mise à jour du client.";
        }
    }
}