<?php include "Home.php";
if(isset($_GET['vid'])){
  $vid = $_GET['vid'];
  $id = $_SESSION['id'];

?>
<div class="container">
    <div class="row">
      <div class="col-lg-12">
        <center>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="pull-left"><a href="../User/index.php?homepage=MyVehicle">Back</a>  | QR code</div>
                  <div class="clearfix"></div>
              </div>
              <div class="example"  style="width:80%; margin: 30px;">
                    <?php $qr = $db->checkQRcode($vid);?>
                    <img width="400px" height="400px" src="../functions/qrcode/temp/<?php echo $qr["image_url"];?>">
              </div>
              </center>
             </div>
        </div>
    </div>
    <?php } ?>