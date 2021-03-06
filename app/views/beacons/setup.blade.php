<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Create Beacon</title>
@include("header2")
<?php
  $user = Auth::user();
 
  ?>
 
   @include("guestNav2")

<style>
.modal-content{
  background:#fff;
  height:40%;
  min-height:300px;
}
.modal-content input{
  padding:5px;
  clear:both;
  margin:auto;
  width:80%;
  float:none;
  margin:8px;
}
.inner-content{
  text-align:center;
  padding:20px;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active,
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover{
  color:#19b79a !important;
  background:#fff;
  border: 1px solid #cacaca;
}
.dataTables_length, .dataTables_filter {
  margin: 0 15px;
}
#beaconMonitor th, #beaconMonitor tbody td{
  border:1px solid #dddddd;
  border-left:none;
}
#beaconMonitor{
  padding-top:15px;
  font-size:14px;
}
.dataTables_wrapper .dataTables_filter input{
  float:right;
}
.buttons{
  clear:both;
  padding:20px;
}
.panel-heading{
  background:#dedede !important;
  text-align:left;
}
.campaignWrapper{
  background:#fbfbfb;
  margin-top:30px;
}
     #map-canvas {
        height: 50%;
        margin: 0px;
        padding: 0px
      }
      #panel {
        position: relative;
        background-color: #fff;
        padding: 5px;
      }
      #map-canvas{
        height:290px;
        width:100%;
      }
      #mapZone{
        width:60%;
        float:left;
      }
      #reviewZone{
        width:40%;
        float:left;
        padding:0px 10px;
      }
    #entryTable tr th:nth-last-child(2),#exitTable tr th:nth-last-child(2){
    width:90%;
  }
#entryTable, #exitTable{
  border-radius:5px !important;
  width:90% !important;
  margin:auto;
}
#entryTable thead tr, #exitTable thead tr{
  background:#efefef !important;
}
table.table-striped.table tr th{
  color:#000 !important;
}
.tab-content{
background:#fff;
padding-bottom:20px;
box-shadow: 1px 1px 1px 1px #dedede;
min-height:340px;
}
.bar{
  height:100%;
  background-color: #149bdf;
  width:25%;
}
ol{
  list-style-type:decimal !important;
}
h3{
  font-size:18px;
  color:#4d4d4d !important;
  font-weight:500;
  margin-bottom:10px;
}
h4{
  font-size:16px;
  color:#4d4d4d !important;
}
.progress.active .bar {
  -webkit-animation: progress-bar-stripes 2s linear infinite;
  background-image: -webkit-gradient(linear,0 100%,100% 0,color-stop(0.25,rgba(255,255,255,0.15)),color-stop(0.25,transparent),color-stop(0.5,transparent),color-stop(0.5,rgba(255,255,255,0.15)),color-stop(0.75,rgba(255,255,255,0.15)),color-stop(0.75,transparent),to(transparent));
  background-image: -webkit-linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);
  background-image: -moz-linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);
  background-image: -o-linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);
  background-image: linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);
  -webkit-background-size: 40px 40px;
  -moz-background-size: 40px 40px;
  -o-background-size: 40px 40px;
  background-size: 40px 40px;
 }
 .ms-container{
  width:100% !important;
 }
 #exitReviewList, #entryReviewList, #beaconReview{
  margin-left:20px;
 }
 .nav-pills>li {
  width:33%;
  text-align:center;
 }
 .icon{
  width:60px;
  height:60px;
  fill:#25ad98 !important;
 }
 ul.nav-pills li.active a:hover, .active, ul.nav-pills li a, ul.nav-pills li, ul.nav-pills li a:hover{
  background:rgba(0,0,0,0) !important;
  padding:0 !important;
 }
ul.nav-pills li.active a{
  background:rgba(0,0,0,0) !important;
}
.labelIcons{
  padding-top:10px;
}
#submitLocation{
  bottom:0;
  position: absolute;
}



.dataTables_length, .dataTables_filter {
  margin: 0 15px;
}
#campaignTable th, #campaignTable tbody td{
  border:1px solid #dddddd;
  border-left:none;
}
#campaignTable{
  padding-top:15px;
  font-size:14px;
}
.dataTables_wrapper .dataTables_filter input{
  float:right;
}
#campaignTable th:first-child{
border-left:1px solid #dddddd;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active,
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover{
  color:#19b79a !important;
  background:#fff;
  border: 1px solid #cacaca;
}
.icon-editicon-01{
    width: 22px;
  height: 22px;
}
.editTD{
  text-align:center;
}
.icon-plus{
  fill:#1c7c6c;
  width: 23px;
  height: 23px;
  margin-top: 11px;
  margin-left:15px;
}
.dataTables_wrapper{
  margin-top:10px;
}
h1{
  float:left;
  color:#1c2025 !important;
}
.circle {
  width: 10px;
  height: 10px;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  border-radius: 5px;
  float:right;
  margin-top: 5px;

}
.green{
  background:#3DC23D;
  /*box-shadow:0px 1px 7px 1px #005926;
    box-shadow: 0px 1px 0px 1px #005926;
  */
}
.red{
  background:red;
  /*box-shadow:0px 1px 7px 1px #8A010B;
    box-shadow: 0px 1px 0px 1px #8A010B;
  */
}
.panel-heading{
  background:#dedede !important;
  text-align:left;
}
.campaignWrapper{
  background:#fbfbfb;
  margin-top:30px;
}
td .icon{
  width:22px;
  height:22px;
  display:block;
  margin: auto;
  fill:#666666 !important;
}
td .icon:hover{
  cursor:hand;
}
#beaconManufacturerDropdown,#beaconManufacturerBtnGroup, #beaconManufacturerDropdownMenu,#locationDropdown,#locationDropdownMenu{
  width:100%;
  text-align:left;
}
#beaconManufacturerDropdownMenu,#locationDropdownMenu{
  padding:8px;
  max-height:240px;
  overflow-y:scroll;
}
#beaconManufacturerDropdownMenu img{
  padding:5px;
}
#reviewZone ul{
  padding:10px;
}
#submitBeacon{
 float:right;
}

</style>
<script type="text/javascript">
$(document).ready(function(){

    var rootLocation = location.hostname;
    var beaconArr = [];
    var beaconAlias;
    var beaconUUID, beaconMajor, beaconMinor, beaconLocation;

    function submitBeacon(locationID,beaconAlias,beaconUUID,beaconMajor,beaconMinor){
      
      /*$.ajax({
            type: 'post',
          url: 'http://'+rootLocation+'/index.php/beacons/store',
            data: {locationID:locationID,beaconAlias:beaconAlias,beaconUUID:beaconUUID,beaconMajor:beaconMajor,beaconMinor:beaconMinor},
            success: function(response) { 
              console.log(response);
              //$('#campaignRoot').html('<h1>Campaign Successfully Saved</h1>');
              setTimeout(function(){  
                        window.location.assign('http://'+rootLocation+'/index.php/beacons');
                      }, 3000);
            }
      });*/
           console.log("here is locationID"+locationID);
           if(locationID.length <= 1){
              console.log("here is locationID is not set");
              locationID = null;
           }
           var xhr = new XMLHttpRequest();
              xhr.open('GET','http://'+rootLocation+'/beacons/create/'+beaconUUID+'/'+beaconMajor+'/'+beaconMinor+'/'+beaconAlias+'/'+locationID, false);
              xhr.send(null);
              if (xhr.status == 200) {
                console.log(xhr.response);
                 $('#tab3 .container').html('<div class="inner-content"><h1>Beacon Stored</h1></div>');
                  setTimeout(function(){  
                    window.location.assign('http://'+rootLocation+'/index.php/beacons');
                  }, 3000);
                }

            //});
      
    }
    $('#submitBeacon').click(function(){

      var r = confirm('Are you sure you have reviewed everything?');
      if (r == true) {
        var locationID = $('#locationDropdown').val();
        
        
          submitBeacon(locationID,beaconAlias,beaconUUID,beaconMajor,beaconMinor);
      } else {
        console.log(beaconArr);
          return false;
      }
    });


    $('#beaconName').keyup(function(){
        beaconAlias = $(this).val();
    });
    $('#beaconUUID').keyup(function(){
        beaconUUID = $(this).val();
    });
    $('#beaconMajor').keyup(function(){
        beaconMajor = $(this).val();
    });
    $('#beaconMinor').keyup(function(){
        beaconMinor = $(this).val();
    });
    $('#beaconManufacturerDropdownMenu li').click(function(){
        $('#beaconUUID').val($(this).attr('value'));
        beaconUUID = $(this).attr('value');
    });
    $('#locationDropdownMenu li').click(function(){
        $('#locationDropdown').val($(this).attr('value'));
        $('#locationDropdown').text($(this).text());
        beaconLocation = $(this).text();
    });
  $('#rootwizard').bootstrapWizard({
      tabClass: 'nav nav-pills',
          onTabShow: function(tab, navigation, index){
            //console.log(index);
            if(index == 0){
              $('#rootwizard').find('.bar').css({width:'33.3%'});
            }
            if(index == 1){
              $('#rootwizard').find('.bar').css({width:'66.6%'});
            }
            if(index == 2){
              $('#reviewName').html(beaconAlias);
              $('#reviewUUID').html(beaconUUID);
              $('#reviewMajor').html(beaconMajor);
              $('#reviewMinor').html(beaconMinor);
              $('#reviewLocation').html(beaconLocation);
              
              $('#rootwizard').find('.bar').css({width:'100%'});

              //$('#reviewAddress').html(addressString);
            
            }
          },onNext: function(tab, navigation, index, currentIndex) {
          var currentTab = $('#rootwizard').bootstrapWizard('currentIndex') ;
        switch(currentTab) {
            case 0:
                //var startDate = $('#startDate').val();
            //var endDate = $('#endDate').val();
            if( beaconAlias == '' || beaconAlias == undefined){
                alert("Beacon Name is not filled");
                return false;
            }
            if( beaconUUID == '' || beaconUUID == undefined){
                alert("Beacon UUID is not filled");
                return false;
            }
             if( beaconMajor == '' || beaconMajor == undefined){
                alert("Beacon Major is not filled");
                return false;
            }
             if( beaconMinor == '' || beaconMinor == undefined){
                alert("Beacon Minor is not filled");
                return false;
            }
            break;
            case 1:
               
            
            break;
            case 2:
            break;
          }
          },onTabClick: function(tab, navigation, index, currentIndex) {
          var currentTab = $('#rootwizard').bootstrapWizard('currentIndex') ;
        switch(currentTab) {
            case 0:
            if( beaconAlias == '' || beaconAlias == undefined){
                alert("Beacon Name is not filled");
                return false;
            }
            if( beaconUUID == '' || beaconUUID == undefined){
                alert("Beacon UUID is not filled");
                return false;
            }
             if( beaconMajor == '' || beaconMajor == undefined){
                alert("Beacon Major is not filled");
                return false;
            }
             if( beaconMinor == '' || beaconMinor == undefined){
                alert("Beacon Minor is not filled");
                return false;
            }
              break;
              case 1:
               
            
              break;
              case 2:
              break;
            }
          }
    });
    
    
});
</script>
<div class="innerContent" id="mainInnerContent">
<div class="container">

    <div class="col-md-12">
      <h1>Setup Beacon</h1>
      <!-- // Form Wizard / Arrow navigation & Progress bar END -->
    </div>
    <div class="col-md-12"> 
      <div id="rootwizard" class="setupBeacon">
        <div class="navbar">
          <div class="navbar-inner">
              <div class="container">
              <ul>
                <li><a href="#tab1" id="tab1Pill" data-toggle="tab"><svg class="icon icon-setuptest1"><use xlink:href="#icon-setuptest1"></use></svg><span class="mls"></span></a><span class="labelIcons">Setup</span></li>
                <li><a href="#tab2" data-toggle="tab"><svg class="icon icon-beaconsicon-04"><use xlink:href="#icon-beaconsicon-04"></use></svg><span class="mls"></span></a><span class="labelIcons">Beacons</span></li>
                <li><a href="#tab3" data-toggle="tab"><svg class="icon icon-reviewtest-031"><use xlink:href="#icon-reviewtest-031"></use></svg><span class="mls"></span></a><span class="labelIcons">Review</span></li>
              </ul>
            </div>
           </div>
        </div>
        <div id="bar" class="progress progress-striped active">
          <div class="bar"></div>
        </div>
        <div class="tab-content">
            <div class="tab-pane" id="tab1">
              <div class="container">
                <div class="row">
                    <div class='col-sm-12'>
                      <h2>1. Beacon Details</h2>
                      <p style="padding-bottom:20px;">
                        Start by filling out the beacon's UUID, Major, Minor and what you wish to call it.
                      </p>
                  </div>
                </div>
                <div class="row beaconDropDownDetails">
                    <div class='col-sm-6' style="padding-top:30px;">
                    <h6>Beacon Name</h6>
                  </div>
                   <div class='col-sm-6' style="padding-top:30px;">
                    <h6>Beacon Manufacturer UUID's</h6>
                  </div>
                  <!-- Small button group -->

                </div>
                <div class="row">
                  <div class="col-sm-6" >
                    <input id="beaconName" class="form-control" type="textbox" placeholder="Beacon Alias">
                    <!--<input type="button" value="Geocode"  id="addGeocode"> -->
                  </div>
                  <div class='col-sm-6 beaconDropDownDiv'>
                    <div class="btn-group" id="beaconManufacturerBtnGroup">
                      <button class="btn btn-default btn-sm dropdown-toggle" id="beaconManufacturerDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select Beacon <span class="caret"></span>
                      </button>  
                      <ul class="dropdown-menu" id="beaconManufacturerDropdownMenu">
                          <li value="E2C56DB5DFFB48D2B060D0F5A71096E0"><img src="/img/april_beacon.png">April Brothers </li>
                          <li value="24DDF4118CF1440C87CDE368DAF9C93E"><img src="/img/reco.png">Reco Beacon </li>
                      </ul>
                    </div>
                  </div>
              </div>

              <div class="row">
                  <div class='col-sm-6' style="padding-top:30px;">
                    <h6>Beacon UUID</h6>
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-6">
                    <input id="beaconUUID" class="form-control" style="width:100%" type="textbox" placeholder="Beacon UUID">
                    <!--<input type="button" value="Geocode"  id="addGeocode"> -->
                  </div>
              </div>
              <div class="row">
                    <div class='col-sm-6' style="padding-top:30px;">
                    <h6>Beacon Major Value</h6>
                  </div>
                </div>
              <div class="row">
                  <div class="col-sm-6" >
                    <input id="beaconMajor" class="form-control" type="textbox" placeholder="Beacon Minor (eg. 1)">
                    <!--<input type="button" value="Geocode"  id="addGeocode"> -->
                  </div>
              </div>
                 <div class="row">
                    <div class='col-sm-6' style="padding-top:30px;">
                    <h6>Beacon Minor Value</h6>
                  </div>
                </div>
              <div class="row">
                  <div class="col-sm-6" >
                    <input id="beaconMinor" class="form-control" type="textbox" placeholder="Beacon Minor (eg. 22)">
                    <!--<input type="button" value="Geocode"  id="addGeocode"> -->
                  </div>
              </div>

              </div>
          </div>
            <div class="tab-pane" id="tab2">
                <div class="container">
                  <div class="row">
                    <div class='col-sm-12'>
                      <h2>2. Locations</h2>
                      <p style="padding-bottom:20px;">Add the Location where your beacon is located.  Beacons which are physically present in your new location should be added here.
                      </p>
                  </div>
                </div>
                  <div class="row">
                  <div class='col-sm-6'>
                    <div class="btn-group" id="beaconManufacturerBtnGroup">
                      <button class="btn btn-default btn-sm dropdown-toggle" id="locationDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select Location <span class="caret"></span>
                      </button>  
                      <ul class="dropdown-menu" id="locationDropdownMenu">
                        <?php foreach($locations as $location){ ?>
                          <li value="<?php echo $location->_id; ?> "><?php echo $location->name; ?></li>
                        <?php } ?>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <div class="tab-pane" id="tab3">
             <div class="container">
             <div class="row">
                    <div class='col-sm-12'>
                      <h2>3. Review</h2>
                      <p style="padding-bottom:20px;">Review your location, beacons in your location and your location name before submitting.
                      </p>
                  </div>
                </div>  
              <div class="row">
                  <div id="reviewZone">
                    <ul>
                      <li>Name : <span id="reviewName"></span></li>
                      <li>UUID : <span id="reviewUUID"></span></li>
                      <li>Major : <span id="reviewMajor"></span></li>
                      <li>Minor : <span id="reviewMinor"></span></li>
                      <li>Location : <span id="reviewLocation"></span></li>
                    </ul>

                   
                  </div>
               </div>
                 <div class="row">
                    <button class="btn btn-primary" id="submitBeacon">Add Beacon</button>
                  </div>
              </div>
            </div>
        </div>  
        <ul class="pager wizard">
          <li class="previous first" style="display:none;"><a href="#">First</a></li>
          <li class="previous"><a href="#">Previous</a></li>
          <li class="next last" style="display:none;"><a href="#">Last</a></li>
            <li class="next"><a href="#" id="next">Next</a></li>
        </ul>
      </div>
    </div>
</div>
</div>

<!--modal-->
