<?php include 'model/Bootstrap.php';

    $flag=Null;
    if(isset($_COOKIE['flag'])){
        $flag = $_COOKIE['flag'];
    }
    else $flag=Null;

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link href="../Bootstrap/css/widgets.css" rel="stylesheet">
    <link href="../Bootstrap/css/style.css" rel="stylesheet">
    <link href="../Bootstrap/css/style-responsive.css" rel="stylesheet" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="../home.jpg">
  <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    
    <script type="text/javascript">
 
   function validatePassword() {
        var form = document.forms["AuthForm"];
        var password = form["password"].value;
        var c_password = form["c_pass"].value;
        if (c_password != password) {
            document.getElementById('validatePassword').innerHTML = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert'aria-hidden='true'>&times;</button>Warning ! Password did not much!</div>";
            return false;
        }
        else{
            password = c_password;
        }

    }
    function Reg_validatePassword() {
        var form = document.forms["cust_register_form"];
        var password = form["password"].value;
        var c_password = form["c_pass"].value;
        if (c_password != password) {
            document.getElementById('validatePassword').innerHTML = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert'aria-hidden='true'>&times;</button>Warning ! Password did not much!</div>";
            return false;
        }
        else{
            password = c_password;
        }

    }
</script>
</head>

  <body class="login-img3-body">

    <div class="container">