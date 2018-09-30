<?php include 'view/Auth/AuthHeader.php';?>
<hr>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="pull-left">Register</div>
                  <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                  <div class="padd">
                      <div class="form quick-post" id="form">
                                      <!-- Edit profile form (not working)-->

                                      <form class="form-horizontal" name="cust_register_form" method="POST" onsubmit="return Reg_validatePassword();">
                                          <!-- Title -->
                                           <label class="control-label col-lg-2" for="title">First Name</label>
                                            <div class="col-lg-10 col-lg-6 col-lg-4">
                                              <div class="form-group">
                                                <input type="text" name="fname" class="form-control" style="text-transform: capitalize;" autofocus required="">
                                              </div>
                                            </div>
                                             <label class="control-label col-lg-2" for="title" required>Last Name</label>
                                            <div class="col-lg-10 col-lg-6 col-lg-4">
                                              <div class="form-group">
                                                <input type="text" name="lname" class="form-control" style="text-transform: capitalize;"  required="">
                                              </div>
                                            </div><br><br><br>
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="title">Registration type: </label>
                                            <div class="col-lg-10">
                                            <select name="type" value="type" class="form-control">
                                              <option class="control-label col-lg-2">Select Type</option>
                                              <option value="buyer" class="control-label col-lg-2">Buyer</option>
                                              <option value="seller" class="control-label col-lg-2">Seller</option>
                                              <option value="broker" class="control-label col-lg-2">Broker</option>
                                            </select> 
                                              <!-- <input type="text" name="age" class="form-control" id="title" required=""> -->
                                            </div>
                                          </div>   
                                          <!-- Content -->
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="tags">Address</label>
                                            <div class="col-lg-10">
                                              <input type="text" name="address" class="form-control" id="tags" style="text-transform: capitalize;" required="">
                                            </div>
                                          </div>                
                                          <!-- Cateogry -->
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="tags">Mobile #</label>
                                            <div class="col-lg-10">
                                              <input type="number" name="mobile" class="form-control" id="tags" required="">
                                            </div>
                                          </div>            
                                          <!-- Tags -->
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="tags">Landline #</label>
                                            <div class="col-lg-10">
                                              <input type="number" name="landline" class="form-control" id="tags" required="">
                                            </div>
                                          </div>

                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="tags">Email</label>
                                            <div class="col-lg-10">
                                              <input type="email" name="email" class="form-control" id="tags" required="">
                                            </div>
                                          </div>
                                          <label class="control-label col-lg-2" for="title">Password</label>
                                            <div class="col-lg-10 col-lg-6 col-lg-4">
                                              <div class="form-group">
                                                <input type="Password" name="password" class="form-control"  required="">
                                              </div>
                                            </div>
                                             <label class="control-label col-lg-2" for="title">Confirm </label>
                                            <div class="col-lg-10 col-lg-6 col-lg-4">
                                              <div class="form-group">
                                                <input type="Password" name="c_pass" class="form-control"   required="">
                                              </div>
                                            </div>
                                            <br><br><br>

                                          <!-- Buttons -->
                                          <div class="form-group">
                                             <!-- Buttons -->
                                             <div class="col-lg-offset-2 col-lg-9">
                                               <div id="paypal-button-container"><label>Pay here to register: </label></div>
                                               <div id="register_customer" style="display: none;">
                                                <button type="submit" id="submit" class="btn btn-primary" name="register_customer">Register</button>
                                              
                                               </div>
                                               <div id="confirm" class="hidden">
                                                <div>Ship to:</div>
                                                <div><span id="recipient"></span>, <span id="line1"></span>, <span id="city"></span></div>
                                                <div><span id="state"></span>, <span id="zip"></span>, <span id="country"></span></div>

                                                <button id="confirmButton">Complete Payment</button>
                                                </div>

                                                <div id="thanks" class="hidden">
                                                    Thanks, <span id="thanksname"></span>!
                                                </div>
                                                <a href="index.php?auth=Login" id="login" class="btn btn-default">Login</a>
                                             </div>
                                          </div>
                                      </form>
                                    </div>
                                    <script type="text/javascript">
                                      /*$(document).ready(function(){
                                          $('#submit').click(function(){
                                              $('div.form').block({
                                                  message:'<h1>Processing....',
                                                  ccs: {border: '3px solid #a00'}
                                              });
                                          }); 
                                      });*/
                                                paypal.Button.render({

                                                env: 'sandbox', // sandbox | production

                                                // PayPal Client IDs - replace with your own
                                                // Create a PayPal app: https://developer.paypal.com/developer/applications/create
                                                client: {
                                                    sandbox:    'AZDxjDScFpQtjWTOUtWKbyN_bDt4OgqaF4eYXlewfBP4-8aqX3PiV8e1GWU6liB2CUXlkA59kJXE7M6R',
                                                    production: 'ATeGttWU1HSj7k-z4m85Jr8GN9Tv9KbBasjStrXvemAlMYj8-dN8lraom-iKy1cPptdk-8jzr21ydVLg'
                                                },

                                                // Show the buyer a 'Pay Now' button in the checkout flow
                                                commit: true,

                                                // payment() is called when the button is clicked
                                                payment: function(data, actions) {

                                                    // Make a call to the REST api to create the payment
                                                    return actions.payment.create({
                                                        payment: {
                                                            transactions: [
                                                                {
                                                                    amount: { total: '1000.00', currency: 'PHP' }
                                                                }
                                                            ]
                                                        }
                                                    });
                                                },

                                                onAuthorize: function(data, actions) {

                                                // Get the payment details

                                                return actions.payment.get().then(function(data) {

                                                    // Display the payment details and a confirmation button

                                                    var shipping = data.payer.payer_info.shipping_address;

                                                    document.querySelector('#recipient').innerText = shipping.recipient_name;
                                                    document.querySelector('#line1').innerText     = shipping.line1;
                                                    document.querySelector('#city').innerText      = shipping.city;
                                                    document.querySelector('#state').innerText     = shipping.state;
                                                    document.querySelector('#zip').innerText       = shipping.postal_code;
                                                    document.querySelector('#country').innerText   = shipping.country_code;

                                                    document.querySelector('#register_customer').style.display = 'block';
                                                    document.querySelector('#paypal-button-container').style.display = 'none';
                                                    document.querySelector('#login').style.display = 'none';
                                                    document.querySelector('#confirm').style.display = 'block';

                                                    // Listen for click on confirm button

                                                    document.querySelector('#confirmButton').addEventListener('click', function() {

                                                        // Disable the button and show a loading message

                                                        document.querySelector('#confirm').innerText = 'Loading...';
                                                        document.querySelector('#confirm').disabled = true;

                                                        // Execute the payment

                                                        return actions.payment.execute().then(function() {

                                                            // Show a thank-you note

                                                            document.querySelector('#thanksname').innerText = shipping.recipient_name;

                                                            document.querySelector('#confirm').style.display = 'none';
                                                            document.querySelector('#thanks').style.display = 'block';

                                                        });
                                                    });
                                                });
                                            }

                                        }, '#paypal-button-container');
                                            </script>
                  

                  </div>
                  <div class="widget-foot">
                    <!-- Footer goes here -->

                  </div>
                </div>
              </div>
            <p id="validatePassword"></p>
            <p>
              <?php if($flag == "ok"){
                echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Successfully Register..</div>';
              }
              else if($flag == "used") {
                echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Email Already in used..</div>';
              }
              ?>
              
            </p>
<?php include 'view/Auth/AuthFooter.php';?>
