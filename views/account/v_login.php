

<div class="container" style="margin-top: 100px">

	<div class="account">
		<h2>Account</h2>
		<?php include("include/report.php"); ?>
		<div class="account-pass">
			<div class="col-md-7 account-top">
				<form method="POST" action="">

					<div> 	
						<span>Email</span>
						<input style="width: 100%; padding:14px" name="email" value="<?php echo $email ?>" type="email" required=""> 
					</div>
					<div> 
						<span >Password</span>
						<input name="password" type="password" required="">
					</div>				
					<input type="submit" value="Login" name="login"> 
					<a class="btn btn-default" href="#reset_password" data-toggle="modal"  style="text-align: center;"><i class="fa fa-edit"></i> Reset Password</a> 
				</form>
			</div>
			<div class="col-md-5 left-account ">
				<a href="."><img class="img-responsive " src="images/ac.png" alt=""></a>
				<div class="five">
					<h1>25% </h1><span>discount</span>
				</div>
				<a href="register.php" class="create">Create an account</a>
				
				<div class="clearfix"> </div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>

</div>

<div id="reset_password" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header " style="background-color: #17a2b8">
				<h4 class="modal-title custom_align" id="Heading" style="text-align: left; color:#fff; font-weight: bold">
					<i class="fa fa-edit MarginRight-10"></i>
				Reset password</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="profile_validation"></div>
				<form method="POST" enctype="multipart/form-data" action="">
					<div id="email_validation">

					</div>
					<div class="row form-group">
						<div class="col-md-2"><label for="text-input" class=" form-control-label">Email:</label></div>
						<input type="email" class="form-control" value="" required name="email_reset" /> <span style="display: inline;" id="check_email"></span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-reply"></i> Close</button>
					<button type="button" data-dismiss="modal" disabled name="reset_password" style="text-align: center;" class="btn btn-info"><i class="fa fa-thumbs-up"></i> Submit</button>
				</div>
			</form>
		</div>

	</div>

</div>
<script type="text/javascript">
	$('button[name=reset_password]').on('click',function(){
		html = '<ul class="alert alert-danger">';
		flag = true;
		if($('input[name=email_reset]').val() == '') {
			html += '<li>Email is required</li>';
			flag = false;
		}
		var email = $('input[name=email_reset]').val();
		$.ajax({
			type:"POST",
			url:"ajax.php",
			data:{'email':email,'check_email_reset':'OK'},
			success:function(data) {
				if(data.trim() == "ok"){
					html_email = '<img src="admin/public/images/icons/cross_circle.png">';
					$('input[name=email_reset]').css('border',"1px solid red");

				} else if(data.trim() == "exist") {
					html_email = '<img src="admin/public/images/icons/tick_circle.png">';
					$('input[name=email_reset]').css('border',"1px solid #ced4da");
				}
				$('#check_email').html(html_email);
			}
		})
		html += '</ul>';
		if(flag) {
			$.ajax({
				type:'POST',
				url:'ajax.php',
				data:{'email':email,'reset_password':'OK'},
				success:function(data,status) {
					alert("Please !!! Check your email to get link");
				}
			})
		} else {
			$('.email_validation').html(html);
		}
	})

	$('input[name=email_reset]').on('change',function(){
		if($('input[name=email_reset]').val() == "" ) {
			$('input[name=email_reset]').css('border','1px solid red');
		}  else {
			$('input[name=email_reset]').css('border','none');
		}
		var email = $('input[name=email_reset]').val();
		$.ajax({
			type:"POST",
			url:"ajax.php",
			data:{'email':email,'check_email_reset':'OK'},
			success:function(data) {
				if(data.trim() == "ok"){
					html = '<img src="admin/public/images/icons/cross_circle.png">';
					$('input[name=email_reset]').css('border',"1px solid red");
					$('button[name=reset_password]').prop('disabled',true);

				} else if(data.trim() == "exist") {
					html = '<img src="admin/public/images/icons/tick_circle.png">';
					$('input[name=email_reset]').css('border',"1px solid #ced4da");
					$('button[name=reset_password]').prop('disabled',false);
				}
				$('#check_email').html(html);
			}
		})
	}) 
</script>
