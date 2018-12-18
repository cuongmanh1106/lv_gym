

<div class="container" style="margin-top: 100px">

	<div class="account">
		<h2>Reset Password</h2>
		<?php include("include/report.php"); ?>
		<div class="account-pass">
			<div class="col-md-7 account-top">
				<form method="POST">
					<div id="validation_reset">
						
					</div>
					<div> 	
						<span>Email</span>
						<input style="width: 100%; padding:14px" readonly="" name="email" value="<?php echo $email ?>" type="email" required=""> 
					</div>
					<div> 
						<span >Password</span>
						<input name="password" type="password" required="">
					</div>	
					<div> 
						<span >Confirm Password</span>
						<input name="confirm_password" type="password" required="">
					</div>				
					<input class="btn btn-success" type="button" value="Save" name="reset_password"> 
				</form>
			</div>
			
			<div class="clearfix"> </div>
		</div>
	</div>

</div>

<script>
$('input[name=reset_password').on('click',function(){
	html = "<ul class='alert alert-danger'>";
	password = $('input[name=password]').val();
	confirm_password = $('input[name=confirm_password]').val();
	flag = true;
	if(password.length < 6) {
		flag = false;
		html += "<li>Password have length at least 6 characters</li>";
	}
	if(password != confirm_password) {
		flag = false;
		html += "<li>Wrong confirm password</li>";
	}
	html += "</ul>";

	if(flag) {
		$('input[name=reset_password]').attr('type','submit');
	} else {
		$('#validation_reset').html(html);
	}
})
</script>