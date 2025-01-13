<?php 

class Db {

    protected $conn ;

    public function __construct()
    {
      try {
        $this->conn = new PDO("mysql:host=localhost;dbname=bank","root","");
        // set the PDO error mode to exception
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //   echo "Connected successfully";
      } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      }
    }

}