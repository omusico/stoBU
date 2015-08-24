<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dashboard</title>
@include("header2")
</head>
<body>

<?php
	$user = Auth::user();
	

	if($user->user_access == "Admin"){
	?>	@include("nav")<?php
	}else{
	?>	@include("guestNav2")<?php
	}
?>
<style>
body{
	background:#edecf3 !important;
}
.item {
 margin-bottom:10px;
}

.masonImg{
	width:50px;
	margin-right:20px;
}

.itemContainer-2{
	padding:20px;
	min-height:350px;
	/*overflow-x:scroll;*/

}
.itemContainer ul{
	float:left;

}
.itemContainer ul li{
	list-style:none;
	color:#fff;
	font-size:13px;
}
.itemContainer a{
	color:#fff;
}
.itemContainer{
	padding:20px;
	height:60px;
	background:#fbfbfb;
}
.itemFooter{
	border-top:3px solid #dfdee5;
	background:#fbfbfb;
	padding:0px 20px;
		text-align:center;
	height:40%;
	min-height:30px;
}
.itemContainer2{
	padding:20px;
	/*min-height:125px;*/
	background:#fbfbfb;
}
.itemContainer3{
	padding:20px;
	min-height:179px;
	background:#fbfbfb;
}
.itemFooter2{
	border-top:3px solid #dfdee5;
	background:#fbfbfb;
	padding:0px 20px;
	text-align:center;
	height:40%;
	min-height:50px;
}
.itemHeader{
	border-bottom:3px solid #dfdee5;
	background:#fbfbfb;
	padding:0px 20px;
	min-height:30px;
}
.itemFooter a{
	float:right;
	padding:5px 0px;
}

.vizPre{
	min-width:300px;
}
.itemContainer .icon{
	fill:#1786a5;
}
.itemFooter .itemLabels{
	text-align:center;
	margin:auto;
}
.itemLabels{
	 font-family: "Open Sans";
  color: #1c2025;
  font-weight:500;
  font-size:15px;
}
#mainInnerContent{
width:100% !important;
}
#carousel-campaigns .carousel-indicators li{
	color:#d0e5ee;
	background-color:#d0e5ee;
	top:88px;
	position:relative;
}
#carousel-campaigns .icon{
	width:100px;
	height:100px;
	margin-top:5px;
}
.carousel{
	margin-bottom:0px;
}
#carousel-campaigns .item{
	text-align:center;
}
#carousel-main h2{
	text-align:right;
}
#carousel-main #inCount{
	  font-size: 26px;
	  font-family: 'Roboto Slab', sans-serif;
  		margin: 0 0 5px;
  		font-weight: 400;
  		color: #4d4d4d;
  		top:0;
  		font-style:normal;
}
#carousel-main .carousel-indicators li{
	color:#d0e5ee;
	background-color:#d0e5ee;
	top:46px;
	position:relative;
}
#carousel-main .icon{
	float:left;
	margin-top:-2px;
	width:36px;
	height:36px;
}
.carousel-indicators .active{
	color:#1c8cb6;
	background-color:#1c8cb6 !important;
}

#carousel-users .carousel-indicators li{
	color:#d0e5ee;
	background-color:#d0e5ee;
	top:88px;
	position:relative;
}
#carousel-users .icon{
	width:100px;
	height:100px;
	margin-top:5px;
}
#carousel-users .item{
	text-align:center;
}

#carousel-beacons .carousel-indicators li{
	color:#d0e5ee;
	background-color:#d0e5ee;
	top:88px;
	position:relative;
}
#carousel-beacons .icon{
	width:100px;
	height:100px;
	margin-top:5px;
}
#carousel-beacons .item{
	text-align:center;
}
.itemContainer4{
	min-height:300px;
	background:#fbfbfb;

}
.leftSide{
	width:80%;
	height:100%;
	min-height:300px;
}
.leftSide iframe{
	width:100%;
	height:100%;
	border:none;
	min-height:300px;
}
</style>
<script src="https://cdn.firebase.com/js/client/2.2.4/firebase.js"></script>
<script>
$(document).ready( function() {
	

		//campaigns
    $("#carousel-campaigns").carousel({
     	 interval : false,
         pause: true
    });

     $("#carousel-main").carousel({
     	 interval : 5000,
         pause: true
     });
     $("#carousel-users").carousel({ interval : false,
         pause: true
     });
     $("#carousel-beacons").carousel({ interval : false,
         pause: true
     });
	//handle in/out firebase
	var ref = new Firebase("https://salesdemo.firebaseio.com");
	var beaconID = "<?php if(isset($beacons[0])){echo $beacons[0]->_id;}else{echo '0';}?>";
	var bref = ref.child(beaconID);
		//alert(beaconID);
	var inCount = 0;
	ref.on("value", function(snapshot) {

		var newPost = snapshot.val();
		var object = newPost[beaconID];
		//var keys = Object.keys(snapshot.val());
		//var len = object.length;
		console.log(object);
	  	for(var rec in object){
	  		//console.log(rec);
	  		//console.log(object[rec]);
	  		if(object[rec] == "in"){
	  			inCount++;
	  		}
	  	}
	  	console.log(inCount);
	  	$('#inCount').text(inCount);
	  	inCount = 0;
	 
	});
	

});



</script>
<div class="innerContent" id="mainInnerContent">
<div class="container">
<div class="row">
		<div class="col-md-3 item">
			<div class="col-md-12">
				<h1>Dashboard</h1>
			</div>
		</div>
		<div class="col-md-6 item">
			<div class="col-md-12">
						<div class="itemContainer">	
	      					<div id="carousel-main" class="carousel slide" data-ride="carousel">
							  <!-- Indicators -->
							  <ol class="carousel-indicators">
							    <li data-target="#carousel-main" data-slide-to="0" class="active"></li>
							    <li data-target="#carousel-main" data-slide-to="1"></li>
							    <li data-target="#carousel-main" data-slide-to="2"></li>
							  </ol>

							  <!-- Wrapper for slides -->
							  <div class="carousel-inner" role="listbox">
							   <div class="item active">
							   	<svg class="icon icon-arrows-01"><use xlink:href="#icon-arrows-01"></use></svg><span class="mls"></span>
							     <h2>800 Total Visitors</h2>
							   
						    	</div>
						    	<div class="item">
						    		<svg class="icon icon-user-06"><use xlink:href="#icon-user-06"></use></svg><span class="mls"></span>
						      		<h2>10 Visitors Today</h2>
						 
						    	</div>
						    	<div class="item">
						    		<svg class="icon icon-location-07"><use xlink:href="#icon-location-07"></use></svg><span class="mls"></span>
						      		<h2>
	      						<span id="inCount"></span> Users are In Proximity	
	      							</h2>
						 
						    	</div>
						   	</div>
						 </div>
	      					
	      				</div>
	      				<div class="itemFooter">
	      					
	      				</div>
	      	</div>
		</div>

		<div class="col-md-3 item">
			<div class="col-md-12">
				<div class="itemHeader">
      					<span class="itemLabels">Activity Feed</span>
      			</div>
				<div class="itemContainer">	
					
	      					
	      					
	      				</div>
	      			
	      	</div>
		</div>
		<div class='col-md-9 item'>
			
			
			<div class="col-md-4">
	      			<div class="itemContainer2">	
	      				<div id="carousel-campaigns" class="carousel slide" data-ride="carousel">
							  <!-- Indicators -->
							  <ol class="carousel-indicators">
							    <li data-target="#carousel-campaigns" id="campSlide0" data-slide-to="0" class="active"></li>
							    <li data-target="#carousel-campaigns" id="campSlide1" data-slide-to="1"></li>
							    <li data-target="#carousel-campaigns" id="campSlide2" data-slide-to="2"></li>
							  </ol>

							  <!-- Wrapper for slides -->
							  <div class="carousel-inner" role="listbox">
							   <div class="item active">
							      <svg class="icon icon-campaigns-05"><use xlink:href="#icon-campaigns-05"></use></svg><span class="mls"></span>
							   
						    	</div>
						    	<div class="item">
						      		 <svg class="icon icon-campaigns-05"><use xlink:href="#icon-campaigns-05"></use></svg><span class="mls"></span>
						 
						    	</div>
						    	<div class="item">
						      		 <svg class="icon icon-campaigns-05"><use xlink:href="#icon-campaigns-05"></use></svg><span class="mls"></span>
						 
						    	</div>
						   	</div>
						 </div>
	      					
	      			</div>
	      			<div class="itemFooter2">
	      					<span class="itemLabels">Campaigns</span>

	      			</div>
	      		</div>

	      		<div class="col-md-4">
	      				<div class="itemContainer2">	
	      					<div id="carousel-users" class="carousel slide" data-ride="carousel">
							  <!-- Indicators -->
							  <ol class="carousel-indicators">
							    <li data-target="#carousel-users" data-slide-to="0" class="active"></li>
							    <li data-target="#carousel-users" data-slide-to="1"></li>
							    <li data-target="#carousel-users" data-slide-to="2"></li>
							  </ol>

							  <!-- Wrapper for slides -->
							  <div class="carousel-inner" role="listbox">
							   <div class="item active">
							      <svg class="icon icon-users-02"><use xlink:href="#icon-users-02"></use></svg><span class="mls"></span>
							   
						    	</div>
						    	<div class="item">
						      		 <svg class="icon icon-users-02"><use xlink:href="#icon-users-02"></use></svg><span class="mls"></span>
						 
						    	</div>
						    	<div class="item">
						      		 <svg class="icon icon-users-02"><use xlink:href="#icon-users-02"></use></svg><span class="mls"></span>
						 
						    	</div>
						   	</div>
						 </div>
	      				</div>
	      				<div class="itemFooter2">
	      					<span class="itemLabels">Users</span>
	      				</div>
	      		</div>

	      		<div class="col-md-4">
	      				<div class="itemContainer2">	
	      					<div id="carousel-beacons" class="carousel slide" data-ride="carousel">
							  <!-- Indicators -->
							  <ol class="carousel-indicators">
							    <li data-target="#carousel-beacons" data-slide-to="0" class="active"></li>
							    <li data-target="#carousel-beacons" data-slide-to="1"></li>
							    <li data-target="#carousel-beacons" data-slide-to="2"></li>
							  </ol>

							  <!-- Wrapper for slides -->
							  <div class="carousel-inner" role="listbox">
							   <div class="item active">
							      <svg class="icon icon-beacon-04"><use xlink:href="#icon-beacon-04"></use></svg><span class="mls"></span>
							   
						    	</div>
						    	<div class="item">
						      		 <svg class="icon icon-beacon-04"><use xlink:href="#icon-beacon-04"></use></svg><span class="mls"></span>
						 
						    	</div>
						    	<div class="item">
						      		 <svg class="icon icon-beacon-04"><use xlink:href="#icon-beacon-04"></use></svg><span class="mls"></span>
						 
						    	</div>
						   	</div>
						 </div>
	      					
	      				</div>
	      				<div class="itemFooter2">
	      					<span class="itemLabels">Beacons</span>
	      				</div>
	      		</div>
		</div>
		<div class='col-md-3 item'>
			<div class="" id="in_outDashboard">
						<div class="col-md-12">
						<div class="itemHeader">
      						<span class="itemLabels">Customers In Proximity</span>
      					</div>
	      				<div class="itemContainer3">	
	      					
	      					<div class="ulContainer">
	      					<ul>
	      							
	      					</ul>
	      					</div>
	      				</div>
	      			
	      		</div>
			</div>
		</div>

	<div class='col-md-9 item'>
		<div class="col-md-12">
			<div class="itemContainer4">	
				<div class="leftSide">
					<iframe src="http://198.1.96.237/filemaker/map.php"></iframe>
				</div>	
				<div class="rightSide">

				</div>		
	      	</div>
		</div>
	</div>

	<div class='col-md-3 item'>
		<div class="col-md-12">
			<div class="itemContainer4">	

			</div>
		</div>
	</div>
 <!--start  analytics modal-->
  
<!--end Modals-->

</div>
</div>
</div>

<!--@include("footer")-->


</body>
</html>
