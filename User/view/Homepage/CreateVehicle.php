
<?php include "Home.php";?>
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
                function fill_brand($con){
                  $output ='';
                  $sql = "SELECT * FROM vehicle_model GROUP BY vehicle_brand_name ASC";
                  $result = mysqli_query($con,$sql);
                  while ($row = mysqli_fetch_assoc($result)) {
                    $brandnames = utf8ize($row["vehicle_brand_name"]);
                    $output .= '<option value="'.$brandnames.'">'.$brandnames.'</option>';

                  }
                  return $output;
                }
                function fill_model($con){
                  $output ='';
                  $sql = "SELECT * FROM vehicle_model";
                  $result = mysqli_query($con,$sql);
                  while ($row = mysqli_fetch_assoc($result)) {
                    
                    $output .= '<option value="'.$row["vehicle_model_name"].'">'.$row["vehicle_model_name"].'</option>';

                  }
                  return $output;
                }
              ?>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="pull-left">Create Post</div>
                  <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                  <div class="padd">
                    
                      <div class="form quick-post">
                                      <!-- Edit profile form (not working)-->
                                      <form class="form-horizontal" name="createvehicle" method="POST" enctype="multipart/form-data">
                                          <!-- Title -->
                                          <input type="hidden" name="cust_id" value="<?php echo $id;?> "/>  
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="tags">Lot Description</label>
                                            <div class="col-lg-10">
                                              <textarea name="desc" rows="4" cols="110" placeholder="Type here" required=""></textarea>
                                            </div>
                                          </div>  
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="tags">Lot Address</label>
                                            <div class="col-lg-10">
                                              <input type="text" name="address" placeholder="Location" class="form-control" id="tags" required="">
                                            </div>
                                          </div> 
                                          <!-- Content -->
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="tags">Lot Price</label>
                                            

                                            <div class="input-group"> 
                                                <span class="input-group-addon">₱</span>
                                                <input type="number" value="0000" min="0" name="price" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" id="c2" />
                                            </div>


                                          </div>                 
                                         <div class="form-group">
                                            <label class="control-label col-lg-2" for="tags">Lot Pictures</label>
                                            <div class="col-lg-10">
                                              <input type="file" multiple="multiple" name="pictures" class="form-control" id="tags" required="">
                                            </div>
                                          </div> 
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="tags">Lot Type</label>
                                            <div class="col-lg-10">
                                              <input type="text" name="type" class="form-control" id="tags" required="" placeholder="Example: More sticky soil, More Rocks, Mountain or flat">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="tags">Status</label>
                                            <div class="col-lg-10">
                                              <select class="form-control" name="status" required="">
                                                <option value="available">Available</option>
                                                <option value="not available">Not available</option>
                                              </select>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="tags">Documents</label>
                                            <div class="col-lg-10">
                                              <input type="file" multiple="multiple" name="document" class="form-control" id="tags" required="">
                                            </div>
                                          </div>
                                          
                                          <!-- Buttons -->
                                          <div class="form-group">
                                             <!-- Buttons -->
                                         <div class="col-lg-offset-2 col-lg-9">
                                          <button type="submit" class="btn btn-primary" name="create_vehicle">Post now</button>
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
            <p id="validatePassword"></p>
            <!-- <p>
              <?php if($flag == "ok"){
                echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Successfully Added..</div>';
              }
              else if($flag == "used") {
                echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Email Already in used..</div>';
              }
              ?>
              
            </p> -->
 </div>
    </div>
  </div>
  <script type="text/javascript">
    $(document).ready(function(){
      $('#brand').change(function(){
        var brand_name = $(this).val();
        $.ajax({
          url: "../functions/getModel.php",
          method: "POST",
          data: {brand_name: brand_name},
          success:function(data){
            $('#model').html(data);
          }
        });
      });
    });
  </script>