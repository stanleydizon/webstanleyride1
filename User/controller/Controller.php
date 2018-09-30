<?php
	include_once("../functions/DB_Functions.php");
	class Controller{
		public	$model;
		public	function __construct(){		
			$this->model = new DB_Functions();
		}
		public function invoke(){
			$this->Delete();
			$this->Update();
			 /*$this->Retrieve();*/
		    $this->Create();
		    $this->Logout();
		    $this->ValidateLogin();
			$this->AUTH();
		}
		
		public function AUTH(){
			if(isset($_GET['auth'])){
				$auth = rtrim($_GET['auth'], '/');
				include 'view/Auth/'.$auth.'.php';
			}
			else if(isset($_GET['homepage'])){
				$this->Retrieve(); 	
			 }
			 else{
				include 'view/Auth/Login.php';
				
			}	
			
		}
		//
		public function ValidateLogin(){
			if(isset($_POST['login_customer'])){
				$username = $_POST['email'];
				$password = $_POST['password'];
				$row = $this->model->getUserByEmailAndPassword($username,$password);
				if(count($row) > 1){
                setcookie("email", $row['email'], time() + 86400, "/"); // 86400 = 1 day
                header("Location: index.php?homepage=homepage");
            }
            else{
                header('location: index.php?auth=Authentication');
            }
			}
		}
		public function Logout(){
			if(isset($_GET['logout'])){
				if($_GET['logout'] == 1){
					$this->model->Logout();
				}
			}
		}
		//
		public function Create(){
			date_default_timezone_set('Asia/Manila');
			//CUSTOMER
			if(isset($_POST['register_customer'])){
				$type = $_POST['type'];
				$lname = $_POST['lname'];
				$fname = $_POST['fname'];
				$age = $_POST['age'];
				$address = $_POST['address'];
				$contact = $_POST['mobile'];
				$contact1 = $_POST['landline'];
				$email = $_POST['email'];
				$password = $_POST['password'];
				if($this->model->CheckEmail($email) == ""){
					$this->model->storeUser($email,$password,$fname,$lname,$contact,$contact1,$address,$age);
			        setcookie("flag", "ok", time() + 3, "/");
				}
				else{
					setcookie("flag", "used", time() + 3, "/");
				}
				echo '<script language="javascript">';
				echo 'alert("Register successful.")';
				echo '</script>';
				header("Location: index.php");
			}
			if(isset($_POST['create_vehicle'])){
				$userid = $_POST['cust_id'];
				$desc = $_POST['desc'];
				$address = $_POST['address'];
				$price = $_POST['price'];
				
				$type = $_POST['type'];

				$status = $_POST['status'];
				$document = $_FILES['document']['name'];

				$pictures = $_FILES['pictures']['name'];
				/*$imagetmp=addslashes (file_get_contents($_FILES['pictures']['tmp_name']));*/
				$folder="/xampp/htdocs/parcel/images/";
				$folder1 ="/xampp/htdocs/parcel/document/";
				move_uploaded_file($_FILES["pictures"]["name"], "$folder".$_FILES["pictures"]["name"]);
				move_uploaded_file($_FILES["document"]["name"], "$folder1".$_FILES["document"]["name"]);
		        setcookie("update", "ok", time() + 5, "/");

				$vehicle = $this->model->storeVehicle($userid,$desc,$address,$price,$pictures,$type,$status,$document);
				
				
				header('Location:index.php?homepage=homepage');

			}
		}
		public function Retrieve(){
				if(isset($_COOKIE['email'])){
					date_default_timezone_set('Asia/Manila');
			        $username=$_COOKIE['email'];
			        session_start();
			        $id = $this->model->getCustIDByEmail($username);
			        $_SESSION["id"] = $id;
				    $customer = $this->model->GetCustomerInfo($username);
					$name = $this->model->getCustNameByID($id);
				    /*$serv_type = $this->model->getServiceType();*/
            		/*$v_brand = $this->model->getBrandNames();
            		$v_color = $this->model->getColor();
            		$v_details = $this->model->getCarDetails($id);*/
			        $active = 0;
			        if(isset($_GET['next'])){
			          $active = $_GET['next'];
			        }
			        else {$active = 0;}
			        if($_GET['homepage'] =='CreatePost'){
						include 'view/Homepage/UserHeader.php';
						include 'view/Homepage/CreateVehicle.php';	
				 		include 'view/Homepage/UserFooter.php';
							 	
			   	    }else if($_GET['homepage'] =='MyPost'){
			   	    	include 'view/Homepage/UserHeader.php';
						include 'view/Homepage/MyVehicle.php';	
				 		include 'view/Homepage/UserFooter.php';
			   	    }
			   	    else if($_GET['homepage'] != 'MyPost' && $_GET['homepage'] != 'CreatePost'){
			   	    	$homepage = $_GET['homepage'];
			   	    	include 'view/Homepage/UserHeader.php';
						include 'view/Homepage/'.$homepage.'.php';	
				 		include 'view/Homepage/UserFooter.php';
			   	    }
				}
			    else{
			      header('location: index.php?auth=Login');
			    }				
		}
		public function Update(){
			if(isset($_POST['update_customer'])){
			    $cust_id = $_POST['cust_id'];
				$fname = $_POST['fname'];
				$lname = $_POST['lname'];
				$age = $_POST['age'];
				$address = $_POST['address'];
			    $contact = $_POST['contact'];
			    $contact1 = $_POST['contact1'];

			    $data = $this->model->editUser($fname,$lname,$contact,$contact1,$address,$age,$cust_id);
		        setcookie("update", "ok", time() + 5, "/");
				header('Location:index.php?homepage=Profile&next=2');
			}
			
			//Change Email
			if(isset($_POST['change_email'])){
			    $cust_id = $_POST['cust_id'];
				$email = $_POST['email'];
				$password = $_POST['password'];
			    $check_email = $this->model->CheckEmail($email);
			    $check_pass = $this->model->CheckPassword($cust_id, $password);
		        if($check_email == "" && $check_pass == "Checked"){
					$this->model->ChangeEmail($email,$cust_id);
					setcookie("update", "ok", time() + 5, "/");
			        setcookie("email", $email, time() + 86400, "/");
					header('Location: index.php?homepage=Profile&next=1');
				}
				else{
					setcookie("update", "used", time() + 5, "/");
					header('Location: index.php?homepage=Profile&next=1');
				}
			}
			//Change Password
			if(isset($_POST['change_password'])){
			    $cust_id = $_POST['cust_id'];
				$password = $_POST['password'];
		        $this->model->ChangePassword($password,$cust_id);
				setcookie("update", "ok", time() + 5, "/");
				header('Location: index.php?homepage=Profile&next=3');
				
			}
		}
		public function Delete(){
			
		}
	}	
?>