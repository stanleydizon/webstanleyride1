<style type="text/css">
.autocomplete {
  /*the container must be positioned relative:*/
  position: relative;
  max-width: 100%;
}
input {
  border: 1px solid transparent;
  background-color: #f1f1f1;
  padding: 10px;
  font-size: 16px;
}
input[type=text] {
  background-color: #f1f1f1;
  width: 100%;
}
input[type=submit] {
  background-color: DodgerBlue;
  color: #fff;
  cursor: pointer;
}
.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}
.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}
.autocomplete-items div:hover {
  /*when hovering an item:*/
  background-color: #e9e9e9; 
}
.autocomplete-active {
  /*when navigating through the items using the arrow keys:*/
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}
</style>
<?php include "Home.php";
if(isset($_GET['vid'])){
  $vid = $_GET['vid'];
  $id = $_SESSION['id'];
  $result = $db->checkVehicleInService($vid);
  if($result!=null){

?>
<?php $provids = $result["service_provider_id"]; $stype = $result["service_type_id"]; $stypes = $db->getServiceTypeInfo($stype); $prov = $db->getProviderInfo($provids); ?>
    <div class="container" style="max-width: 100%;">
    <div class="row" style="max-width: 100%;">
      <div class="col-lg-12" style="max-width: 100%;">
              <div class="panel panel-default" style="max-width: 100%;">
                <div class="panel-heading">
                  <div class="pull-left"><a href="../User/index.php?homepage=MyVehicle" class="btn">Back</a>  | Schedule service</div>
                  <div class="clearfix"></div>
                </div>
                <div style="max-width:100%; margin: 30px;">
                        <form class="form-horizontal" style="max-width: 100%;"  action="../functions/editVehicleService.php" method="POST" autocomplete="off">
                          <div class="autocomplete">
                              <input type="hidden" name="vid" value="<?php echo $vid;?>"></input>
                              <input type="hidden" name="serviceid" value="<?php echo $result["vehicle_service_id"];?>">
                              <span>Schedule date: </span><input type="date" name="schedule" value="<?php echo $result["vehicle_service_date"];?>" required="" class="form-control" style="max-width: 100%;"></input><br/>
                              <span>Service provider: </span><input type="text" placeholder="<?php echo "Name: ".$prov["service_provider_name"]." Address: ".$prov["service_provider_address"];?>" value="<?php echo "Name: ".$prov["service_provider_name"]." | Address: ".$prov["service_provider_address"];?>" name="serviceprovider" id="myInput" class="form-control" required=""></input><br/>
                            </div>
                            <div class="autocomplete">
                              <span>Service type: </span><input type="text" placeholder="<?php echo $stypes["vehicle_service_desc"];?>" value="<?php echo $stypes["vehicle_service_desc"];?>" name="servicetype" id="myInput1" class="form-control" required=""></input><br/></div>
                             <div>
                              <span>Schedule type: </span><select class="form-control" name="type">
                               <?php if($result["type"] == "scheduled"){?>
                                <option value="unschedule">Unschedule</option>
                                <option value="scheduled" selected="">Scheduled</option>
                                <?php }else {?>
                                <option value="scheduled">Scheduled</option>
                                <option value="unschedule" selected="">Unschedule</option>
                                <?php }?>
                              </select>
                              <br/>
                              <span>Service status: </span><select class="form-control" name="status">
                                <option value="On going">On going</option>
                                <option value="done">Done</option>
                                <option value="cancel">Cancel</option>
                              </select>
                          </div><br/><br/><br/>
                          <input class="form-control" name="update_service" type="submit" value="Save Changes"></input>
                        </form>
                </div>
                </div>
              </div>
        </div>
    </div>
<?php } else{?>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="pull-left"><a href="../User/index.php?homepage=MyVehicle">Back</a>  | Schedule service</div>
                  <div class="clearfix"></div>
              </div>
              <div class="example"  style="max-width:100%; margin: 30px;">
                        <form class="form-horizontal" style="max-width: 100%;" action="../functions/addToService.php" method="POST" autocomplete="off">
                          <input type="hidden" name="vid" value="<?php echo $vid;?>">
                          <span>Schedule date: </span><input type="date" name="schedule" required="" class="form-control"></input>
                          <br/>
                          <div class="autocomplete">
                           <span>Service provider: </span><input type="text" placeholder="Search Service provider name or Location" name="serviceprovider" id="myInput" class="form-control" required=""></input>
                          </div>
                          <br/>
                          <div class="autocomplete">
                           <span>Service type: </span><input type="text" placeholder="Search Service type" name="servicetype" id="myInput1" class="form-control" required=""></input>
                          </div>
                          <br/>
                           <span>Schedule type: </span><select name="type" class="form-control" required="">
                            <option value="scheduled">Schedule</option>
                            <option value="unschedule">Unschedule</option>
                          </select>
                          <br/>
                          <br/>
                          <input class="form-control" name="transfer" type="submit" value="Schedule now"></input>
                        </form>
              </div>
             </div>
        </div>
    </div>
    <?php
  }
      $id = $_SESSION["id"];
      $response = array();
      $response1 = array();
      $con = mysqli_connect("localhost","root","","stanleyride");
      $result = mysqli_query($con, "SELECT * FROM service_provider");
      while ($row = mysqli_fetch_assoc($result)) {

              $response[] = "Name: ".$row["service_provider_name"]." | Address: ".$row["service_provider_address"];
        }
        $result1 = mysqli_query($con,"SELECT * FROM service_type ORDER BY vehicle_service_name ASC");
        while ($row1 = mysqli_fetch_assoc($result1)) {

              $response1[] = $row1["vehicle_service_desc"];
        }
    ?>
    <script>
     function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].toUpperCase().includes(val.toUpperCase())) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
      });
}

/*An array containing all the country names in the world:*/
var countries = <?php echo json_encode($response); ?>;

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("myInput"), countries);
    </script>
    <?php } ?>