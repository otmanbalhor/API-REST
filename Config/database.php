<?php

class database{

    private $host = "localhost";
    private $dbname = "api";
    private $user = "root";
    private $password = "";
    private $db;



    public function connect(){

        $this->db = null; 

        try {

            $this->db = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname, $this->user,$this->password);

            $this->db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
        } catch(PDOException $e) {
            
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->db;

    }


    
}