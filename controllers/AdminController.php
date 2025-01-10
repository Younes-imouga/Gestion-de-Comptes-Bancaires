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
        $this->renderAdmin('index');
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
    
    function displayAccountsAdmin(){
        $this->renderAdmin('compte');
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

}
