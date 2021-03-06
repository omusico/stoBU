<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ApEngage Platform</title>
@include("header2")
@include("guestNav")
</head>
<style>
.row-register{
	width:50%;
	margin:auto;
}

.row-register button{
	
	border-radius:5px;
	width:100%;
	background:#172436;
	color:#fff;
	padding:10px;
}
.input-group {
  position: relative;
  display: table;
  border-collapse: separate;
}
.input-group span{

	border-top-left-radius:5px !important; 
	border-bottom-left-radius:5px !important; 
}
.icon{
	 width: 14px;
  height: 14px;
  margin-top: 3px;
  fill:#1188a3;
}
h4{
	margin-bottom:38px;
	color:#172436;
	font-size:28px;
	text-align:center;
}
label{
  margin-top: -16px;
  margin-left: 19px;
}
.navbar{
	max-height: 60px;
  height: 60px;
  min-height: 60px !important;
}
</style>
<body>
<?php if(isset($data)){
	print_r($data);
}
?>
<div class="row" id="loginHeader">
			
	<div class="col-md-12">
		<div class="row-register">
			<h4>Sign Up Today!</h4>
			{{Form::open(['route' => 'register form', 'action'=>  'UserController@registerForm', 'autocomplete' => 'off', "class" => "form-inline", 'id' => 'loginForm'])}}
			<div class="col-md-12">
				<div class="input-group">
  					<span class="input-group-addon" id="basic-addon1"><svg class="icon icon-envelope2-16"><use xlink:href="#icon-envelope2-16"></use></svg><span class="mls"></span></span>    
			    	{{Form::text('email', '', ["id"=>"placeLogin",'placeholder' => 'E-mail', 'class' => 'form-control', 'required'=>true])}}
			    </div>
			</div>
			<div class="col-md-12">	 
				<div class="input-group">
  					<span class="input-group-addon" id="basic-addon1"><svg class="icon icon-user-06"><use xlink:href="#icon-user-06"></use></svg><span class="mls"></span></span>    
			    	{{Form::text('fname', Input::get('fname'), ["id"=>"placeLogin",'placeholder' => 'First Name', 'class' => 'form-control', 'required' => true])}}
			    </div>
			</div>
			<div class="col-md-12">	 
				<div class="input-group">
  					<span class="input-group-addon" id="basic-addon1"><svg class="icon icon-user-06"><use xlink:href="#icon-user-06"></use></svg><span class="mls"></span></span>    
   
			    	{{Form::text('lname', Input::get('lname'), ["id"=>"placeLogin",'placeholder' => 'Last Name', 'class' => 'form-control', 'required' => true])}}
				</div>
			</div>
			<div class="col-md-12">	 
				<div class="input-group">
  					<span class="input-group-addon" id="basic-addon1"><svg class="icon icon-office"><use xlink:href="#icon-office"></use></svg><span class="mls"></span></span>    
   
			    	{{Form::text('company', Input::get('company'), ["id"=>"placeLogin",'placeholder' => 'Company Name', 'class' => 'form-control', 'required' => true])}}
				</div>
			</div>
			<div class="col-md-12">	 
				<div class="input-group">
  					<span class="input-group-addon" id="basic-addon1"><svg class="icon icon-mobile"><use xlink:href="#icon-mobile"></use></svg><span class="mls"></span></span>    
   
			    	{{Form::text('phone', Input::get('phone'), ["id"=>"placeLogin",'placeholder' => 'Phone No.', 'class' => 'form-control', 'required' => true])}}
				</div>
			</div>
			<div class="col-md-12">
			  <!--  {{Form::password('password', ["id"=>"placeLogin",'placeholder' => 'Password', 'class' => 'form-control', 'required'=>true])}}-->
			</div>
			<div class="col-md-12">
				{{Form::button('Sign Up', array('type' => 'submit', 'class' => 'btn btn-small', 'id' => 'signInBtn'))}}
				
			</div>
			{{Form::close()}}
		</div>
	</div>
	<!--Register Form-->

	
</div>
<!--------------------------------- Modals start here ---------------------------------------->
<!--------------------------------- forgotPassword    ---------------------------------------->
<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Forgotten Password</h4>
			</div>
			<div class="modal-body">
				{{Form::open(['route' => 'Forgot Password', 'action'=>  'UserController@forgotPassword', 'autocomplete' => 'off', "class" => "form-inline", 'id' => 'forgotPassword'])}}
				<div class="col-md-4">	    
					{{Form::text('email', '', ["id"=>"placeLogin",'placeholder' => 'E-mail', 'class' => 'form-control', 'required'=>true ])}}
				</div>
				<div class="col-md-4">
					{{Form::button('Submit', array('type' => 'submit', 'class' => 'btn btn-small', 'id' => 'signInBtn'))}}
				</div>
				{{Form::close()}}
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!--------------------------------- loginMesage       ---------------------------------------->
<?php if(isset($ttl)): ?>
<div class="modal fade" id="loginMesageModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myMsgLabel"><?php echo $ttl; ?></h4>
			</div>
			<div class="modal-body">
			<?php if( isset($msg) ): ?>
				<h3>email address: <?php echo $mail; ?></h3>
				<br/>
				<?php echo $msg; ?>.
			<?php else: ?>
				<h3>Thank you <?php echo $user['fname']; ?></h3>
				<br/>
				An email was sent to <?php echo $user['email']; ?>, please check your inbox to reset your password.
			<?php endif; ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	$("#loginMesageModal").modal({show:true});//show();
	$("#forgotPassword")[0].reset();

	$("#registerBtn").click(function(event){
		//event.preventDefault();
		alert('er');
	});
});
</script>
<?php endif; ?>
</body>
</html>
