<?php include "Home.php";
if(isset($_GET['vid'])){
  $vid = $_GET['vid'];
  $id = $_SESSION['id'];
  $user = $db->getCar($id,$vid);
  $brandid = $user['vehicle_model_id'];
  $brandname = $db->getBrandName($brandid);
  $colorid = $user['vehicle_color_id'];
  $colorname = $db->getColorName($colorid );
}
if(isset($_GET['part'])){
  $part = $_GET['part'];
  if($_GET['vid']){
    $vid = $_GET['vid'];
  $name = $db->getPartName($part);
?>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
              <div class="panel panel-default">
                <?php if(isset($_GET['subpart'])){ $subpart = $_GET['subpart']; $name = $db->getSubPartNameById($subpart);
                  $sub = $db->getSubPartDetails($subpart); if(isset($_GET['notification'])){
                              $noti = $_GET["notification"];
                              $db->changeMark1($noti);
                            } 
                ?>
                      <div class="panel-heading">
                      <div class="pull-left">
                        <?php if(isset($_GET['mark']) && isset($_GET['history'])){$history = $_GET['history']; $db->changeMark($history); ?><a href="index.php?homepage=ViewCarHistory&vid=<?php echo $vid;?>">Back  |  </a><?php }else{ ?><a href="index.php?homepage=ViewCarDetails&vid=<?php echo $vid;?>&part=<?php echo $part;?>">Back</a>  |  <?php } echo $name;?>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                       <form class="form-horizontal" action="../functions/editParts.php" method="POST" enctype="multipart/form-data">
                                                  
                            <!-- subpart -->
                            <?php $ids = $_SESSION['id']; ?>
                              <input type="hidden" name="oid" value="<?php echo $ids;?>">
                              <input type="hidden" name="pid" value="<?php echo $subpart;?>">
                              <input type="hidden" name="type" value="sub">
                              <input type="hidden" name="vid" value="<?php echo $vid;?>">
                              <input type="hidden" name="part" value="<?php echo $part;?>">
                                <div class="form-group">
                             <label class="control-label col-lg-2" for="title">Status</label>
                              <div class="col-lg-6">
                                  <select name="status" class="form-control" required="">
                                    <option value="<?php echo $sub['status']; ?>"><?php echo $sub['status']; ?></option>
                                    <option value="Functional replace">Functional replace</option>
                                    <option value="Functional repair">Functional repair</option>
                                    <option value="Functional need repair">Functional need repair</option>
                                    <option value="Non-functional">Non-functional</option>
                                    <option value="Non-functional replace">Non-functional replace</option>
                                    <option value="Non-functional repair">Non-functional repair</option>
                                    <option value="Functional">Functional</option>
                                    
                                  </select>
                                </div>
                              </div>
                                <div class="form-group">
                               <label class="control-label col-lg-2" for="title">Comment</label>
                              <div class="col-lg-6">
                                <textarea name="comment" class="form-control" placeholder="Comment here"><?php $comment = $sub['comment'];  echo $comment;?></textarea>
                                </div>
                              </div>
                            <div class="form-group">
                               <!-- Buttons-->
                           <div class="col-lg-offset-2 col-lg-9">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <?php if(isset($_GET['mark']) && isset($_GET['history'])){$history = $_GET['history']; ?><a href="index.php?homepage=ViewCarHistory&vid=<?php echo $vid;?>" class="btn btn-default">Cancel</a><?php }else{ ?><a href="index.php?homepage=ViewCarDetails&vid=<?php echo $vid;?>&part=<?php echo $part;?>"  class="btn btn-default">Cancel</a><?php }?>
                           </div>
                            </div>
                            
                        </form>
                <?php }else{ ?>
                <div class="panel-heading">
                  <div class="pull-left"><?php if(isset($_GET['history'])){ ?><a href="index.php?homepage=ViewCarHistory&vid=<?php echo $vid;?>">Back</a> <?php }else{?><a href="index.php?homepage=ViewCarDetails&vid=<?php echo $vid;?>">Back</a><?php }?>  |   <?php echo $name["vehicle_part_name"];?></div>
                  <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                  <?php
                    $con = mysqli_connect("localhost","root","","stanleyride");
                      $result = mysqli_query($con,"SELECT * FROM vehicle_part_junc WHERE vehicle_id = '$vid' AND vehicle_part_id = '$part'");
                      while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row["vehicle_part_junc_id"];
                        $result1 = mysqli_query($con,"SELECT * FROM vehicle_part_sub_junc WHERE vehicle_part_junc_id= $id");
                        $count = mysqli_num_rows($result1);
                        if($count > 0){
                          while ($row1 = mysqli_fetch_assoc($result1)) {
                            $id3 = $row1["vehicle_part_sub_id"];
                            $result5 = mysqli_query($con,"SELECT * FROM vehicle_part_sub WHERE vehicle_part_sub_id = $id3");
                            while ($row6 = mysqli_fetch_assoc($result5)) {
                              $name = $row6["vehicle_part_sub_name"];
                              echo "<div class='cellContainer card' style='background-color: white;margin: 10px;'>";
                              echo "<header class='w3-container w3-blue'>".$name."</header>";
                              echo "<div class='w3-container w3-body'>";
                              echo "Status: ".$row1["status"]."<br/>";
                              echo "Repaired by: ".$row1["repaired_by"]."<br/>";
                              echo "Comment: ".$row1["comment"]."<br/>";
                              echo "<hr/>";
                              echo "<a href='index.php?homepage=ViewCarDetails&vid=".$vid."&part=".$part."&subpart=".$row1["vehicle_part_sub_junc"]."' style='color: blue;' id='myBtn'><span>Edit this part</span></a>";
                              echo "</div>";
                              echo "</div>";
                            }
                          }
                        }
                        else{
                            if(isset($_GET['edit'])){ if(isset($_GET['notification'])){
                              $noti = $_GET["notification"];
                              $db->changeMark1($noti);
                            }  ?>

                                  <form class="form-horizontal" action="../functions/editParts.php" method="POST" enctype="multipart/form-data">
                                              
                                    <!-- part -->
                                    <?php $ids = $_SESSION['id']; ?>
                                      <input type="hidden" name="oid" value="<?php echo $ids;?>">
                                      <input type="hidden" name="type" value="notsub">
                                      <input type="hidden" name="pid" value="<?php $parts = $db->getPartVehicle($part,$vid); echo $parts['vehicle_part_junc_id'];?>">
                                      <input type="hidden" name="vid" value="<?php echo $vid;?>">
                                      <input type="hidden" name="part" value="<?php echo $part;?>">
                                        <div class="form-group">
                                     <label class="control-label col-lg-2" for="title">Status</label>
                                      <div class="col-lg-6">
                                          <select name="status" class="form-control" required="">
                                            <option value="<?php echo $part['vehicle_part_status']; ?>"><?php echo $parts['vehicle_part_status']; ?></option>
                                            <option value="Functional replace">Functional replace</option>
                                            <option value="Functional repair">Functional repair</option>
                                            <option value="Functional need repair">Functional need repair</option>
                                            <option value="Non-functional">Non-functional</option>
                                            <option value="Non-functional replace">Non-functional replace</option>
                                            <option value="Non-functional repair">Non-functional repair</option>
                                            <option value="Functional">Functional</option>
                                            
                                          </select>
                                        </div>
                                      </div>
                                        <div class="form-group">
                                       <label class="control-label col-lg-2" for="title">Comment</label>
                                      <div class="col-lg-6">
                                        <textarea name="comment" class="form-control" placeholder="Comment here"><?php $comment = $parts['comment'];  echo $comment;?></textarea>
                                        </div>
                                      </div>
                                    <div class="form-group">
                                       <!-- Buttons-->
                                   <div class="col-lg-offset-2 col-lg-9">
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                    <?php if(isset($_GET['mark']) && isset($_GET['history'])){$history = $_GET['history']; $db->changeMark($history); ?><a href="index.php?homepage=ViewCarHistory&vid=<?php echo $vid;?>" class="btn btn-default">Cancel</a><?php }else{ ?><a href="index.php?homepage=ViewCarDetails&vid=<?php echo $vid;?>&part=<?php echo $part;?>"  class="btn btn-default">Cancel</a><?php }?>
                                   </div>
                                    </div>
                                    
                                </form>
                            <?php }else{
                              $id2 = $row["vehicle_part_id"];
                              $result3 = mysqli_query($con,"SELECT * FROM vehicle_part WHERE vehicle_part_id = $id2");
                              while ($row5 = mysqli_fetch_assoc($result3)) {
                                  $name = $row5["vehicle_part_name"];
                                  echo "<div class='cellContainer card' style='background-color: white;margin: 10px;'>";
                                  echo "<header class='w3-container w3-blue'>".$name."</header>";
                                  echo "<div class='w3-container'>";
                                  echo "Status: ".$row["vehicle_part_status"]."<br/>";
                                  echo "Repaired by: ".$row["repaired_by"]."<br/>";
                                  echo "Comment: ".$row["comment"];
                                  echo "<hr/>";
                                  echo "<a href='index.php?homepage=ViewCarDetails&vid=".$vid."&part=".$part."&edit=true' style='color: blue;'><span>Edit this part</span></a>";
                                  echo "</div>";
                                  echo "</div>";
                              }
                           }
                        }
                      } 
                    }
                  ?>
                </div>
                  <div class="widget-foot">
                  </div>
                </div>
              </div>
        </div>
    </div>
<?php }}else{?>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="pull-left"><a href="index.php?homepage=MyVehicle">Back</a>   | Vehicle Parts</div>
                  <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                  <?php $part = $db->getPartsDesc();
                        $count = sizeof($part);
                        foreach ($part as $key => $values) {
                          echo "<div class='cellContainer card' style='background-color: white;margin: 10px;'>";
                          echo "<header class='w3-container w3-blue'>".$values["part_desc"]."</header>";
                          echo "<div class='w3-container'>";
                          $name = $values["part_desc"];
                          $parts = $db->getPartsDetails($name,$vid);
                          foreach ($parts as $key => $value1) {
                            echo "<a href='index.php?homepage=ViewCarDetails&vid=".$vid."&part=".$value1['part_id']."'>".$value1["part_name"]."</a><br/>";
                          }
                          echo "</div>";
                          echo "</div>";
                          echo "<div modal-footer></div>";
                        }
                   ?>
                    </div>
                  <div class="widget-foot">
                  </div>
                </div>
              </div>
        </div>
    </div>
    <?php }if(isset($_GET['homepage']) && isset($_GET['vid']) && isset($_GET['part']) && isset($_GET['subpart'])){
      $subpart = $_GET['subpart'];
    }?>