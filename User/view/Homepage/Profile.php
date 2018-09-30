<div class="row">
                <!-- profile-widget -->
                <div class="col-lg-12">
                    <div class="profile-widget profile-widget-info">
                          <div class="panel-body">
                            <div class="col-lg-2 col-sm-2">
                              <div class="follow-ava">
                                  <img id='prof_img' src='../Bootstrap/img/user.png' class='img-circle'>
                              </div>
                              <h4><?php echo ucfirst($name);?></h4>               
                            </div>
                            <div class="col-lg-4 col-sm-4 follow-info">
                                <p>Hello I’m <?php echo ucfirst($customer['fname']).", ".ucfirst($customer['lname']);?></p>
                                <p>@<?php echo ucfirst($customer['fname']);?></p>
                                <p><i class="fa fa-twitter"><?php echo $customer['fname'];?>_tweet</i></p>
                                <h6>
                                    <span><i class="icon_clock_alt"></i><b id="time"></b></span>
                                    <span><i class="icon_calendar"></i><b id="date"></b></span>
                                    <span><i class="icon_pin_alt"></i>PH</span>
                                </h6>
                            </div>
                            
                          </div>
                    </div>
                </div>
              </div>
              <!-- page start-->
              <div class="row">
                 <div class="col-lg-12">
                    <section class="panel">
                          <header class="panel-heading tab-bg-info">
                              <ul class="nav nav-tabs">
                                  
                                  <li>
                                      <a data-toggle="tab" href="#profile">
                                          <span class="fa fa-user"></span>
                                          Profile
                                      </a>
                                  </li>
                                  <li <?php if($active > 0) echo "class='active'";else echo "class=''"; ?> >
                                      <a data-toggle="tab" href="#edit-profile<?php echo $active;?>">
                                          <span class="fa fa-edit"></span>
                                          Edit Profile
                                      </a>
                                  </li>
                              </ul>
                          </header>
                          <div class="panel-body">
                              <div class="tab-content">
                                  
                                  <!-- profile -->
                                  <div id="profile" <?php if($active > 0) echo "class='tab-pane'"; else echo "class='tab-pane active'" ?>  >
                                    <section class="panel">
                                      <div class="bio-graph-heading">
                                                Hello I’m <?php echo ucfirst($customer['lname']).", ".ucfirst($customer['fname']).' Im from '.ucfirst($customer['address']); ?>
                                      </div>
                                      <div class="panel-body bio-graph-info">
                                          <h1>Bio Graph</h1>
                                          <div class="row">
                                            <div class="bio-row">
                                                  <p><span>User ID: </span>: <?php echo $customer['userid'];?> </p>
                                              </div>
                                              <div class="bio-row">
                                                  <p><span>First Name </span>: <?php echo ucfirst($customer['fname']);?> </p>
                                              </div>
                                              <div class="bio-row">
                                                  <p><span>Last Name </span>: <?php echo ucfirst($customer['lname']);?></p>
                                              </div>                                              
                                              <div class="bio-row">
                                                  <p><span>I'm a </span>: <?php echo $customer['regtype'];?></p>
                                              </div>
                                              <div class="bio-row">
                                                  <p><span>Address </span>: <?php echo $customer['address'];?></p>
                                              </div>
                                              <div class="bio-row">
                                                  <p><span>Contact # </span>: <?php echo $customer['mobile']." & ".$customer['landline'];?></p>
                                              </div>
                                          </div>
                                      </div>
                                    </section>
                                      <section>
                                          <div class="row">                                              
                                          </div>
                                      </section>
                                  </div>
                                  <!-- edit-profile -->
                                  <div id="edit-profile0" <?php if($active==2) echo "class='tab-pane active'"; else echo"class='tab-pane'"; ?>>
                                    <section class="panel">                                          
                                          <div class="panel-body bio-graph-info">
                                           <div class="col-lg-offset-8">
                                         <a href="index.php?homepage=Profile&next=1" class="btn btn-danger">Change Email</a>
                                         <a href="index.php?homepage=Profile&next=3" class="btn btn-danger">Change Password</a>
                                  </div>
                                              <h1> Profile Info</h1>
                                              <?php 
                                                if($update == "ok"){
                								                  echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Successfully Updated..</div>';
                								              	}
                								              ?>
                                              <form class="form-horizontal" name="cust_update_form"  method="POST" enctype="multipart/form-data">
                                              
                                          <!-- Title -->
                                          	<input type="hidden" name="cust_id" value="<?php echo $customer['owner_id'];?>" class="form-control">
                                              <div class="form-group">

                                           <label class="control-label col-lg-2" for="title">First Name</label>
                                            <div class="col-lg-6">
                                                <input type="text" name="fname" value="<?php echo $customer['fname'];?>" class="form-control"  required="">
                                              </div>
                                            </div>
                                              <div class="form-group">
                                             <label class="control-label col-lg-2" for="title">Last Name</label>
                                            <div class="col-lg-6">
                                                <input type="text" name="lname" value="<?php echo $customer['lname'];?>" class="form-control"   required="">
                                              </div>
                                            </div>
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="title">Registration Type</label>
                                            <div class="col-lg-6"> 
                                              <input type="text" name="age" value="<?php echo $customer['regtype'];?>" class="form-control" id="title" required="">
                                            </div>
                                          </div>   
                                          <!-- Content -->
                                          <!-- <div class="form-group">
                                            <label class="control-label col-lg-2" for="tags">Gender</label>
                                            <div class="col-lg-6">
                                              <select class="form-control" name="gender" required="">
                                                <option value=''>Choose Gender</option>
                                                <option value='M' <?php if($customer['cust_gender'] == 'M') echo "Selected";?> >Male</option>
                                                <option value='F' <?php if($customer['cust_gender'] == 'F') echo "Selected";?>>Female</option>
                                              </select>
                                            </div>
                                          </div> -->                    
                                          <!-- Cateogry -->
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="tags">Address</label>
                                            <div class="col-lg-6">
                                              <input type="text" name="address" value="<?php echo $customer['address'];?>" class="form-control" id="tags" required="">
                                            </div>
                                          </div>            
                                          <!-- Tags -->
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="tags">Cellphone no.</label>
                                            <div class="col-lg-6">
                                              <input type="text" name="contact" value="<?php echo $customer['mobile'];?>" class="form-control" id="tags" required="">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="tags">Telephone no.</label>
                                            <div class="col-lg-6">
                                              <input type="text" name="contact1" value="<?php echo $customer['landline'];?>" class="form-control" id="tags" required="">
                                            </div>
                                          </div>
                                          <!-- <div class="form-group">
                                            <label class="control-label col-lg-2" for="tags">About me</label>
                                            <div class="col-lg-6">
                                              <textarea class="form-control" name="aboutme"><?php echo $customer['aboutme'];?></textarea>
                                            </div>
                                          </div> 
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="tags">Picture</label>
                                            <div class="col-lg-6">
                                              <input class="form-control" type="file" name="fileToUpload"  />
                                            </div>
                                          </div>   -->                                        
                                          <!-- Buttons-->
                                          <div class="form-group">
                                             <!-- Buttons-->
                                         <div class="col-lg-offset-2 col-lg-9">
                                          <button type="submit" class="btn btn-primary" name="update_customer">Finish</button>
                                          <a href="index.php?homepage=Home" class="btn btn-default">Cancel</a>
                                         </div>
                                          </div>
                                          
                                      </form>
                                      
                                  </div>
                                 
                                  </div>
                                          <!-- Change Email -->
                                  <div id="edit-profile1" <?php if($active==1) echo "class='tab-pane active'"; else echo"class='tab-pane'"; ?>>
                                    <section class="panel">                                          
                                          <div class="panel-body bio-graph-info">
                                              <h1> Change Email</h1>
                                              <p id="validatePassword"></p>
                                              <?php 
                                                if($update == "ok"){
                                                  echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Successfully Updated..</div>';
                                                }
                                                else if($update == "used"){
                                                  echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Email is already in used or Invalid Password...</div>';
                                                }
                                              ?>
                                              <form class="form-horizontal" name="cust_change_email_form" method="POST" onsubmit="return validateForm();">
                                          <!-- Title -->
                                            <input type="hidden" name="cust_id" value="<?php echo $customer['userid'];?>" class="form-control">
                                              <div class="form-group">
                                           <label class="control-label col-lg-2" for="title">Email</label>
                                            <div class="col-lg-6">
                                                <input type="text" name="email" value="<?php echo $customer['email'];?>" class="form-control"  required="">
                                              </div>
                                            </div>
                                              <div class="form-group">
                                             <label class="control-label col-lg-2" for="title">Password</label>
                                            <div class="col-lg-6">
                                                <input type="password" name="password" class="form-control"   required="">
                                              </div>
                                            </div>
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="title">Confirm Password</label>
                                            <div class="col-lg-6"> 
                                              <input type="password" name="c_pass" class="form-control" id="title" required="">
                                            </div>
                                          </div>   
                                          
                                          <!-- Content -->                                <!-- Buttons -->
                                          <div class="form-group">
                                             <!-- Buttons -->
                                         <div class="col-lg-offset-2 col-lg-9">
                                         
                                          <button type="submit" class="btn btn-primary" name="change_email">Finish</button>
                                          <a href="index.php?homepage=Profile&next=2" class="btn btn-default">Cancel</a>
                                         </div>
                                          </div>
                                      </form>
                                          </div>
                                      </section>
                                  </div>
                                  <!-- End of Changing email -->
                                  
                                  <!-- Change password -->
                                  <div id="edit-profile3" <?php if($active==3) echo "class='tab-pane active'"; else echo"class='tab-pane'"; ?>>
                                    <section class="panel">                                          
                                          <div class="panel-body bio-graph-info">
                                              <h1> Change Password</h1>
                                              <p id="validatePassword1"></p>
                                              <?php 
                                                if($update == "ok"){
                                                  echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Successfully Updated..</div>';
                                                }
                                              ?>
                                              <form class="form-horizontal" name="cust_change_password_form" method="POST" onsubmit="return validatePassword();">
                                          <!-- Title -->
                                            <input type="hidden" name="cust_id" value="<?php echo $customer['owner_id'];?>" class="form-control">
                                              <div class="form-group">
                                             <label class="control-label col-lg-2" for="title">New Password</label>
                                            <div class="col-lg-6">
                                                <input type="password" name="password" class="form-control"   required="">
                                              </div>
                                            </div>
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="title">Confirm new Password</label>
                                            <div class="col-lg-6"> 
                                              <input type="password" name="c_pass" class="form-control" id="title" required="">
                                            </div>
                                          </div>   
                                          
                                          <!-- Content -->                                <!-- Buttons -->
                                          <div class="form-group">
                                             <!-- Buttons -->
                                         <div class="col-lg-offset-2 col-lg-9">
                                         
                                          <button type="submit" class="btn btn-primary" name="change_password">Finish</button>
                                          <a href="index.php?homepage=Profile&next=2" class="btn btn-default">Cancel</a>
                                         </div>
                                          </div>
                                      </form>
                                          </div>
                                      </section>
                                  </div>
                                  <!-- End of Changing password -->
                                      </section>
                                  </div>

                              </div>
                          </div>
                      </section>
                 </div>
              </div>

              <!-- page end-->
          </section>