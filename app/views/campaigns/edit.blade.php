<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Campaign</title>
@include("header2")
<?php
  $user = Auth::user();
?>  
@include("guestNav2")

<style>
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
 	width:24%;
 	text-align:center;
 }
 .icon{
 	width:60px;
 	height:60px;
 	fill:#1188a3 !important;
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
</style>
<script>
$(document).ready(function() {
	

	var campaignID = "<?php echo $campaign[0]->_id; ?>";
	var rootLocation = location.hostname;
	var exitArr = [];
	var entryArr = [];
	
	//select for appending beacon ids 
	$('#my-select').multiSelect({
		selectableHeader: "<div class='custom-header'>Configured Beacons</div>",
		selectionHeader: "<div class='custom-header'>Campaign Beacons</div>",
	  afterSelect: function(values){
	    beaconArr.push(values);
	  },
	  afterDeselect: function(values){
	    beaconArr.pop(values);
	  }
	});
	
	$(function(){
        $('#datetimepicker1').datetimepicker({
			sideBySide: true,
			format:'YYYY MM DD'
		});
		$('#datetimepicker2').datetimepicker({
			sideBySide: true,
			format:'YYYY MM DD'
		});
    });

	//final function for submitting the campaign to the controller
	function submitCampaign(beaconArr,entryArray,exitArray,campaignName,startDate,endDate){
		entryArray = [];
		exitArray = [];
		var beamCount = 0;
		$('#entryReviewList li').each(function(){
			entryArray[beamCount] = [$(this).attr('id')];
			beamCount++;
		});

		var beamCount = 0;
		$('#exitReviewList li').each(function(){
			exitArray[beamCount] = [$(this).attr('id')];
			beamCount++;
		});

		var beaconCount = 0;
		var beaconArr = [];
		$('#beaconReview li').each(function(){
			beaconArr[beaconCount] = [$(this).attr('id')];
			beaconCount++;
		});
		console.log(beaconArr);
		$.ajax({
			    type: 'post',
				url: 'http://'+rootLocation+'/index.php/campaigns/update/'+campaignID,
			    data: {beaconArr:beaconArr,entryArr:entryArray,exitArr:exitArray,campaignName:campaignName,startDate:startDate,endDate:endDate,campaignID:campaignID},
			    success: function(response) {
			    	/*var client = new Keen({
							projectId: "55ae574890e4bd376c52ba71",
							writeKey: "d333f8496adf52dc1a4880352a5691c7aa123103416a348ff8eff0f3bbc6f7b724354c3e91f3fb6863b2cbfc08578cd7b412e10432296aafad0069d91b0ae048e4ccb1579bc3191ff707fa51daa327c5120731cce290b536f6ec8b2a93936bb8082c807114fcf808842abfc377b821a8",
						      //, protocol: "https"
						    //host: 'http://sto.apengage.io',
						    readKey:"b10c212819208dcf47f7fa4e83718dbafa52dbd8612128a6d417aeef7faa902e33c975d1e687f0ffa19bc4f31ed2c27c9d5a6b33b9a18a382b61dffe7cd253836222a681fc94b8e2509b318fc8938efc0667b9f302e04b6a017c64e233ec3fdd260745f2f46f7de689a4055e693f0be9", 
						    requestType: "jsonp"
						});

						var updateCampaign = {
						  campaign:response,  
						  referrer: document.referrer,
						  keen: {
						    timestamp: new Date().toISOString()
						  }
						};

						// Send it to the "purchases" collection
						client.addEvent("updatedCampaign", updateCampaign, function(err, res){
						  if (err) {
						    // there was an error!
						  }
						  else {
						    // see sample response below
						  }
						});	
					*/	
			   		console.log(response);
			   		$('#campaignRoot').html('<h1>Campaign Successfully Updated</h1>');
			   		setTimeout(function(){  
                    	window.location.assign('http://'+rootLocation+'/index.php/campaigns');
                  	}, 3000);
			    }
		});
	}
	//click button function for submitting the campaign function, confirm?
	$('#submitCampaign').click(function(){

		var r = confirm('Are you sure you have reviewed everything?');
		if (r == true) {
			var campaignName = $('#campaignName').val();
			var startDate = $('#startDate').val();
			var endDate = $('#endDate').val();
		   	submitCampaign(beaconArr,entryArray,exitArray,campaignName,startDate,endDate);
		} else {
		    return false;
		}
	});

	//order selection function for selecting entry beams
	$('.orderSelect').change(function(){
		var selected = $(this);
		var selectVal = $(this).val();
		var selCount = 0;
		$('#entryTable tbody tr').each(function(index, value){

			var checked = $(this).children('td').slice(0);
        	var orderSel = $(this).children('td').slice(2);

        	checked = checked.children('input');
        	if(checked.prop( "checked" ) ){
        		orderSel = orderSel.children('select').val();
        		if(selectVal == orderSel){
        			selCount++;
        		}
        	}

		});
		if(selCount >= 2){
			alert(selCount + ' options or more selected, can only be one of each.');
			selected.val(0);
			return false;
		}
		
	});

	//exit order selection function
	$('.exitorderSelect').change(function(){
		var selected = $(this);
		var selectVal = $(this).val();
		var selCount = 0;
		$('#exitTable tbody tr').each(function(index, value){

			var checked = $(this).children('td').slice(0);
        	var orderSel = $(this).children('td').slice(2);

        	checked = checked.children('input');
        	if(checked.prop( "checked" ) ){
        		orderSel = orderSel.children('select').val();
        		if(selectVal == orderSel){
        			selCount++;
        		}
        	}

		});
		if(selCount >= 2){
			alert(selCount + ' options or more selected, can only be one of each.');
			selected.val(0);
			return false;
		}
		
	});

	//when beam is checked as appended to campaign:
	//entry check beam
	$('.checkBeam').change(function() {
	    if(this.checked) {
	        //Do stuff
	        entryAppendCount++;
	        //alert(entryAppendCount);
	        $('#entryTable tbody tr').each(function(index, value){
	        		var rowLine = $(this);
		        	var checked = $(this).children('td').slice(0);
		        	check = checked.children('input');
		        	if(check.prop( "checked" ) ){
		        		//rowLine.children('td').css('background','#72F5B8');
		        		var selectDrop = checked.children('select');
		        		var selectVal = selectDrop.find('option:selected').text();
		        		
			        	if( selectVal != '-' ){		
			        		if(selectVal > entryAppendCount){
			        			
			        			selectDrop.empty();
				        		selectDrop.append('<option value="0">-</option>');
				        		for(var t = 1; t <= entryAppendCount; t++){
				        			
				        			selectDrop.append('<option value="'+t+'">'+t+'</option>');
				        		}
			        		}else{
			        			
			        			selectDrop.empty();
				        		selectDrop.append('<option value="0">-</option>');
				        		for(var t = 1; t <= entryAppendCount; t++){
				        			
				        			selectDrop.append('<option value="'+t+'">'+t+'</option>');
				        		}
				        		var op = selectDrop.val(selectVal);
			        		}
			        	}
			        	else{
			        		
				        		
				        		selectDrop.empty();
				        		selectDrop.append('<option value="0">-</option>');
				        		for(var x = 1; x <= entryAppendCount; x++){
				        			selectDrop.append('<option value="'+x+'">'+x+'</option>');
				        		}
				        		var op = selectDrop.val(0);
				        	
			        	}
		        	}
		    });
	    }else{
	    	//condition else, if unchecked, bring count down
	    	//turn off select, update selects
	    	entryAppendCount--;
	    	// alert(entryAppendCount);
	    	$('#entryTable tbody tr').each(function(index, value){
	    			var rowLine = $(this);
		        	var checked = $(this).children('td').slice(0);
		        	check = checked.children('input');
		        	//var selectDrop = checked.children('select');
		        	//	selectDrop.empty();
		        	if(check.prop( "checked" ) ){
		        		
		        		var selectDrop = checked.children('select');
		        		var selectVal = selectDrop.find('option:selected').text();
		        		
			        	if( selectVal != '-' ){		
			        		if(selectVal > entryAppendCount){
			        			
			        			selectDrop.empty();
				        		selectDrop.append('<option value="0">-</option>');
				        		for(var t = 1; t <= entryAppendCount; t++){
				        			
				        			selectDrop.append('<option value="'+t+'">'+t+'</option>');
				        		}
			        		}else{
			        			
			        			selectDrop.empty();
				        		selectDrop.append('<option value="0">-</option>');
				        		for(var t = 1; t <= entryAppendCount; t++){
				        			
				        			selectDrop.append('<option value="'+t+'">'+t+'</option>');
				        		}
				        		var op = selectDrop.val(selectVal);
			        		}
			        	}
			        	else{
			        		
				        		selectDrop.empty();
				        		selectDrop.append('<option value="0">-</option>');
				        		for(var x = 1; x <= entryAppendCount; x++){
				        			selectDrop.append('<option value="'+x+'">'+x+'</option>');
				        		}
				        	
			        	}
		        	}else{
		        		rowLine.children('td').css('background','#fff');
		        		var selectDrop = checked.children('select');
		        		selectDrop.empty();
		        	}
		    });

	    }
	});

	//exit check beam
	$('.exitcheckBeam').change(function() {
	    if(this.checked) {
	        //Do stuff
	        exitAppendCount++;
	        $('#exitTable tbody tr').each(function(index, value){
	        		var rowLine = $(this);
		        	var checked = $(this).children('td').slice(0);
		        	check = checked.children('input');
		        	if(check.prop( "checked" ) ){
		        		//rowLine.children('td').css('background','#72F5B8');
		        		var selectDrop = checked.children('select');
		        		var selectVal = selectDrop.find('option:selected').text();
		        		
			        	if( selectVal != '-' ){		
			        		if(selectVal > exitAppendCount){
			        			
			        			selectDrop.empty();
				        		selectDrop.append('<option value="0">-</option>');
				        		for(var t = 1; t <= exitAppendCount; t++){
				        			
				        			selectDrop.append('<option value="'+t+'">'+t+'</option>');
				        		}
			        		}else{
			        			
			        			selectDrop.empty();
				        		selectDrop.append('<option value="0">-</option>');
				        		for(var t = 1; t <= exitAppendCount; t++){
				        			
				        			selectDrop.append('<option value="'+t+'">'+t+'</option>');
				        		}
				        		var op = selectDrop.val(selectVal);
			        		}
			        	}
			        	else{
			        		
				        		
				        		selectDrop.empty();
				        		selectDrop.append('<option value="0">-</option>');
				        		for(var x = 1; x <= exitAppendCount; x++){
				        			selectDrop.append('<option value="'+x+'">'+x+'</option>');
				        		}
				        	
			        	}
		        	}
		    });
	    }else{
	    	//turn off select, update selects
	  
	    	exitAppendCount--;
	    	$('#exitTable tbody tr').each(function(index, value){
	    			var rowLine = $(this);
		        	var checked = $(this).children('td').slice(0);
		        	check = checked.children('input');
		        	//var selectDrop = checked.children('select');
		        	//	selectDrop.empty();
		        	if(check.prop( "checked" ) ){
		        		
		        		var selectDrop = checked.children('select');
		        		var selectVal = selectDrop.find('option:selected').text();
		        		
			        	if( selectVal != '-' ){		
			        		if(selectVal > exitAppendCount){
			        			
			        			selectDrop.empty();
				        		selectDrop.append('<option value="0">-</option>');
				        		for(var t = 1; t <= exitAppendCount; t++){
				        			
				        			selectDrop.append('<option value="'+t+'">'+t+'</option>');
				        		}
			        		}else{
			        			
			        			selectDrop.empty();
				        		selectDrop.append('<option value="0">-</option>');
				        		for(var t = 1; t <= exitAppendCount; t++){
				        			selectDrop.append('<option value="'+t+'">'+t+'</option>');
				        		}
				        		var op = selectDrop.val(selectVal);
			        		}
			        	}
			        	else{
			        		
				        		selectDrop.empty();
				        		selectDrop.append('<option value="0">-</option>');
				        		for(var x = 1; x <= exitAppendCount; x++){
				        			selectDrop.append('<option value="'+x+'">'+x+'</option>');
				        		}
				        	
			        	}
		        	}else{
		        		rowLine.children('td').css('background','#fff');
		        		var selectDrop = checked.children('select');
		        		selectDrop.empty();
		        	}
		    });

	    }
	});

	//boot strap root wizard set up javascript
	$('#rootwizard').bootstrapWizard({
        tabClass: 'nav nav-pills',
        onTabShow: function(tab, navigation, index) {
        	
        	if(index == 0){
        		$('#rootwizard').find('.bar').css({width:'25%'});
        	}
        	if(index == 1){
        		$('#rootwizard').find('.bar').css({width:'50%'});
        	}
        	if(index == 2){
        		$('#rootwizard').find('.bar').css({width:'75%'});
        	}
        	if(index == 3){
        		$('#rootwizard').find('.bar').css({width:'100%'});
        		//setup
		        campaignName = $('#campaignName').val();
		        $('#campaignReviewName').text(campaignName);
		        campaignStart = $('#startDate').val();
		        $('#campaignReviewStart').text(campaignStart);
		        campaignEnd = $('#endDate').val();
		        $('#campaignReviewEnd').text(campaignEnd);

		        console.log(beaconArr.length);
		        if(beaconArr.length != 0){
		        	 $('#beaconReview').empty();
		        	for(var beacon in beaconArr){
		        	
		        	var xhr = new XMLHttpRequest();
			 					
		          	xhr.open('GET', 'http://'+rootLocation+'/index.php/api/beaconid/'+beaconArr[beacon], false);
		          	xhr.send(null);
		            if (xhr.status == 200) {
		            	var resp = JSON.parse(xhr.response);
		            
		              	$('#beaconReview').append('<li id="'+resp[0]._id+'">'+resp[0].alias+'</li>');
		            }
			 					
		          
		        	}
		    	}
        	}
        },
        onNext: function(tab, navigation, index, currentIndex) {
           var currentTab = $('#rootwizard').bootstrapWizard('currentIndex') ;
			switch(currentTab) {
		    	case 0:
		        	var campaignName = $('#campaignName').val();
					var startDate = $('#startDate').val();
					var endDate = $('#endDate').val();
					if( campaignName == ''){
							alert("campaign Name is not filled" + campaignName);
							return false;
					}
					if( startDate == ''){
							alert("start date not specified");
							return false;
					}
					if( endDate == ''){
							alert("end date not specified");
							return false;
					}
					
		        break;
		    	case 1:
		        	if(beaconArr.length <= 0){
		 				alert('no beacons selected');
		 				return false;
		 			}
		 			
		        break;
		        case 2:



		        var beamsProp = 0;
		        var exitbeamsProp = 0;
		        var orderProp = 0;
		        var exitOrderProp = 0;

		        var enArCount = 0;
		        var exArCount = 0;
				
		        entryArray = [];
		        $('#entryTable tbody tr').each(function(index, value){
		        	var rowID = $(this).attr('id');
		        	var checked = $(this).children('td').slice(0);
		        	var titleData = $(this).children('td').slice(1);
		        	titleData = titleData.attr('id');
		        	var orderSel = $(this).children('td').slice(2);
		        	checked = checked.children('input');
		        	if(checked.prop( "checked" ) ){
		        		beamsProp++;
		        		
		        		//check orders as well
		        		orderSel = orderSel.children('select').val();
		        		if(orderSel == 0 || orderSel == null){
		        			orderProp++;
		        		}else{
		        			//put into the entryArray
		        			entryArray[enArCount] = [rowID,titleData,orderSel];
		        			enArCount++;
		        		}
		        	}
		        	
		        });
		        exitArray = [];
		        $('#exitTable tbody tr').each(function(index, value){
		        	var rowID = $(this).attr('id');
		        	var checked = $(this).children('td').slice(0);
		        	var orderSel = $(this).children('td').slice(2);
		        	checked = checked.children('input');
		        	var titleData = $(this).children('td').slice(1);
		        	titleData = titleData.attr('id');
		        	if(checked.prop( "checked" ) ){
		        		exitbeamsProp++;
		        		
		        		//check orders as well
		        		orderSel = orderSel.children('select').val();
		        		//alert(orderSel);
		        		if(orderSel == 0 || orderSel == null){
		        			exitOrderProp++;
		        		}else{
		        			//put into the entryArray
		        			exitArray[exArCount] = [rowID,titleData,orderSel];
		        			exArCount++;
		        		}
		        	}
		        	
		        });
		       
		        if(beamsProp <= 0 && exitbeamsProp <= 0){
		        		alert("no entry or exit beams have been added to the campaign, please add some.");
		        		return false;
		        }
		        if(orderProp > 0 && exitOrderProp > 0){
		        		alert("no orders have been specified for entry and exit beams, or some have not been ordered yet. Please give them an order in which you would like them to appear and scroll.");
		        		return false;
		        }
		        if(exitOrderProp > 0){
		        	alert('one or more exit beam orders are missing');
		        	return false;
		        }

		        if(orderProp > 0){
		        	alert('one or more entry message orders are missing');
		        	return false;
		        }
		        //need to send the entry/exit array to the review tables
		        if(entryArray.length <= 0){
		        	$('#entryReviewList').hide();
		        	$('#entryTitle').hide();
		        }else{
		        	//populate table
		        	$('#entryTitle').show();
		        	$('#entryReviewList').show();
		        	$('#entryReviewList').empty();
		        	for(var s = 0; s <= entryArray.length-1; s++){
		        		var beam = entryArray[s];
		        				//$('#exitReviewTable tbody').append('<tr id="'+beam[0]+'"><td>'+beam[1]+'</td><td>'+beam[2]+'</td></tr>');
		        				$('#entryReviewList').append('<li id="'+beam[0]+'" data-sortby="'+beam[2]+'">'+beam[1]+'</li>');
		        	}
		        	var ul = $('#entryReviewList'),li = ul.children('li');
				   
				    li.detach().sort(function(a,b) {
				        return $(a).data('sortby') - $(b).data('sortby');  
				    });
				    
				    ul.append(li);	

		        }

		        if(exitArray.length <= 0){
		        	$('#exitReviewList').hide();
		        	$('#exitTitle').hide();
		        }else{
		        	//populate table
		        	$('#exitTitle').show();
		        	$('#exitReviewList').show();
		        	$('#exitReviewList').empty();
		        	for(var s = 0; s <= exitArray.length-1; s++){
		        		var beam = exitArray[s];
		        				
		        				$('#exitReviewList').append('<li id="'+beam[0]+'" data-sortby="'+beam[2]+'">'+beam[1]+'</li>');
		        	}
		        	var ul = $('#exitReviewList'),li = ul.children('li');
				   
				    li.detach().sort(function(a,b) {
				        return $(a).data('sortby') - $(b).data('sortby');  
				    });
				    
				    ul.append(li);		
		        }
		        //setup
		        campaignName = $('#campaignName').val();
		        $('#campaignReviewName').text(campaignName);
		        campaignStart = $('#startDate').val();
		        $('#campaignReviewStart').text(campaignStart);
		        campaignEnd = $('#endDate').val();
		        $('#campaignReviewEnd').text(campaignEnd);

		        
		        
		        break;
		        case 3:
		        break;
	    	
			}
        },
         onTabClick: function(tab, navigation, index, currentIndex) {
            var currentTab = $('#rootwizard').bootstrapWizard('currentIndex') ;
			switch(currentTab) {
		    	case 0:
		        	var campaignName = $('#campaignName').val();
					var startDate = $('#startDate').val();
					var endDate = $('#endDate').val();
					if( campaignName == ''){
							alert("campaign Name is not filled" + campaignName);
							return false;
					}
					if( startDate == ''){
							alert("start date not specified");
							return false;
					}
					if( endDate == ''){
							alert("end date not specified");
							return false;
					}
					
		        break;
		    	case 1:
		        	if(beaconArr.length <= 0){
		 				alert('no beacons selected');
		 				return false;
		 			}
		 			
		        break;
		        case 2:



		        var beamsProp = 0;
		        var exitbeamsProp = 0;
		        var orderProp = 0;
		        var exitOrderProp = 0;

		        var enArCount = 0;
		        var exArCount = 0;
				
		        entryArray = [];
		        $('#entryTable tbody tr').each(function(index, value){
		        	var rowID = $(this).attr('id');
		        	var checked = $(this).children('td').slice(0);
		        	var titleData = $(this).children('td').slice(1);
		        	titleData = titleData.attr('id');
		        	var orderSel = $(this).children('td').slice(2);
		        	checked = checked.children('input');
		        	if(checked.prop( "checked" ) ){
		        		beamsProp++;
		        		
		        		//check orders as well
		        		orderSel = orderSel.children('select').val();
		        		if(orderSel == 0 || orderSel == null){
		        			orderProp++;
		        		}else{
		        			//put into the entryArray
		        			entryArray[enArCount] = [rowID,titleData,orderSel];
		        			enArCount++;
		        		}
		        	}
		        	
		        });
		        exitArray = [];
		        $('#exitTable tbody tr').each(function(index, value){
		        	var rowID = $(this).attr('id');
		        	var checked = $(this).children('td').slice(0);
		        	var orderSel = $(this).children('td').slice(2);
		        	checked = checked.children('input');
		        	var titleData = $(this).children('td').slice(1);
		        	titleData = titleData.attr('id');
		        	if(checked.prop( "checked" ) ){
		        		exitbeamsProp++;
		        		
		        		//check orders as well
		        		orderSel = orderSel.children('select').val();
		        		//alert(orderSel);
		        		if(orderSel == 0 || orderSel == null){
		        			exitOrderProp++;
		        		}else{
		        			//put into the entryArray
		        			exitArray[exArCount] = [rowID,titleData,orderSel];
		        			exArCount++;
		        		}
		        	}
		        	
		        });
		       
		        if(beamsProp <= 0 && exitbeamsProp <= 0){
		        		alert("no entry or exit beams have been added to the campaign, please add some.");
		        		return false;
		        }
		        if(orderProp > 0 && exitOrderProp > 0){
		        		alert("no orders have been specified for entry and exit beams, or some have not been ordered yet. Please give them an order in which you would like them to appear and scroll.");
		        		return false;
		        }
		        if(exitOrderProp > 0){
		        	alert('one or more exit beam orders are missing');
		        	return false;
		        }

		        if(orderProp > 0){
		        	alert('one or more entry message orders are missing');
		        	return false;
		        }
		        //need to send the entry/exit array to the review tables
		        if(entryArray.length <= 0){
		        	$('#entryReviewList').hide();
		        	$('#entryTitle').hide();
		        }else{
		        	//populate table
		        	$('#entryTitle').show();
		        	$('#entryReviewList').show();
		        	$('#entryReviewList').empty();
		        	for(var s = 0; s <= entryArray.length-1; s++){
		        		var beam = entryArray[s];
		        				//$('#exitReviewTable tbody').append('<tr id="'+beam[0]+'"><td>'+beam[1]+'</td><td>'+beam[2]+'</td></tr>');
		        				$('#entryReviewList').append('<li id="'+beam[0]+'" data-sortby="'+beam[2]+'">'+beam[1]+'</li>');
		        	}
		        	var ul = $('#entryReviewList'),li = ul.children('li');
				   
				    li.detach().sort(function(a,b) {
				        return $(a).data('sortby') - $(b).data('sortby');  
				    });
				    
				    ul.append(li);	

		        }

		        if(exitArray.length <= 0){
		        	$('#exitReviewList').hide();
		        	$('#exitTitle').hide();
		        }else{
		        	//populate table
		        	$('#exitTitle').show();
		        	$('#exitReviewList').show();
		        	$('#exitReviewList').empty();
		        	for(var s = 0; s <= exitArray.length-1; s++){
		        		var beam = exitArray[s];
		        				
		        				$('#exitReviewList').append('<li id="'+beam[0]+'" data-sortby="'+beam[2]+'">'+beam[1]+'</li>');
		        	}
		        	var ul = $('#exitReviewList'),li = ul.children('li');
				   
				    li.detach().sort(function(a,b) {
				        return $(a).data('sortby') - $(b).data('sortby');  
				    });
				    
				    ul.append(li);		
		        }
		        //setup
		        campaignName = $('#campaignName').val();
		        $('#campaignReviewName').text(campaignName);
		        campaignStart = $('#startDate').val();
		        $('#campaignReviewStart').text(campaignStart);
		        campaignEnd = $('#endDate').val();
		        $('#campaignReviewEnd').text(campaignEnd);

		        //beacons list
		       
		
		        
		        break;
		        case 3:
		        break;
	    	
			}
        }
  	});

});
$.ajaxSetup({
   		headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
});
</script>
   
       
<!-- /---------Start Content --------------/ -->
<div class="innerContent" id="mainInnerContent">
<div class="container">
<div class="row">
    <div id="campaignRoot" class="col-md-12">
     <h1>Edit Campaign</h1>
     <div id="rootwizard" class="campaignRootWizard">
	<div class="navbar">
	  <div class="navbar-inner">
	    <div class="container">
	<ul>
	  	<li><a href="#tab1" id="tab1Pill" data-toggle="tab"><svg class="icon icon-setuptest1"><use xlink:href="#icon-setuptest1"></use></svg><span class="mls"></span></a><span class="labelIcons">Setup</span></li>
		<li><a href="#tab2" data-toggle="tab"><svg class="icon icon-beaconsicon-04"><use xlink:href="#icon-beaconsicon-04"></use></svg><span class="mls"></span></a><span class="labelIcons">Beacons</span></li>
		<li><a href="#tab3" data-toggle="tab"><svg class="icon icon-beamsicon-02-02"><use xlink:href="#icon-beamsicon-02-02"></use></svg><span class="mls"></span></a><span class="labelIcons">Beams</span></li>
		<li><a href="#tab4" data-toggle="tab"><svg class="icon icon-reviewtest-031"><use xlink:href="#icon-reviewtest-031"></use></svg><span class="mls"></span></a><span class="labelIcons">Review</span></li>

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
	    		  		<h2>1. Setup</h2>
	    		  		<p style="padding-bottom:20px;">Start with a name for your campaign, and specify a start date and end date.  The Campaign will Allow any of your content to be added and pushed to an app
	    		  			during the start and end date.  You can go back and edit your campaign at anytime.
	    		  		</p>
	    		 	</div>
	    		</div>
	    		 <div class="row">
	    		  	<div class='col-sm-6'>
			    		<h6>Campaign Title</h6>
			    	</div>
			    </div>
			    <div class="row">
			        <div class='col-sm-6'>
			        	
	      				<input placeholder="campaign title" class="form-control" id="campaignName" class="required email" value="<?php echo $campaign[0]->title;?>">
	      			</div>
	            </div>
	        </div>
	      	<!--datepicker start date-->
	      	<div class="container">
	      		<div class="row">
			        <div class='col-sm-6'>
			        	<h6>Start Date</h6>
			        </div>
			    </div>
			    <div class="row">
			        <div class='col-sm-6'>
			            <div class="form-group">
			                <div class='input-group date' id='datetimepicker1'>
			                    <input type='text' id="startDate" class="form-control" value="<?php echo $campaign[0]->startDate;?>" />
			                    <span class="input-group-addon">
			                        <span class="glyphicon glyphicon-calendar"></span>
			                    </span>
			                </div>
			            </div>
			        </div>
			    
			    </div>
			</div>
			<!--datepicker end date-->
			<div class="container">
				<div class="row">
			        <div class='col-sm-6'>
			        	<h6>End Date</h6>
			        </div>
			    </div>
			    <div class="row">
			        <div class='col-sm-6'>
			            <div class="form-group">
			                <div class='input-group date' id='datetimepicker2'>
			                	
			                    <input type='text' id="endDate" class="form-control" value="<?php echo $campaign[0]->endDate;?>" />
			                    <span class="input-group-addon">
			                        <span class="glyphicon glyphicon-calendar"></span>
			                    </span>
			                </div>
			            </div>
			        </div>
			    
			    </div>
			</div>
	    </div>
	    <div class="tab-pane" id="tab2">
	        <div class="container">
	        <div class="row">
	    		  	<div class='col-sm-12'>
	    		  		<h2>2. Beacons</h2>
	    		  		<p style="padding-bottom:20px;">
	    		  			Add specific beacons to the campaign to control where you will deploy your content.  Add multiple beacons to cover more areas or target specific content.
	    		  		</p>
	    		 	</div>
	    		</div>	
	        	<div class="row">	
	        		<div class='col-sm-12'>
				     
				      <select multiple="multiple" id="my-select" name="my-select[]">
				      		<!--<optgroup label='Beacon Name'>-->
				      		<script>
				      			var beaconArr = [];
				      		</script>
					     	 <?php 
					     	 	foreach($beacons as $beacon){
					     	 		$bCount = 0; 
					     	 		foreach($campaign[0]->beacons as $beaconA){ 
					     	 			if($beaconA == $beacon->_id){
								      		echo "<option value='".$beacon->_id."' selected>".$beacon->alias."</option>";
								      		//echo "<script> var beaconArr = []; beaconArr.push(".$beacon->_id."); console.log(beaconArr); </script>";
								      		$bCount++;
								      	?>
								      		<script> beaconArr.push("<?php echo $beacon->_id; ?>"); </script>
								      	<?php
								      	}/*else{
								      		echo "<option value='".$beacon->_id."'>".$beacon->alias."</option>";
								      	}*/
								      	
								    }
								    if($bCount == 0){
								    	echo "<option value='".$beacon->_id."'>".$beacon->alias."</option>";
								    }
								}
							?>
					    </select>
					    <script>
				      			console.log(beaconArr);
				      		</script>
				    </div>
			    </div>
		    </div>
	    </div>
		<div class="tab-pane" id="tab3">
			 <div class="container">	
				<div class="row">
				    <div class='col-sm-12'>
						<h2>3. Beams</h2>
						<p style="padding-bottom:20px;">
	    		  			Add specific "Entry" or "Exit" Beams to your new campaign.  This content will push to the app on user entering or exiting beacon proximity regions.
	    		  			Once you have added the beams you want to appear, you must specify the order in which you want them to appear.  
	    		  		</p>
					</div>
				</div>
				
				<div class="row">
				    <div class='col-sm-6'>
				        <div class="form-group" style="max-height: 234px;overflow-y: scroll;">
				        	
							<table id="entryTable" class="table table-striped">
								<thead>
									<tr><th>Entry</th><th>Beam Title</th><th>Order</th></tr>
								</thead>
							<tbody>
							<script>
								var entryArray = [];
								var exitArray = [];

								//var beaconArr = [];
								var exitArr = [];
								var entryArr = [];
								var entryAppendCount = 0;
								var exitAppendCount = 0;


								var beamsProp = 0;
						        var exitbeamsProp = 0;
						        var orderProp = 0;
						        var exitOrderProp = 0;

						        var enArCount = 0;
						        var exArCount = 0;
							</script>
						 	 <?php 
						 	 	$perkSize = sizeOf($perks);
						 	 	
						 	 	foreach($perks as $perk){ 
						 	 		$startCount = 0;
						 	 		$selCount = 1;
						 	 		if(isset($campaign[0]->entry) && sizeOf($campaign[0]->entry) >= 1){
						 	 		foreach($campaign[0]->entry as $entryA){ 
						 	 			
						 	 			if($entryA == $perk->_id){
						 	 				echo "<tr id='".$perk->_id."'><td ><input name='permission' type='checkbox' value='Y' class='checkBeam' checked></td><td  id='".$perk->title."'>".$perk->title."</td><td class='orderSelectTD'><select id='".$perk->_id."' class='orderSelect'>";
						 	 				
						 	 				for($t = 0; $t <= sizeOf($campaign[0]->entry); $t++){
						 	 					echo "<option value='".$t."' ";

						 	 					if($t == $selCount){
						 	 						echo " selected>".$t."</option>";
						 	 						
						 	 					}else{
						 	 						echo " >".$t."</option>";

						 	 					}
						 	 					
						 	 				}
						 	 				//foreach size of entry beams, count, populate option list.
						 	 				echo "</select></td></tr>";
						 	 				$startCount++;
						 	 				?>
						 	 				<script>

						 	 					entryArray[enArCount] = ["<?php echo $perk->_id;?>","<?php echo $perk->title;?>",enArCount+1];
						 	 					//console.log("p entry size: <?php echo sizeOf($campaign[0]->entry); ?>");
		        								enArCount++;
		        								entryAppendCount++;
						 	 				</script>
						 	 			<?php
						 	 			}
						      			$selCount++;
						      		}
						      		if($startCount == 0){
						 	 				
						      				echo "<tr id='".$perk->_id."'><td><input name='permission' type='checkbox' value='Y' class='checkBeam' ></td><td id='".$perk->title."'>".$perk->title."</td><td class='orderSelectTD'><select class='orderSelect'></select></td></tr>";
						      		}
						      		}
						      		 else{
						      		echo "<tr id='".$perk->_id."'><td><input name='permission' type='checkbox' value='Y' class='checkBeam' ></td><td id='".$perk->title."'>".$perk->title."</td><td class='orderSelectTD'><select class='orderSelect'></select></td></tr>";
						      		}
						      	}
						      ?>
						    </tbody>
						    </table>
	               		</div>
				    </div>
		
				    <div class='col-sm-6'>
				        <div class="form-group" style="max-height: 234px;overflow-y: scroll;">
				        	
							<table id="exitTable" class="table table-striped">
								<thead>
									<tr><th>Exit</th><th>Beam Title</th><th>Order</th></tr>
								</thead>
							<tbody>

						 	 <?php 
						 	 	$perkSize = sizeOf($perks);
						 	 	
						 	 	foreach($perks as $perk){ 
						 	 		$startCount = 0;
						 	 		$selCount = 1;
						 	 		if(isset($campaign[0]->exit) && sizeOf($campaign[0]->exit) >= 1){
						 	 		foreach($campaign[0]->exit as $entryA){ 
						 	 			
						 	 			if($entryA == $perk->_id){ //style='background:#72F5B8'
						 	 				echo "<tr id='".$perk->_id."'><td><input name='permission' type='checkbox' value='Y' class='exitcheckBeam' checked></td><td  id='".$perk->title."'>".$perk->title."</td><td  class='exitorderSelectTD'><select id='".$perk->_id."' class='exitorderSelect'>";
						 	 				
						 	 				for($t = 0; $t <= sizeOf($campaign[0]->exit); $t++){
						 	 					echo "<option value='".$t."' ";

						 	 					if($t == $selCount){
						 	 						echo " selected>".$t."</option>";
						 	 						
						 	 					}else{
						 	 						echo " >".$t."</option>";

						 	 					}
						 	 					
						 	 				}
						 	 				//foreach size of entry beams, count, populate option list.
						 	 				echo "</select></td></tr>";
						 	 				$startCount++;
						 	 				?>
						 	 				<script>

						 	 					exitArray[exArCount] = ["<?php echo $perk->_id;?>","<?php echo $perk->title;?>",exArCount+1];
						 	 					//console.log("p entry size: <?php echo sizeOf($campaign[0]->entry); ?>");
		        								exArCount++;
		        								exitAppendCount++;
						 	 				</script>
						 	 			<?php
						 	 			}
						      			$selCount++;
						      		}
						      		if($startCount == 0){
						 	 				
						      				echo "<tr id='".$perk->_id."'><td><input name='permission' type='checkbox' value='Y' class='exitcheckBeam' ></td><td id='".$perk->title."'>".$perk->title."</td><td class='exitorderSelectTD'><select class='exitorderSelect'></select></td></tr>";
						      		}

						      	}//end if
						      	else{
						      		echo "<tr id='".$perk->_id."'><td><input name='permission' type='checkbox' value='Y' class='exitcheckBeam' ></td><td id='".$perk->title."'>".$perk->title."</td><td class='exitorderSelectTD'><select class='exitorderSelect'></select></td></tr>";
						      	}
						      }
						      ?>
						    </tbody>
						    </table>

	               		</div>
				    </div>
				 </div>
				
				 
		    </div>
	    </div>
		<div class="tab-pane" id="tab4">
			<div class="container">	
				<div class="row">
				    <div class='col-sm-12'>
						<h2>4. Review your Campaign</h2>
					</div>
				</div>
				<div class="row">
				    <div class='col-sm-12'>
						<h3>Setup</h3>
						Campaign Name : <span id="campaignReviewName"><?php echo $campaign[0]->title;?></span><br/>
						Start Date : <span id="campaignReviewStart"><?php echo $campaign[0]->startDate;?></span><br/>
						End Date : <span id="campaignReviewEnd"><?php echo $campaign[0]->endDate;?></span><br/>
				   </div> 
				   <div class='col-sm-12'>
						
						<h3>Beacons</h3>
						<ul id="beaconReview">
							<!--<?php foreach($campaign[0]->beacons as $beacon){
								echo "<li>".$beacon."</li>";
							}
							?>-->
							<?php 
					     	 	foreach($beacons as $beacon){
					     	 		$bCount = 0; 
					     	 		foreach($campaign[0]->beacons as $beaconA){ 
					     	 			if($beaconA == $beacon->_id){
								      		echo "<li id='".$beacon->_id."' >".$beacon->alias."</li>";
								      		//echo "<script> var beaconArr = []; beaconArr.push(".$beacon->_id."); console.log(beaconArr); </script>";
								      	
								
								      	}
								      	
								    }
								}
							?>
						</ul>
				   </div>  
				</div>  
				<div class="row">
					<div class='col-sm-12'>
						<h3>Beams</h3>
					</div>
				    <div class='col-sm-6'>
						<h4 id="entryTitle">Entry Beams</h4>
						<ol id="entryReviewList">
							<?php 
						 	 	$perkSize = sizeOf($perks);
						 	 	
						 	 	foreach($perks as $perk){ 
						 	 		$startCount = 0;
						 	 		if(isset($campaign[0]->entry) && sizeOf($campaign[0]->entry) >= 1){
						 	 		foreach($campaign[0]->entry as $entryA){ 
						 	 			
						 	 			if($entryA == $perk->_id){ //style='background:#72F5B8'
						 	 				echo "<li id='".$perk->_id."'>".$perk->title."</li>";
						 	 			
						 	 				$startCount++;
						 	 				?>
						 	 			<?php
						 	 			}
						      			$selCount++;
						      		}
						      	}

						      	}
						      ?>
						</ol>
						
				   </div>  
				   <div class='col-sm-6'>
				   		<h4 id="exitTitle">Exit Beams</h4>
						<ol id="exitReviewList">
							<?php 
						 	 	$perkSize = sizeOf($perks);
						 	 	
						 	 	foreach($perks as $perk){ 
						 	 		$startCount = 0;
						 	 		if(isset($campaign[0]->exit) && sizeOf($campaign[0]->exit) >= 1){
						 	 		foreach($campaign[0]->exit as $entryA){ 
						 	 			
						 	 			if($entryA == $perk->_id){ //style='background:#72F5B8'
						 	 				echo "<li id='".$perk->_id."'>".$perk->title."</li>";
						 	 			
						 	 				$startCount++;
						 	 				?>
						 	 			<?php
						 	 			}
						      			$selCount++;
						      		}
						      		}

						      	}
						      ?>
						</ol>
						
						
				   </div>
				   <div class='col-sm-12'>
				   		<h3>Update</h3>
				   		<p>Once you have reviewed your new campaign, click launch to activate it.  You can edit campaigns from the campaign index page.</p>
						<button id="submitCampaign" class="btn btn-primary">Update Campaign</button>
				   </div>
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
  <!-- // Form Wizard / Arrow navigation & Progress bar END -->
</div>
</div>
</div>