<?php

class AuthController extends BaseController {
    private $User;

    function displayLogin(){
        $this->renderView('login');
    }
    function displaySignUp(){
        $this->renderView('signup');
    }

}