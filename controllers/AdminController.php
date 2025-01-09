<?php

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
        $this->renderAdmin('clients');
    }
    function displayAccountsAdmin(){
        $this->renderAdmin('compte');
    }
    function displaytransactionsAdmin(){
        $this->renderAdmin('transactions');
    }
}
