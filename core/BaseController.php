<?php 

class BaseController
{
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
}