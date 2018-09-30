<?php
    include 'dbClass.php';
    class Crud extends dbClass{
        
        private $db;
        public function __construct() {
            $this->db = new dbClass();
        }
        public function Insert($query,$data){
            $this->db->query($query);
            $value = $this->db->execute($data);
            $this->db = null;
            if(!$value){
                die("Error!");
            }
        }
        public function Select($query,$data){
            $this->db->query($query);
            $row = $this->db->single($data);
            return $row;
        }
        public function Update($query,$data){
            $this->db->query($query);
            $this->db->execute($data);
        }
        public function Delete($query,$data){
            $this->db->query($query);
            $this->db->execute($data);
        }
        public function SelectAll($query){
            $this->db->query($query);
            $row = $this->db->resultSet();
            return $row;
        }
    }

