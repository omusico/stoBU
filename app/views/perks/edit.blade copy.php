@include("header2")
<?php
  $user = Auth::user();
  
  ?>  
  @include("guestNav2")

	<?php
//print_r($beamID);
$beamID = $beamID[0];
//exit;
$media = Media::where('status','=',1)->where('company','=',$beamID['companyID'])->get();
?>
<style>
  .whitePanel{
  margin:10px;
  background:#fff;
  padding:8px;
  box-shadow: 1px 1px 1px 1px #dedede;
    min-height:516px;
  }
</style>
<script>
$(document).ready(function(){
  //nicescroll init 
  
  $("#iphonePerk").niceScroll();
  //check the submission and process new values
	$('#submitMe').click(function(){
	    //event.preventDefault();
	  	 var val = $("#edit_").editable("getHTML");
	      $("#field_name_").attr('value',val);
	      $("#field_value_").attr('value',val);
	     var string = $("#field_name_").val();

     /* var mainImage = $("#mediaImg").val();
      mainImage = "http://<?php echo $_SERVER['HTTP_HOST'];?>"+mainImage;
      $('#mediaImg').val(mainImage);*/
	    var confirmed =  confirm('Are you Sure?');
	    if(confirmed == false){
	        return false;
	    }else{


	    }
	});

	//handle prview

	var style = '<style>.right{height:30px;float:left;}.banner .left{float:left;padding-right: 10px;}.banner .right span{margin-top:10px;}img{float:left;}.banner{clear:both}.banner span{font-size:10px;padding-top:5%;line-height:1;font-weight:300;}.banner img{width:25px !important;height:25px;padding:5px;float:left;}.perkBody img{width:100%;}.perkHeader{text-align:center;}.perkDesc p{font-size:10px;}</style><link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic" rel="stylesheet" type="text/css">';
   var imgSet = '<?php if(isset($beamID->mainImg)){ echo $beamID->mainImg;}?>';
  if(imgSet== '' ||  imgSet== undefined){
    var html5 = style+'<div class="perkBody" style="width:100%;background:#fff;"><div class="banner"><div class="left"><img src="<?php echo $company->setImage;?>"></div><div class="right"><span><br/><?php if(isset($beamID->label)){ echo $beamID->label;}?></span></div></div><div class="perkHeader" style="width:100%;margin:auto;background:white;clear:both;"><h3 style="font-family:Lato light 100;font-weight:300;margin-top:20px;line-height: 49px;"><?php echo $beamID->title;?></h3></div><div class="perkDesc" style="padding:5px;text-align:center;width:92%;margin:auto;background:white;"><?php echo $beamID->elements[0]["content"];?></div><div class="perkFooter" style="font-style:italic;font-size:10px;padding:5px;text-align:center;width:90%;margin:auto;background:white;"></div></div>';
  }else{
    var html5 = style+'<div class="perkBody" style="width:100%;background:#fff;"><div class="banner"><div class="left"><img src="<?php echo $company->setImage;?>"></div><div class="right"><span><br/><?php if(isset($beamID->label)){ echo $beamID->label;}?></span></div></div><div class="perkHeader" style="width:100%;margin:auto;background:white;clear:both;"><img style="margin-bottom:10px;" src="<?php if(isset($beamID->mainImg)){ echo $beamID->mainImg;}?>"><h3 style="font-family:Lato light 100;font-weight:300;margin-top:20px;line-height: 49px;"><?php echo $beamID->title;?></h3></div><div class="perkDesc" style="padding:5px;text-align:center;width:92%;margin:auto;background:white;"><?php echo $beamID->elements[0]["content"];?></div><div class="perkFooter" style="font-style:italic;font-size:10px;padding:5px;text-align:center;width:90%;margin:auto;background:white;"></div></div>';
  }

    $("#iphonePerk").html(html5);
    //key ups 
  //key ups 
    $('#beamTitle').keyup(function(){
         var mainImage = $("#mediaImg").val();
         mainImage = "http://<?php echo $_SERVER['HTTP_HOST'];?>"+mainImage;
        var val = $("#edit_").editable("getHTML");
        $("#field_name_").attr('value',val);
        $("#field_value_").attr('value',val);
        var disclaimer = $("#beamDisclaimer").val();
        var label = $("#beamLabel").val();

        var string = $("#field_name_").val();
        var style = '<style>.right{height:30px;float:left;}.banner .left{float:left;padding-right: 10px;}.banner .right span{margin-top:10px;}img{float:left;}.banner{clear:both}.banner span{font-size:10px;padding-top:5%;line-height:1;font-weight:300;}.banner img{width:25px !important;height:25px;padding:5px;float:left;}.perkBody img{width:100%;}.perkHeader{text-align:center;}.perkDesc p{font-size:10px;}</style><link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic" rel="stylesheet" type="text/css">';
        var html5 = style+'<div class="perkBody" style="width:100%;background:#fff;"><div class="banner"><div class="left"><img src="<?php echo $company->setImage;?>"></div><div class="right"><span><br/>'+label+'</span></div></div><div class="perkHeader" style="width:100%;margin:auto;background:white;clear:both;"><img style="margin-bottom:10px;" src="'+mainImage+'"><h3 style="font-family:Lato light 100;font-weight:300;margin-top:20px;line-height: 49px;">'+$('#beamTitle').val()+'</h3></div><div class="perkDesc" style="padding:5px;text-align:center;width:92%;margin:auto;background:white;">'+string+'</div><div class="perkFooter" style="font-style:italic;font-size:10px;padding:5px;text-align:center;width:90%;margin:auto;background:white;">'+disclaimer+'</div></div>';
       
       // var html5 = '<style>.perkBody img{width:100%;}</style><div class="perkBody" style="width:100%;background:#00b8ba;"><div class="perkHeader" style="width:90%;margin:auto;background:white;padding:5px;"><h3>'+$('#beamTitle').val()+'</h3><img src="'+mainImage+'"></div><div class="perkDesc" style="padding:5px;text-align:center;width:90%;margin:auto;background:white;">'+string+'</div><div class="perkFooter" style="padding:5px;text-align:center;width:90%;margin:auto;background:white;">'+disclaimer+'</div></div>';
        $("#iphonePerk").html(html5);
      });

      $('#beamDisclaimer').keyup(function(){
        var mainImage = $("#mediaImg").val();
         mainImage = "http://<?php echo $_SERVER['HTTP_HOST'];?>"+mainImage;
        var val = $("#edit_").editable("getHTML");
        $("#field_name_").attr('value',val);
        $("#field_value_").attr('value',val);
        var disclaimer = $("#beamDisclaimer").val();
         var label = $("#beamLabel").val();

        var string = $("#field_name_").val();
        var style = '<style>.right{height:30px;float:left;}.banner .left{float:left;padding-right: 10px;}.banner .right span{margin-top:10px;}img{float:left;}.banner{clear:both}.banner span{font-size:10px;padding-top:5%;line-height:1;font-weight:300;}.banner img{width:25px !important;height:25px;padding:5px;float:left;}.perkBody img{width:100%;}.perkHeader{text-align:center;}.perkDesc p{font-size:10px;}</style><link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic" rel="stylesheet" type="text/css">';
        var html5 = style+'<div class="perkBody" style="width:100%;background:#fff;"><div class="banner"><div class="left"><img src="<?php echo $company->setImage;?>"></div><div class="right"><span><br/>'+label+'</span></div></div><div class="perkHeader" style="width:100%;margin:auto;background:white;clear:both;"><img style="margin-bottom:10px;" src="'+mainImage+'"><h3 style="font-family:Lato light 100;font-weight:300;margin-top:20px;line-height: 49px;">'+$('#beamTitle').val()+'</h3></div><div class="perkDesc" style="padding:5px;text-align:center;width:92%;margin:auto;background:white;">'+string+'</div><div class="perkFooter" style="font-style:italic;font-size:10px;padding:5px;text-align:center;width:90%;margin:auto;background:white;">'+disclaimer+'</div></div>';
       
        $("#iphonePerk").html(html5);
      });
      $('.logo').click(function(){
        var mainImage = $("#mediaImg").val();
         mainImage = "http://<?php echo $_SERVER['HTTP_HOST'];?>"+mainImage;
        var val = $("#edit_").editable("getHTML");
        $("#field_name_").attr('value',val);
        $("#field_value_").attr('value',val);
        var disclaimer = $("#beamDisclaimer").val();
       var label = $("#beamLabel").val();

        var string = $("#field_name_").val();
        var style = '<style>.right{height:30px;float:left;}.banner .left{float:left;padding-right: 10px;}.banner .right span{margin-top:10px;}img{float:left;}.banner{clear:both}.banner span{font-size:10px;padding-top:5%;line-height:1;font-weight:300;}.banner img{width:25px !important;height:25px;padding:5px;float:left;}.perkBody img{width:100%;}.perkHeader{text-align:center;}.perkDesc p{font-size:10px;}</style><link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic" rel="stylesheet" type="text/css">';
        var html5 = style+'<div class="perkBody" style="width:100%;background:#fff;"><div class="banner"><div class="left"><img src="<?php echo $company->setImage;?>"></div><div class="right"><span><br/>'+label+'</span></div></div><div class="perkHeader" style="width:100%;margin:auto;background:white;clear:both;"><img style="margin-bottom:10px;" src="'+mainImage+'"><h3 style="font-family:Lato light 100;font-weight:300;margin-top:20px;line-height: 49px;">'+$('#beamTitle').val()+'</h3></div><div class="perkDesc" style="padding:5px;text-align:center;width:92%;margin:auto;background:white;">'+string+'</div><div class="perkFooter" style="font-style:italic;font-size:10px;padding:5px;text-align:center;width:90%;margin:auto;background:white;">'+disclaimer+'</div></div>';
       
        $("#iphonePerk").html(html5);
      });

      $('#edit_').keyup(function(){
         var mainImage = $("#mediaImg").val();
          mainImage = "http://<?php echo $_SERVER['HTTP_HOST'];?>"+mainImage;
        var val = $("#edit_").editable("getHTML");
        $("#field_name_").attr('value',val);
        $("#field_value_").attr('value',val);
        var disclaimer = $("#beamDisclaimer").val();
        var label = $("#beamLabel").val();

        var string = $("#field_name_").val();
        var style = '<style>.right{height:30px;float:left;}.banner .left{float:left;padding-right: 10px;}.banner .right span{margin-top:10px;}img{float:left;}.banner{clear:both}.banner span{font-size:10px;padding-top:5%;line-height:1;font-weight:300;}.banner img{width:25px !important;height:25px;padding:5px;float:left;}.perkBody img{width:100%;}.perkHeader{text-align:center;}.perkDesc p{font-size:10px;}</style><link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic" rel="stylesheet" type="text/css">';
        var html5 = style+'<div class="perkBody" style="width:100%;background:#fff;"><div class="banner"><div class="left"><img src="<?php echo $company->setImage;?>"></div><div class="right"><span><br/>'+label+'</span></div></div><div class="perkHeader" style="width:100%;margin:auto;background:white;clear:both;"><img style="margin-bottom:10px;" src="'+mainImage+'"><h3 style="font-family:Lato light 100;font-weight:300;margin-top:20px;line-height: 49px;">'+$('#beamTitle').val()+'</h3></div><div class="perkDesc" style="padding:5px;text-align:center;width:92%;margin:auto;background:white;">'+string+'</div><div class="perkFooter" style="font-style:italic;font-size:10px;padding:5px;text-align:center;width:90%;margin:auto;background:white;">'+disclaimer+'</div></div>';
       
        $("#iphonePerk").html(html5);
      });
      
      $('#beamLabel').keyup(function(){
        var mainImage = $("#mediaImg").val();
         mainImage = "http://<?php echo $_SERVER['HTTP_HOST'];?>"+mainImage;
        var val = $("#edit_").editable("getHTML");
        $("#field_name_").attr('value',val);
        $("#field_value_").attr('value',val);
        var disclaimer = $("#beamDisclaimer").val();
       var label = $("#beamLabel").val();

        var string = $("#field_name_").val();
        var style = '<style>.right{height:30px;float:left;}.banner .left{float:left;padding-right: 10px;}.banner .right span{margin-top:10px;}img{float:left;}.banner{clear:both}.banner span{font-size:10px;padding-top:5%;line-height:1;font-weight:300;}.banner img{width:25px !important;height:25px;padding:5px;float:left;}.perkBody img{width:100%;}.perkHeader{text-align:center;}.perkDesc p{font-size:10px;}</style><link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic" rel="stylesheet" type="text/css">';
        var html5 = style+'<div class="perkBody" style="width:100%;background:#fff;"><div class="banner"><div class="left"><img src="<?php echo $company->setImage;?>"></div><div class="right"><span><br/>'+label+'</span></div></div><div class="perkHeader" style="width:100%;margin:auto;background:white;clear:both;"><img style="margin-bottom:10px;" src="'+mainImage+'"><h3 style="font-family:Lato light 100;font-weight:300;margin-top:20px;line-height: 49px;">'+$('#beamTitle').val()+'</h3></div><div class="perkDesc" style="padding:5px;text-align:center;width:92%;margin:auto;background:white;">'+string+'</div><div class="perkFooter" style="font-style:italic;font-size:10px;padding:5px;text-align:center;width:90%;margin:auto;background:white;">'+disclaimer+'</div></div>';
       
        $("#iphonePerk").html(html5);
      });
});
</script>

  
<div class="innerContent" id="mainInnerContent">
  <div class="beamContainer">
    <div class="row">
       <div class="col-md-12">
    	   <h1>Update Beam</h1>
      </div>
    <div class="col-md-8">
       <div class="whitePanel">
    <div class="row beamRow" >


              @if($beamID)
                  {{ Form::open([
                    "route"        => "update perk",
                    "autocomplete" => "off",
                    "enctype" =>"multipart/form-data",
                    "method" => "PUT"
                  ]) }}


                <div class="col-md-12">
                  <div class="item">

                            {{ Form::label("beamtitle", "Beam Title") }}
                 {{ Form::text("label",$beamID['label'], [
                    "placeholder" => "perk label (max characters 40) ","class" =>"form-control",'id'=>'beamLabel'
                ]) }}
                             {{ Form::label("beamtitle", "Beam Heading") }}
                      {{ Form::text("beamtitle", $beamID['title'], [
                        "placeholder" => $beamID['title'] ,"class" =>"form-control","id"=>"beamTitle"
                      ]) }}
                <div style="float:left;" class="showSelectedLogo">
                  <?php if(isset($beamID->mainImg)){
                    echo "<img height='45' width='64' src='".$beamID->mainImg."'>";
                  }?> 
                </div>
                  {{ Form::label("logo", "Main Image (above description/below title)") }}
               <button class="btn-primary btn" style="clear: both;float: left;" id="logoBtn" 
						onclick="callLoadLogo('<?php echo $beamID['companyID']; ?>');return false;">Add Main Image</button>
                <?php if(isset($beamID->mainImg)){ ?>
                {{ Form::text("image", $beamID->mainImg, ["class" =>"form-hidden", "id" => "mediaImg"]) }}
                <?php }else{ ?>
                 {{ Form::text("image", Input::get('image'), ["class" =>"form-hidden", "id" => "mediaImg"]) }}
                <?php }?>
                  </div>
                </div>
                <div class="col-md-12">
       
                </div>
           
             
      </div>
      <div class="row beamRow rowSeprator"> <!-- 3rd row for content for eg field choosen-->

        <div class="col-md-12">
          <div id="field_wrap">
            <h3 id="fieldTitle"></h3>
            	  <?php  $elements = $beamID['elements'];
                    	 $string = $elements[0]['content']; 
                    	 $string =  strip_tags($string,'<img>,<table>,<td>,<th>,<thead>,<tbody>,<tr>,<iframe>,<a>,<b>,<i>,<br>,<div>,<h1>,<h2>,<h3>,<h4>,<h5>,<h6>,<p>');
                    ?>   
         			 <div class="field crit_" id='crit_'><p><span class="option_title"></span></p>
         			 	<input value="" class="field_name wsi form-control hidden" type="text" id="field_name_" name="field_name_" /></input> 
         			 	<section id="editor"><div class='editAll' id="edit_" style="margin-top: 30px;"></div></section><hr/><input class="field_value form-control hidden" type="text" id="field_value_" name="field_value_" /></input></div>
          </div>
        </div>


            {{ Form::text('beamID', $beamID['_id'], ["class"=>"form-hidden"]) }}
            <button type="submit" id='submitMe' class="beamDelete  sendBeam">Update</button>
          {{Form::close()}}
          @endif
   
      </div><!--end rowbeam-->
      </div><!--end whitePanel-->
    </div><!-- end left col -->

    <div class="col-md-4">
       <div class="whitePanel">
      		<div id="iphonePreview">
              <div class="container" id="iphonePerk">
                
              </div>
          </div>

      
        </div><!-- end right col -->
    </div>
    </div>
</div>


</div>
</div>
</div>
<script>
	$("#edit_").editable({
			imageUploadURL : '/uploadImage',
			inlineMode     : false,  
       placeholder:'',
			preloaderSrc   : "", 
			imageDeleteURL : "", 
			imagesLoadURL  : "/asset/images/true",
			buttons: [ 
      'bold','italic','underline',
        'strikeThrough','createLink','insertHorizontalRule','html','selectAll','insertVideo'
				/*'bold','italic','underline',
				'strikeThrough','subscript','superscript',
				'align','createLink',
				'insertMyImage',
				'insertHorizontalRule','undo','redo','html' */],
			customButtons: {
				insertMyImage: {
					title: 'insert image',
					icon: {
						type: 'font',
						value: 'fa fa-picture-o'
					},
					callback: function () {
						callLoadLogo2('<?php echo $beamID['companyID']; ?>')
					}
				}
			}
		});
	$("#edit_").editable("setHTML", '<?php echo $string; ?>', false);
</script>
<!--------------------------------- addLogo Dialog ---------------------------------------->
<style>
	#addLogoModal .logoArea{ max-height:250px;overflow:auto; }
	#addLogoModal .logoArea .logo{ margin:10px;border-radius:8px; }
	#addLogoModal .logoArea .logo:hover{ cursor:pointer;box-shadow:0 0 10px #000; }
</style>
<div class="modal fade" id="addLogoModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add image</h4>
			</div>
			<div class="modal-body">
				<div align="center" class="logoArea"></div>
				<div class="uploadLogoArea">
					<div class="innerLR">
						<!-- Widget -->
						<div class="widget widget-heading-simple widget-body-gray">
							<!--<div class="widget-body">-->
							<!-- Plupload -->
							<form id="pluploadForm">
								<input type="hidden" name="dir" id="dir" value="<?php echo $beamID['companyID']; ?>"  />
							</form>
							<div id="pluploadUploader">
								<!-- // Plupload END -->
								<!--</div>-->
							</div>
							<!-- // Widget END -->
						</div><!--inner LR end-->
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script src="/js/logoUpload.js"></script>	