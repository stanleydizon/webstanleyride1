<?php
	include_once("Crud.php");
	class Model{
		private $crud;
		public function __construct(){
			$this->crud = new Crud();
		}
        //REGISTER
		public function RegisterCustomer($data){
            $query = "INSERT INTO customer(cust_lname,cust_fname,cust_age,cust_gender,cust_address, cust_contact,cust_email,cust_password, active, _line) VALUES(?,?,?,?,?,?,?,?,?,?);";
            $this->crud->Insert($query,$data);
        }

        //Create Vehicle
        public function CreateVehicle($data){
            $query = "INSERT INTO vehicle(cust_id, v_service_type_id, v_model, v_brand_id, v_cert_reg, v_or, v_purchase_date, v_color_id, v_owner_type, v_type, v_img) VALUES(?,?,?,?,?,?,?,?,?,?,?);";
            $this->crud->Insert($query,$data);
        }
        //CUSTOMER INFO
        public function GetCustomerInfo($data){
            $query = "SELECT * FROM customer WHERE active=? AND cust_email=?";
            $rows = $this->crud->Select($query,$data);
            return $rows;
        }
        //GET MY VEHCLE DETAILS
        public function GetMyVehicle($data){
            $query = "SELECT v.*, b.*,col.*, s_type.* FROM vehicle v, vehicle_brand b, vehicle_color col, service_type s_type WHERE v.cust_id=$data and v.v_service_type_id = s_type.v_service_type_id and v.v_brand_id=b.v_brand_id and v.v_color_id=col.v_color_id";
            // $query = "SELECT v.*, s_type.*, b.*, c.* FROM vehicle v, service_type s_type, vehicle_brand b WHERE cust_id=$data and v.v_service_type_id=s_type.v_service_type_id and v.v_brand_id=b.v_brand_id and v.v_color_id=c.";
            $rows = $this->crud->SelectAll($query);
            return $rows;
        }
        //Services TYPE
        public function GetServiceType(){
            $query = "SELECT * FROM service_type";
            $rows = $this->crud->SelectAll($query);
            return $rows;
        }
        //BRAND
        public function GetVehicleBrand(){
            $query = "SELECT * FROM vehicle_brand";
            $rows = $this->crud->SelectAll($query);
            return $rows;
        }
        //COLOR
        public function GetVehicleColor(){
            $query = "SELECT * FROM vehicle_color";
            $rows = $this->crud->SelectAll($query);
            return $rows;
        }
        //UPDATE
        public function UpdateCustomer($data){
            $query = "UPDATE customer set cust_lname=?, cust_fname=?, cust_age=?, cust_gender=?, cust_address=?, cust_contact=?, aboutme=?, cust_img=? where cust_id=?";
            $this->crud->Update($query,$data);

        }
       
        //CHANGE EMAIL OR PASSWORD
        public function ChangeEmail($table,$data){
            $query = "UPDATE $table set cust_email=? where cust_id=?";
            $this->crud->Update($query,$data);

        }
        public function ChangePassword($table,$data){
            $query = "UPDATE $table set cust_password=? where cust_id=?";
            $this->crud->Update($query,$data);

        }
        //Customer Email
        public function CheckEmail($data){
            $check=NULL;
            $query = "SELECT * FROM customer where cust_email=?";
            $row = $this->crud->Select($query,$data);
            if(count($row) > 1){
                $check = "Checked";
            }
            return $check;
        }
        public function CheckPassword($data){
            $check=NULL;
            $query = "SELECT * FROM customer where cust_id=? and cust_password=?";
            $row = $this->crud->Select($query,$data);
            if(count($row) > 1){
                $check = "Checked";
            }
            return $check;
        }
        public function getCustIDByEmail($data){
            $id=0;
            $query = "SELECT * FROM customer where cust_email=?";
            $row = $this->crud->Select($query,$data);
            if(count($row) > 1){
                $id = $row['cust_id'];
            }
            return $id;
        }
        public function getCustNameByID($data){
            $name=null;
            $query = "SELECT * FROM customer where cust_id=?";
            $row = $this->crud->Select($query,$data);
            if(count($row) > 1){
                $name = $row['cust_fname'];
            }
            return $name;
        }
        public function getCustImgByEmail($data){
            $img=null;
            $query = "SELECT * FROM customer where cust_email=?";
            $row = $this->crud->Select($query,$data);
            if(count($row) > 1){
                $img = $row['cust_img'];
            }
            else $img=null;
            return $img;
        }
       
        public function ValidateCustomerLogin($data){
            $query = "SELECT * FROM customer where cust_email=? and cust_password=?";
            $row = $this->crud->Select($query,$data);
            return $row;
        }
        public function UpdateOnlineCustomer($username,$line){
            $query = "UPDATE customer SET _line = $line wHERE cust_email='$username'";
            $this->crud->Update($query,array($username,$line));
        }
        //LOGOUT
        public function Logout(){
            if(isset($_COOKIE['email'])){
                $this->UpdateOnlineCustomer($_COOKIE['email'],0);
                setcookie("email",$_COOKIE['email'], time() - 86400 ,"/");
                header("Location: index.php?auth=login");
            }
        }

        
        public function getNotifToCustomer($id){
            $query = "SELECT cust_id FROM delivery WHERE cust_id=$id and status=0;";
            $row = $this->crud->SelectAll($query);
            return $row;
        }
        
	}
?>