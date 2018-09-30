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
?>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
           <?php
                $con = mysqli_connect("localhost","root","","stanleyride");
                function utf8ize($d) {
                    if (is_array($d)) {
                        foreach ($d as $k => $v) {
                            $d[$k] = utf8ize($v);
                        }
                    } else if (is_string ($d)) {
                        return utf8_encode($d);
                    }
                    return $d;
                    }

                function fill_brand1($con,$brandsname){
                  $output ='';

                  $sql = "SELECT * FROM vehicle_model WHERE vehicle_brand_name != '$brandsname' GROUP BY vehicle_brand_name ASC";
                  $result = mysqli_query($con,$sql);

                  while ($row = mysqli_fetch_assoc($result)) {
                          $brandnames = utf8ize($row["vehicle_brand_name"]);
                          $output .= '<option value="'.$brandnames.'">'.$brandnames.'</option>';

                  }
                  return $output;
                }
                function fill_model1($con,$brandsname){
                  $output ='';
                  $sql = "SELECT * FROM vehicle_model WHERE vehicle_brand_name = '$brandsname' GROUP BY vehicle_model_name ASC";
                  $result = mysqli_query($con,$sql);
                  while ($row = mysqli_fetch_assoc($result)) {
                    
                    $output .= '<option value="'.$row["vehicle_model_id"].'">'.$row["vehicle_model_name"].'-------------------------'.$row["year"].'</option>';

                  }
                  return $output;
                }
              ?>
     
              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="pull-left">Edit Vehicle</div>
                  <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                  <div class="padd">
                    
                      <div class="form quick-post">
                                      <!-- Edit profile form (not working)-->
                                      <form class="form-horizontal" name="updatevehicle" action="../functions/editCar.php" method="POST" enctype="multipart/form-data">
                                          <!-- Title -->
                                          <input type="hidden" name="cust_id" value="<?php echo $id;?> "/>  
                                          <input type="hidden" name="bookId" value="<?php echo $vid;?>">
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="tags">Brand</label>
                                            <div class="col-lg-10">
                                              <select class="form-control" name="vbrand" id="vbrand" required="">
                                                <option selected="selected" value="<?php echo $brandname['vehicle_brand_name']; ?>"><?php echo $brandname['vehicle_brand_name']; ?></option>
                                                <?php
                                                  echo fill_brand1($con,$brandname['vehicle_brand_name']);
                                                ?>
                                              </select>
                                            </div>
                                          </div>  
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="tags">Model</label>
                                            <div class="col-lg-10">
                                              <select class="form-control" name="vmodel" id="vmodel" required="">
                                                  <?php echo fill_model1($con,$brandname['vehicle_brand_name']);?>
                                              </select>
                                            </div>
                                          </div> 
                                          <!-- Content -->
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="tags">Plate No.</label>
                                            <div class="col-lg-10">
                                              <input type="text" name="vplate" value="<?php echo $user['vehicle_plate_no'];?>" class="form-control" id="tags" required="">
                                            </div>
                                          </div>                 
                                         <div class="form-group">
                                            <label class="control-label col-lg-2" for="tags">Vehicle OR</label>
                                            <div class="col-lg-10">
                                              <input type="text" name="vor" value="<?php echo $user['vehicle_or'];?>" class="form-control" id="tags" required="">
                                            </div>
                                          </div> 
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="tags">Purchase Date</label>
                                            <div class="col-lg-10">
                                              <input type="date" name="vpurchase"  value="<?php echo $user['vehicle_purchase_date'];?>" class="form-control" id="tags" required="">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="tags">Color</label>
                                            <div class="col-lg-10">
                                              <select class="form-control" name="vcolor" required="">
                                                <option value="<?php echo $colorname['vehicle_color_id'];?>"><?php echo $colorname['vehicle_color_name'];?></option>
                                                <?php
                                                  if($v_color > 0){
                                                    foreach ($v_color as $key => $value) {
                                                        echo "<option value='".$value['cid']."'>".$value['cname']."</option>";
                                                    }
                                                  }
                                                ?>
                                              </select>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="tags">Owner Type</label>
                                            <div class="col-lg-10">
                                              <select class="form-control" name="vowner" required="">
                                                <option value="<?php echo $user['vehicle_owner_type'];?>"><?php echo $user['vehicle_owner_type'];?></option><option value="1st">1st</option><option value="2nd">2nd</option><option value="3rd">3rd</option><option value="4th">4th</option><option value="5th">5th</option>
                                                
                                              </select>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="tags">Service Type</label>
                                            <div class="col-lg-10">
                                                <select class="form-control" name="vservice" required="">
                                                <option value="<?php echo $user['vehicle_service_type'];?>"><?php echo $user['vehicle_service_type'];?></option><option value="Private">Private</option><option value="Public">Public</option>
                                              </select>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="tags">Vehicle Type</label>
                                            <div class="col-lg-10">
                                              <select class="form-control" name="vtype" required="">
                                                <option value="<?php echo $user['vehicle_type'];?>"><?php echo $user['vehicle_type'];?></option><option value="Hatchback">Hatchback</option><option value="Sedan">Sedan</option><option value="MPV(Multi-purpose Vehicle)">MPV(Multi-purpose Vehicle)</option><option value="SUV(Sports Utility Vehicle)">SUV(Sports Utility Vehicle)</option><option value="Crossover">Crossover</option><option value="Coupe">Coupe</option><option value="Convertible">Convertible</option>
                                                
                                              </select>
                                            </div>
                                          </div>
                                          <!-- Buttons -->
                                          <div class="form-group">
                                             <!-- Buttons -->
                                         <div class="col-lg-offset-2 col-lg-9">
                                          <button type="submit" class="btn btn-primary" name="update_vehicle">Save changes</button>
                                          <a href="#" class="btn btn-default">Cancel</a>
                                         </div>
                                          </div>
                                      </form>
                                    </div>
                  

                  </div>
                  <div class="widget-foot">
                    <!-- Footer goes here -->

                  </div>
                </div>
              </div>
 </div>
    </div>
  </div>
  <script type="text/javascript">
    $(document).ready(function(){
      $('#vbrand').change(function(){
        var brand_name = $(this).val();
        $.ajax({
          url: "../functions/getModel.php",
          method: "POST",
          data: {brand_name: brand_name},
          success:function(data){
            $('#vmodel').html(data);
          }
        });
      });
    });
  </script>