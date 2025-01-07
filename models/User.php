<?php
require_once(__DIR__.'/../config/db.php');
class User extends DB{
    public function __construct(){
    parent::__construct();
    }
    public function Register($user){
        try{
            $result= $this->conn->prepare("INSERT INTO users(name,email,password,profile_pic) VALUES (?,?,?,?)");
            $result->execute($user);
            return $this->conn->lastInsertId();
        }
        catch(PDOException $e){
            echo "Error:".$e->getMessage();
        }
    }
    public function Login($userD){
        try{
        $result=$this->conn->prepare("SELECT * FROM users WHERE email=?");
        $result->execute([$userD[0]]);
        $user=$result->fetch(PDO::FETCH_ASSOC);
        if($user && password_verify($userD[1],$user["password"])){
        return $user;
    }}
    catch(PDOException $e){
         echo"Error:".$e->getMessage();
    }
    }
    
}