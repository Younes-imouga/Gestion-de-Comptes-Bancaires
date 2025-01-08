<?php

require_once (__DIR__.'/../models/User.php');
class ClientController extends BaseController {

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
}
