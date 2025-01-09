<?php 

class BaseController
{
    public function renderView($view, $data = [])
    {
        extract($data);
        include __DIR__ . '/../views/' . $view . '.php';
    }
    public function renderAdmin($view, $data = [])
    {
        extract($data);
        include __DIR__ . '/../views/admin/' . $view . '.php';
    }
    public function renderUser($view, $data = [])
    {
        extract($data);
        include __DIR__ . '/../views/client/' . $view . '.php';
    }   
    public function logout() {
        session_start();
        session_destroy();
        header('Location: /login');
        exit;
    }
}