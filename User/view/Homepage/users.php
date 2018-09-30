
              <!-- page start-->
              <div class="row">
                 <div class="col-lg-13">
                    <section class="panel">
                          <header class="panel-heading tab-bg-info">
                              <ul class="nav nav-tabs">
                                  
                                  <li>
                                      <a href="index.php?homepage=CreateVehicle">
                                          <span class="fa fa-user"></span>
                                          Create Vehicle
                                      </a>
                                  </li>
                                  <li>
                                      <a href="index.php?homepage=MyVehicle">
                                          <span class="fa fa-edit"></span>
                                          My Vehicle
                                      </a>
                                  </li>
                              </ul>
                          </header>
                          
                      </section>
                 </div>
              </div>
          </section>
          <style type="text/css">
            #customers {
                font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            #customers td, #customers th {
                border: 1px solid #ddd;
                padding: 8px;
            }

            #customers tr:nth-child(even){background-color: #f2f2f2;}

            #customers tr:hover {background-color: #ddd;}

            #customers th {
                padding-top: 12px;
                padding-bottom: 12px;
                text-align: left;
                background-color: #4CAF50;
                color: white;
            }
          </style>
   <div class="container" style="max-width: 100%;">
    <div class="row" style="max-width: 100%;">
      <div class="col-lg-12" style="max-width: 100%;">
              <div class="panel panel-default" style="max-width: 100%;">
                <div class="panel-heading">
                  <div class="pull-left"><a href="../User/index.php?homepage=MyVehicle" class="btn">Back</a>  | List of Users</div>
                  <div class="clearfix"></div>
                </div>
                <div style="max-width:100%; margin: 30px;">
                  <table class="form-group" id="customers">
                    <tr>
                   <th>User ID</th></td>
                   <th>User First Name</th>
                   <th>User Last Name</th>
                   <th>User Email</th>
                   <th>User password</th>
                   <th>User Mobile #</th>
                   <th>User Landline #</th>
                   <th>User Address</th>
                   <th>User License No</th>
                   <th>User Status</th>
                  </tr>
                  <form action="../functions/status.php" method="POST">
                      <?php $con = mysqli_connect("localhost","root","","stanleyride");
                          $result = mysqli_query($con,"SELECT * FROM vehicle_owner WHERE owner_email != 'admin@gmail.com'");
                          while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>

                              <td><?php echo $id = $row["owner_id"];?></td>
                              <td><?php echo $row["owner_fname"];?></td>
                              <td><?php echo $row["owner_lname"];?></td>
                              <td><?php echo $row["owner_email"];?></td>
                              <td><?php echo $row["owner_password"];?></td>
                              <td><?php echo $row["owner_mobile"];?></td>
                              <td><?php echo $row["owner_landline"];?></td>
                              <td><?php echo $row["owner_add"];?></td>
                              <td><?php echo $row["owner_license_no"];?></td>
                              <td><?php if($row["status"] == 'active'){ ?> <a style="text-decoration: none;">Active</a> <a href="../functions/status.php?status=Deactivate&id=<?php echo $id;?>" style="text-decoration: none;" class="w3-btn w3-blue">Deactivate</a> <?php }else{ ?><a href="../functions/status.php?status=Active&id=<?php echo $id;?>" class="w3-btn w3-blue" style="text-decoration: none;">Active</a> <astyle="text-decoration: none;">Deactivate</a><?php }?></td>
                            </tr>
                         <?php } ?>
                    </form>
                 </table>
                </div>
                </div>
              </div>
        </div>
    </div>