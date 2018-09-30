	
	</div>
  </div>
</div>
<footer style="position: fixed;bottom: 0;width: 100%;height: 60px;">
<hr style="max-width: 100%;">
<div class="" style="max-width: 100%;">
  
  <p id="p_color" class="pull-left">&copy; 2017 College of Computer Studies, All Rights Reserved. No portion of this site may be 
  reproduced <br> or duplicate without the express permission of CCS.</p>
  <p class="pull-right"><a id="a_color" href="#">Privacy Policy </a>| <a id="a_color" href="#">Interest-Based Advertising </a> | <a id="a_color" href="#">Terms of Use </a> | <a id="a_color" href="#">Site of Map</a></p><br><br>
  <div class="pull-right">
                                                <p>
                                                  <a href="#"><img src="../Bootstrap/img/m_card.png" width="50"></a>
                                                  <a href="#"><img src="../Bootstrap/img/maestro-icon.png" width="50"></a>
                                                  <a href="#"><img src="../Bootstrap/img/visa-icon.png" width="50"></a>
                                                  <a href="#"><img src="../Bootstrap/img/discover-net-icon.png" width="50"></a>
                                                  <a href="#"><img src="../Bootstrap/img/american-e-icon.png" width="50"></a>
                                                </p>
                                                </div>
</div>
</footer>

    <script src="../Bootstrap/js/bootstrap.min.js"></script>
    <script src="../Bootstrap/js/jquery.min.js"></script>
 <script src="../Bootstrap/js/bootstrap.js"></script>
<script src="../Bootstrap/js/jquery.js"></script>
    <script>
        var myVar = setInterval(function () {myTimer()}, 1000);
        function myTimer() {
            var d = new Date();
            document.getElementById("time").innerHTML = d.toLocaleTimeString();
            document.getElementById("date").innerHTML = d.toLocaleDateString();
        }
    </script>
     <script>
                                              // Set the date we're counting down to
                                              var countDownDate = new Date("sep 30 2017 4:05:30 am").getTime();
                                              var ctr=0,min=0,hr=0,day=0;
                                              // Update the count down every 1 second
                                              var x = setInterval(function() {
                                                 ctr++;
                                                 if(ctr>59){
                                                  min++;
                                                  ctr=0;
                                                  if(min>59){
                                                    hr++;
                                                    min=0;
                                                    if(hr>23){
                                                      day++;
                                                      hr=0;
                                                    }
                                                  }
                                                 }
                                                  // Get todays date and time
                                                  var now = new Date().getTime();
                                                  
                                                  // Find the distance between now an the count down date
                                                  var distance =  now - countDownDate;
                                                  
                                                  // Time calculations for days, hours, minutes and seconds
                                                  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                                  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                                  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                                  
                                                  // Output the result in an element with id="demo"
                                                  document.getElementById("demo101").innerHTML = ctr +" --- "+ days + "d " + hours + "h "
                                                  + minutes + "m " + seconds + "s ";
                                                  
                                                  // If the count down is over, write some text 
                                                  if (distance < 0) {
                                                      clearInterval(x);
                                                      document.getElementById("demo101").innerHTML = "EXPIRED";
                                                  }
                                              }, 1000);
                                              </script>
</body>
</html>