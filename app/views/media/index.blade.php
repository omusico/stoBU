<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Media Manager</title>
@include("header2")
<?php
  $user = Auth::user();
  
  ?>  @include("guestNav2")<?php
 
$media      = Media::where('status','=',1)->where('company','=',$user->companyID)->get();
$recycleCnt = Media::where('status','=',2)->where('company','=',$user->companyID)->count();
?>
<!-- =========================================Media Section Begins Here============================================ -->
<style>
	.imgPanel img{
		border-radius:5px;
	}
	.imgPanel{
		padding:5px;
	}
	.imgPanelInner{
		max-width:100px;
		max-height:100px;
		height:100px;
		width:100px;
		border-radius:5px;
		border: 1px solid #dedede;
	}
	.imgPanel{
		padding:5px;
		float:left;
		width:110px;
		height:110px;
	}
	.imgPanelInner button, .imgPanelInner button:hover{
		background:rgba(0,0,0,0);
		border:none;
		margin-top:-10px;
		width:25px;
	}
	.imgPanelInner button .icon{
		width:20px;
		height:20px;
	}
	.renameLogo,.deleteLogo{
		float:right;
	}
	#icon-editbutton-02 .path1 {
	fill: rgb(115, 120, 130);
	}
	#icon-editbutton-02 .path2 {
		fill: rgb(255, 255, 255);
	}

	#icon-closebutton-01 .path1 {
		fill: rgb(222, 31, 38);
	}
	#icon-closebutton-01 .path2, #icon-closebutton-01 .path3 {
		fill: rgb(255, 255, 255);
	}
	.grayscale{
		box-shadow: inset 0 0 10px rgb(28, 140, 182);
	}
	.uploadBtn{ /*position:fixed;top:80px;left:20px;*/ margin:10px 0 30px 0;width:100%;}
	.uploadBtn #recycleBtn{ float:right;<?php if( $recycleCnt==0 ){ echo 'display:none;'; } ?> }
	.logoArea{ margin-top:50px; }
	.logoArea .logo{ margin:20px;border-radius:8px; }
	.logoArea .logo:hover{ cursor:pointer;box-shadow:0 0 20px #f00; }
	
	
	.tableArea{ width:100%;background:#fff; }
	#tableArea{ width:100%; }
	.tableArea .dataTables_wrapper{ width:80%;min-width:600px;text-align:center; }
	.tableArea .dataTables_filter>label>input{ float:none; }
	#recycleBinArea_filter>label>input{ float:none; }
	.plupload_container{
		padding:0 !important;
	}
	.panel-heading{
	background:#dedede !important;
	text-align:left;
	margin-top:20px;
	}
	.plupload_disabled, a.plupload_disabled:hover,.plupload_add{
		color:#000;
		background:#dedede;
	}
	.icon-bin,#recycleBtn{
		float:right;

	}
	.imageGrid{
		margin-top:30px;padding: 10px 7.5px !important;
	}
	.recyclingBin{
		float:left;width:10%;padding-top:32px;
	}
	.recyclingBinHidden{
		display:block;opacity:0;float:right;margin-right: -32px;height: 32px;
	}
/*	.tableArea #tableArea_filter>label>input{ float:none; } */
</style>
<script src="/js/logoUpload.js"></script>
<div class="innerContent" id="mainInnerContent">
<div class="container">
<!--<div class="row">-->
<div class="col-md-12">
	<div style="float:left;width:90%;">
		<h1>Content</h1>
		<h4>Media Manager</h4>
	</div>
	<div class="recyclingBin">
		<svg title="Recycling Bin" class="icon icon-bin"><use xlink:href="#icon-bin"></use></svg><span class="mls"></span>
		<button class="recyclingBinHidden"  id="recycleBtn" onclick="callRecycleLogo();">bin</button>
	</div>
</div>

<div class="tableArea col-md-12">
	<div class="uploadBtn">
<!--		<button class="btn btn-primary" id="logoBtn"    onclick="callLoadLogo3();">add image</button> -->
		<!--<button class="btn btn-primary" id="logoBtn"    onclick="callLoadLogo('<?php echo $user->companyID; ?>');">add image</button>-->
		

		<div class="uploadLogoArea">
					<div class="innerLR">
						<!-- Widget -->
						<div class="widget widget-heading-simple widget-body-gray">
							<!--<div class="widget-body">-->
							<!-- Plupload -->
							<form id="pluploadForm">
								<input type="hidden" name="dir" id="dir" value="<?php echo $user->companyID; ?>"  />
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
</div>


<div class="tableArea col-md-12 imageGrid">
	<?php
		foreach( $media as $key=>$row ){
			try{
				if( file_exists("userlogo/{$row->company}/{$row->filename}") ){
					list($w , $h , $t , $a ) = getimagesize("userlogo/{$row->company}/{$row->filename}");
					?>
					
						<div class="imgPanel">
							<div class="imgPanelInner" style="background:url(<?php echo "/userlogo/{$row->company}/{$row->filename}"; ?>);background-repeat:no-repeat;background-size:cover;background-position:center;">
							<!--<img src="/userlogo/<?php echo "{$row->company}/{$row->thumbnailfilename}"; ?>"/>-->
							<!--<button class="showLogo"
								onclick="callShowLogo(<?php echo "'/userlogo/{$row->company}/{$row->filename}',$w,$h,'{$row->image_name}'"; ?>);">
							</button>-->
							<button class="deleteLogo"
								onclick="callDeleteLogo(<?php echo "'/userlogo/{$row->company}/{$row->filename}','{$row->image_name}','{$row->_id}'"; ?>);">
								<svg class="icon icon-closebutton-01"><use xlink:href="#icon-closebutton-01"></use></svg><span class="mls"></span>
							</button>
							<button class="renameLogo" onclick="callRenameLogo(<?php echo "'/userlogo/{$row->company}/{$row->filename}','{$row->image_name}','{$row->_id}'"; ?>)">
								<svg class="icon icon-editbutton-02"><use xlink:href="#icon-editbutton-02"></use></svg><span class="mls"></span>
							</button>
							</div>
						</div>
					
					<?php
				}else{
					?>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td><?php echo $row->image_name; ?></td>
						<td>File not found</td>
						<td>
							<button class="btn btn-danger"
								onclick="callDeleteLogo(<?php echo "'/userlogo/{$row->company}/{$row->thumbnailfilename}','{$row->image_name}','{$row->_id}'"; ?>);">
								delete
							</button>
						</td>
						<td>&nbsp;</td>
					</tr>
					<?php
				}
			}catch( Exception $e ){
				?>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><?php echo $row->image_name; ?></td>
					<td><?php echo $e->getMessage(); ?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<?php
			}
		}
	?>
	
</div>
	
<!--</div>-->
</div>
</div>

<!--Add logo Modal-->
<div class="modal fade" id="addLogoModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add image</h4>
			</div>
			<div class="modal-body">
				<!--<div align="center" class="logoArea"></div>-->
				<div class="uploadLogoArea">
					<div class="innerLR">
						<!-- Widget -->
						<div class="widget widget-heading-simple widget-body-gray">
							<!--<div class="widget-body">-->
							<!-- Plupload -->
							<form id="pluploadForm">
								<input type="hidden" name="dir" id="dir" value="<?php echo $user->companyID; ?>"  />
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
				<button type="button" class="btn btn-default" id="closeModalBtn" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="deleteLogoModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header"></div>
			<div class="modal-body" style="overflow:auto;max-width:600px;max-height:600px;">
				<img src="" id="deleteLogo"/>
				<input type="hidden" id="id" />
			</div>
			<div class="modal-footer">
				<div id="showHideDeleteDIV1">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
				<div style="display:none"  id="showHideDeleteDIV2">
					Are you sure?
					<button type="button" class="btn btn-danger" onclick="doDeleteLogo()">Yes</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
				</div>
				<div style="display:none"  id="showHideDeleteDIV3">
					<i style="float:left">rename to: <input type="text" style="float:right;margin-left:5px;padding:2px 5px;" maxlength="50" id="newLogoName" /></i>
					<button type="button" class="btn btn-danger" onclick="doRenameLogo()">Submit</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!--recycling Bin Modal-->
<div class="modal fade" id="recycleBinModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
	<div class="modal-dialog" style="width:1000px;">
		<div class="modal-content" >
			<div class="modal-header">
				<button class="btn btn-danger" id="deleteAllBtn" style="float:right" onclick="callDeleteAllRLogo()">empty recycle bin</button>
				<h4 class="modal-title">Recycle bin</h4>
			</div>
			<div class="modal-body">
				<div class="innerLR">
					<div class="widget widget-heading-simple widget-body-gray">
						<?php $recycleBin = Media::where('status','=',2)->where('company','=',$user->companyID)->get(); ?>
						<table id="recycleBinArea" align="center" class="hover" width="100%">
						<thead>
							<th>Logo</th>
							<th>File name</th>
							<th>Create at</th>
							<th>Last modify</th>
							
							<th>Delete</th>
							<th>Restore</th>
						</thead>
						<tbody>
						<?php
							foreach( $recycleBin as $key=>$row ){
								$srcThumbnail="/userlogo/{$row->company}/{$row->thumbnailfilename}";
								try{
									if( file_exists("userlogo/{$row->company}/{$row->filename}")){
										list($w , $h , $t , $a ) = getimagesize("userlogo/{$row->company}/{$row->filename}");
										?>
										<tr>
											<td>
												<img src="/userlogo/<?php echo "{$row->company}/{$row->thumbnailfilename}"; ?>"/>
											</td>
											<td><?php echo $row->image_name; ?></td>
											<td><?php echo $row->created_at;/*date ("Y/m/d H:i:s.", $row->date);*/ ?></td>
											<td><?php echo $row->updated_at;/*date ("Y/m/d H:i:s.", $row->date);*/ ?></td>
											<td>
												<button class="btn btn-danger"
													onclick="callDeleteRLogo(<?php echo "'{$srcThumbnail}','{$row->image_name}','{$row->_id}'"; ?>);">delete</button>
											</td>
											<td>
												<button class="btn btn-primary"
													onclick="callRestoreLogo(<?php echo "'{$srcThumbnail}','{$row->image_name}','{$row->_id}'"; ?>)">restore</button>
											</td>
										</tr>
										<?php
									}else{
										?>
										<tr>
											<td>&nbsp;</td>
											<td><?php echo $row->image_name; ?></td>
											<td>File not found</td>
											<td>&nbsp;</td>
											<td>
												<button class="btn btn-danger"
													onclick="callDeleteRLogo(<?php echo "'{$srcThumbnail}','{$row->image_name}','{$row->_id}'"; ?>);">delete</button>
											</td>
											<td>&nbsp;</td>
										</tr>
										<?php
									}
								}catch(Exception $e) {
									?>
									<tr>
										<td>&nbsp;</td>
										<td><?php echo $row->image_name; ?></td>
										<td><?php echo $e->getMessage(); ?></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<?php
								}
							}
						?>
						</tbody>
						</table>



					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!--recycling Bin Modal child-->
<div class="modal fade" id="recycleBinChildModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header"></div>
			<div class="modal-body" style="overflow:auto;max-width:600px;max-height:600px;">
				<?php  // <img src="" id="recycleBinChildLogo"/>  ?>
				Warning
				<input type="hidden" id="id" />
			</div>
			<div class="modal-footer">
				<div id="showHideRecycleBinChildDIV1">
					Are you sure ( <i><b style="font-size:12px">Warning: files will be deleted permanently</b></i> ) ?&nbsp;
					<button type="button" class="btn btn-danger" onclick="doRecycleBinActionLogo('deleteARlogo')">Yes</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
				</div>
				<div style="display:none"  id="showHideRecycleBinChildDIV2">
					Are you sure ( <i><b style="font-size:12px">Warning: files will be deleted permanently</b></i> ) ?&nbsp;
					<button type="button" class="btn btn-danger" onclick="doRecycleBinActionLogo('deleteRlogo')">Yes</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
				</div>
				<div style="display:none"  id="showHideRecycleBinChildDIV3">
					Are you sure?
					<button type="button" class="btn btn-danger" onclick="doRecycleBinActionLogo('restoreLogo')">Yes</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){

	$('.renameLogo').each(function(){
		$(this).hide();
	});
	$('.showLogo').each(function(){
		$(this).hide();
	});
	$('.deleteLogo').each(function(){
		$(this).hide();
	});

	$('.imgPanelInner').hover(function(){
		$(this).addClass('grayscale');
		$(this).children('button').fadeIn();
	},function(){
		$(this).removeClass('grayscale');
		$(this).children('button').fadeOut();
	});
	

	var $recycleBinArea=$('#recycleBinArea').DataTable({
		//"jQueryUI": true
//		"scrollY": "400px",
//		"scrollX": "800px",
//        "scrollCollapse": true,
//        "paging": false,
		"order": [ 2, 'desc' ],
//		"order": [ 2, 'asc' ],
		"lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
		"columnDefs": [
			{ "orderable": false, "searchable": false, "targets": 0 },
			{ "orderable": true , "searchable": true , "targets": 1 },
			{ "orderable": true , "searchable": true , "targets": 2 },
			{ "orderable": true , "searchable": true , "targets": 3 },
			{ "orderable": false, "searchable": false, "targets": 4 },
			{ "orderable": false, "searchable": false, "targets": 5 }
		]
	});

	$('#newLogoName').keypress(function(e){
		var keynum;
		if(window.event){ // IE					
			keynum = e.keyCode;
		}else{
			if(e.which){ // Netscape/Firefox/Opera					
				keynum = e.which;
			}
		}
		var txt = String.fromCharCode(keynum);
		if(!txt.match(/[A-Za-z0-9_]/)){ return false; }
    });
});
function callBackUploadComplete(files,company){
	for(var i=0 ; i<files.length ; i++ ){
		if( files[i].status==5){
			var last=(i==(files.length-1))?1:0;
			var posting = $.post( "Uploader", { name: files[i].name, realName: files[i].target_name , last:last} );
			posting.done(function( data ){
				if(data.last==1) window.location.reload();
				//data = JSON.parse(data)
			});
		}
	}
}
</script>


