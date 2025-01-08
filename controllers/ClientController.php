<?php

require_once (__DIR__.'/../models/User.php');
class ClientController extends BaseController {

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
}
