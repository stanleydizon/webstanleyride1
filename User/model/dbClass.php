<?php
    class dbClass{
        private $hostname = "host=localhost;dbname=stanleyride";
        private $username="root";
        private $password="";
        private $stmt;
        private $con;
        
            public function __construct() {
                try{
                $this->con = new PDO("mysql:$this->hostname",$this->username,$this->password);
                $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }catch(PDOException $e){$e.getMessage();}
            }
            public function query($query){
                $this->stmt = $this->con->prepare($query);
            }
            public function execute($data){
                return $this->stmt->execute($data);
            }
            public function single($data){
                $this->execute($data);
                return $this->stmt->fetch(PDO::FETCH_ASSOC);
            }
            public function resultSet(){
                $this->stmt->execute();
                return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
            }
    }

