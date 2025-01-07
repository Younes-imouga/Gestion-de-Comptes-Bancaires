<?php

require_once (__DIR__.'/../models/User.php');
    class AuthController extends BaseController {
        private $User;
        public function __construct(){

            $this->User = new User();
      
            
         }

      
    
        function displayLogin(){
            $this->renderView('auth/login');
        }
        public function displaySignUp(){
            $this->renderView('auth/signup');
        }

        public function handleRegister(){

      
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
              
                if (isset($_POST['signup'])) {
                  echo "<pre>";
                  var_dump($_POST);
      
                   $name = $_POST['name'];
                   $email = $_POST['email'];
                   $password = $_POST['password'];
                   $hashed_password = password_hash($password, PASSWORD_DEFAULT);
      
                   $user = [$name,$hashed_password,$email];
      
                   
      
                   $lastInsertId = $this->User->register($user);
      
                   
                  
                       $_SESSION['user_loged_in_id'] = $lastInsertId ;
                       
       
                       if ($lastInsertId ) {
                           header('Location: /admin');
                       } else if ($lastInsertId ) {
                           header('Location: /client');
                       } else if ($lastInsertId) {
                           header('Location: /freelancer');
                       }                    
                       
                       exit;
                   
               }
               else {
                echo "failed";die;
            }
            } 
         }
    }

?>