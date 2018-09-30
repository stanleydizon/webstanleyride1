<?php include "Home.php";
if(isset($_GET['vid'])){
  $vid = $_GET['vid'];
  $id = $_SESSION['id'];
}
?>
  <div class="container">
    <div class="row">
      <div class="col-lg-12" >
              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="pull-left"><a href="index.php?homepage=MyVehicle">Back</a>  | Vehicle History</div>
                  <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                  <ul class="list-group" style="overflow-y:scroll;">
                  <?php 
                          

                              $history = $db->getHistory($vid);
                              foreach ($history as $key => $value1) {
                                  $id = $_SESSION["id"];
                                  $count = $db->Count($value1["cdate"]);
                                  $you = $db->getVehicleID($vid);

                                  if($value1["mark"] != 1){ 
                                      if($value1['part_type'] == "notsub"){
                                    ?>

                                  <li class="list-group-item" style="background-color: #ADD8E6;"><a href="index.php?homepage=ViewCarDetails&vid=<?php echo $vid;?>&part=<?php echo $value1['pid'];?>&edit=true&mark=1&history=<?php echo $value1['id']; ?>" class="w3-btn" style="text-decoration: none;"><?php if($value1["owner"] == $id){ echo "You";}else{ $ename = $db->getUserDetails($value1["owner"]); echo ucfirst($ename["owner_fname"])." ".ucfirst($ename["owner_lname"]);} echo " ".$value1["description"]; ?></a><span class="badge"><?php echo $count;?></span></li>


                                  <?php }else{ $subs = $db->getSubPartDetails($value1['pid']); $juncid = $subs["vehicle_part_junc_id"]; $partd = $db->getPartDetails($juncid); if($subs != null){ ?>

                                      <li class="list-group-item" style="background-color: #ADD8E6;"><a href="index.php?homepage=ViewCarDetails&vid=<?php echo $vid;?>&part=<?php echo $partd["vehicle_part_id"];?>&subpart=<?php echo $value1["pid"];?>&mark=1&history=<?php echo $value1['id']; ?>" class="w3-btn" style="text-decoration: none;"><?php if($value1["owner"] == $id){ echo "You";}else{ $ename = $db->getUserDetails($value1["owner"]); echo ucfirst($ename["owner_fname"])." ".ucfirst($ename["owner_lname"]);} echo " ".$value1["description"]; ?></a><span class="badge"><?php echo $count;?></span></li>

                                      <?php }}}
                                  else{ if($value1['part_type'] == "notsub"){?>

                                    <li class="list-group-item"><a href="index.php?homepage=ViewCarDetails&vid=<?php echo $vid;?>&part=<?php echo $value1["pid"];?>&edit=true&mark=1&history=<?php echo $value1['id'];?>" class="w3-btn" style="text-decoration: none;"><?php if($value1["owner"] == $id){ echo "You";}else{ $ename = $db->getUserDetails($value1["owner"]); echo ucfirst($ename["owner_fname"])." ".ucfirst($ename["owner_lname"]);} echo " ".$value1["description"]; ?></a><span class="badge"><?php echo $count;?></span></li>

                                  <?php }else{ $subs = $db->getSubPartDetails($value1['pid']); $juncid = $subs["vehicle_part_junc_id"]; $partd = $db->getPartDetails($juncid); if($subs != null){ ?>

                                        <li class="list-group-item"><a href="index.php?homepage=ViewCarDetails&vid=<?php echo $vid;?>&part=<?php echo $partd["vehicle_part_id"];?>&subpart=<?php echo $value1["pid"];?>&mark=1&history=<?php echo $value1['id'];?>" class="w3-btn" style="text-decoration: none;"><?php if($value1["owner"] == $id){ echo "You";}else{ $ename = $db->getUserDetails($value1["owner"]); echo ucfirst($ename["owner_fname"])." ".ucfirst($ename["owner_lname"]);} echo " ".$value1["description"]; ?></a><span class="badge"><?php echo $count;?></span></li>
                                  <?php }}
                                }
                              }
                   ?>
                   </ul>
                    </div>
                  <div class="widget-foot">
                  </div>
                </div>
              </div>
        </div>
    </div>