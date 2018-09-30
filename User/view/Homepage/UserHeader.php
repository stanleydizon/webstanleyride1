<?php
if($_SESSION["id"] == ""){
  header("Location: webstanleyride/User");
} 
else{
  $update = null;
      if(isset($_COOKIE['update'])){
            $update=$_COOKIE['update'];
      }
    include_once("../functions/DB_Functions.php");
    $db = new DB_Functions();
    $user = $db->getUserDetails($_SESSION["id"]);
    $email = $user["email"];
  }
    
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php echo ucfirst($user["fname"])." ".ucfirst($user["lname"]); ?></title>
    <link rel="icon" href="../logo.png">
  <?php include 'model/Bootstrap.php';?>
  <script src="../Bootstrap/js/bootstrap.min.js"></script>
    <script src="../Bootstrap/js/jquery.min.js"></script>
     <script src="../Bootstrap/js/bootstrap.js"></script>
    <script src="../Bootstrap/js/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://www.paypalobjects.com/api/checkout.js"></script>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<script type="text/javascript">
/*$(document).ready(function(){*/
    /*$('#v_vehicle').click(function(){
      $("#loading-page").load("index.php?homepage=MyVehicle", function(responseTxt, statusTxt, xhr){
        });
    });
    $('#c_vehicle').click(function(){
      $("#loading-page").load("index.php?homepage=CreateVehicle", function(responseTxt, statusTxt, xhr){
        });
    });
    });*/
    /*function validateForm() {
        var form = document.forms["cust_change_email_form"];
        var password = form["password"].value;
        var c_password = form["c_pass"].value;
        if (c_password != password) {
            document.getElementById('validatePassword').innerHTML = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert'aria-hidden='true'>&times;</button>Warning ! Password did not much!</div>";
            return false;
        }
        else{
            password = c_password;
        }

      
    }*/
   /*function validatePassword() {
        var form = document.forms["cust_change_password_form"];
        var password = form["password"].value;
        var c_password = form["c_pass"].value;
        if (c_password != password) {
            document.getElementById('validatePassword1').innerHTML = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert'aria-hidden='true'>&times;</button>Warning ! Password did not much!</div>";
            return false;
        }
        else{
            password = c_password;
        }
      }*/
</script>
  </head>
<style>
  body{/*padding:50px;background-image: url('../images/bg1.jpg');
  background-repeat: no-repeat;
  background-position: center;
    background-size: cover;
  height: 100%;*/

    }
    /*LOADER*/
    
/*LOADER*/
    .thumbnail:hover{border: solid 1px #b0b0b0;}
    #prof_img{height: 25px; width: 25px;}
    #change_img{height: 100%; width: 100%;}
    #a_order_payment{color:#fefefe;}
    #a_order_payment:hover{color:#c0c0c0;}
    #ul_order_payment{background-color: #a0a0a0;color:#fefefe;}
    .modal-dialog,
    .modal-content {
        /* 80% of window height */
        height: 80%;
    }

    .modal-body {
        /* 100% = dialog height, 120px = header + footer 
        max-height: calc(100% - 120px);*/
        height: 80%;
        overflow-y: scroll;
    }
    .card {
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    width: 40%;
    }

    .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }

    .container {
        padding: 2px 16px;
    }
   .cellContainer {
      width: 25%;
      float: left;
    }
    .dropbtn {
    border: none;
    cursor: pointer;
}

.dropbtn:hover, .dropbtn:focus {
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    max-width: 500px;
    overflow: auto;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown a:hover {}

.show {display:block;}

</style>

  <body style="background-color: #e0e0e0;" class="login-img3-body">
  <!-- container section start -->>
     
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
    <a class="navbar-brand" href="#">Welcome to parcelPH</a>
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php?homepage=homepage"><span class="fa fa-home"></span> Home</a></li>
        <li>
          <a onclick="myFunction()" class="dropbtn"><span class="fa fa-bell"></span> Notification</a>
        </li>
        <li><a href="index.php?homepage=Profile"><?php echo "<img id='prof_img' src='../Bootstrap/img/user.png' class='img-circle'>";?> <?php echo ucfirst($user["fname"])." ".ucfirst($user["lname"]);?></a></li>
        
        <li><a href="index.php?logout=1"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      
      </ul>
    </div>
  </div>
</nav>
<div class="">
<div class="row">
  <div class="col-lg-12">
  <hr>
  <script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>