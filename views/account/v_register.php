<div class="container" style="margin-top: 125px">
	<!-- @include('admin.include.report'); -->
	<div class="register">
		<h2>REGISTER</h2>		
		<div class="error_register_customer">
			
		</div>
		
		<div class=" register-top">
			<form method="POST" enctype="multipart/form-data" action="">
				<div> 	
					<span>First Name (<b style="color: red">*</b>)</span>
					<input type="text" value="<?php echo $first_name?>" required name="first_name"> 
				</div>
				<div> 	
					<span>Last Name (<b style="color: red">*</b>)</span>
					<input type="text" value="<?php echo $last_name?>" required name="last_name">
				</div>
				<div> 	
					<span>Email (<b style="color: red">*</b>)  </span> 
					<input style="width: 60%; padding:14px" type="email" value="<?php echo $email?>" required name="email"> <span style="display: inline;" id="check_email"></span>
				</div>
				<div> 
					<span >Password (<b style="color: red">*</b>)</span>
					<input type="password" required name="password">
				</div>	
				<div> 
					<span >Confirm Password (<b style="color: red">*</b>)</span>
					<input type="password" required name="confirm_password">
				</div>	
				<div> 	
					<span>Phone number (<b style="color: red">*</b>)</span>
					<input type="text" value="<?php echo $phone_number?>" required name="phone_number"> 
				</div>
				<div> 	
					<span>Address</span>
					<input type="text" value="<?php echo $address ?>" name="address"> 
				</div>
				<div> 	
					<span>Avatar</span>
					<input type="file" name="image"> 
				</div>

				<input class="btn btn-success" name="register_customer" type="button" value="Register"> 
			</form>
		</div>		
	</div>
</div>

<script type="text/javascript">
	$('input[name=register_customer]').on('click',function(){
		var html = '';
		var flag = true;
		html += ' <ul  class="alert alert-danger">';
		if($('input[name=first_name]').val() == ''){
			flag = false;
			html += '<li>First name is required</li>';
			$('input[name=first_name]').css('border','1px solid red');
		}  else {
			$('input[name=first_name]').css('border','none');
		}
		if($('input[name=last_name]').val() == ''){
			flag = false;
			html += '<li>Last name is required</li>';
			$('input[name=last_name]').css('border','1px solid red');
		}  else {
			$('input[name=last_name]').css('border','none');
		}  
		if($('input[name=email]').val() == ''){
			flag = false;
			html += '<li>Email name is required</li>';
			$('input[name=email]').css('border','1px solid red');
		}  else {
			$('input[name=email]').css('border','none');
		}  
		if($('input[name=password]').val().length < 6){
			flag = false;
			html += '<li>Password have length at least 6 character</li>';
			$('input[name=password]').css('border','1px solid red');
		}  else {
			$('input[name=password]').css('border','none');
		}  
		if($('input[name=confirm_password]').val() == ''){
			flag = false;
			html += '<li>Confirm password is required</li>';
		}  
		if($('input[name=phone_number]').val().length > 11 ||  $('input[name=phone_number]').val().length < 10 ){
			flag = false;
			html += '<li>Phone have length between 10 and 11</li>';
			$('input[name=phone_number]').css('border','1px solid red');
		}  else {
			$('input[name=phone_number]').css('border','none');
		}  
		if($('input[name=confirm_password]').val() != $('input[name=password]').val()){
			flag = false;
			html += '<li>Wrong confirm password</li>';
		}  
		html += "</ul>";

		if(flag) {
			$('input[name="register_customer"]').attr("type", "submit");
		} else {
			$('.error_register_customer').html(html);
		}
	})

	$('input[name=first_name]').on('keyup',function(){
		if($('input[name=first_name]').val() == "") {
			$('input[name=first_name]').css('border','1px solid red');
		}  else {
			$('input[name=first_name]').css('border','none');
		}
	}) 

	$('input[name=last_name]').on('keyup',function(){
		if($('input[name=last_name]').val() == "") {
			$('input[name=last_name]').css('border','1px solid red');
		}  else {
			$('input[name=last_name]').css('border','none');
		}
	}) 

	$('input[name=email]').on('change',function(){
		if($('input[name=email]').val() == "") {
			$('input[name=email]').css('border','1px solid red');

		}  else {
			$('input[name=email]').css('border','none');
		}
		var email = $('input[name=email]').val();
		$.ajax({
        type:"POST",
        url:"ajax.php",
        data:{'email':email,'check_email':'OK'},
        success:function(data) {
          console.log(data);
          if(data.trim() == "ok"){
            html = '<img src="admin/public/images/icons/tick_circle.png">';
            $('input[name=email]').css('border',"1px solid #ced4da");
            $('input[name=register_customer]').prop("disabled",false);
            
          } else if(data.trim() == "exist") {
            html = '<img src="admin/public/images/icons/cross_circle.png">';
            $('input[name=email]').css('border',"1px solid red");
            $('input[name=register_customer]').prop("disabled",true);
          }
          $('#check_email').html(html);
        }
      })
	}) 

	$('input[name=password]').on('keyup',function(){
		if($('input[name=password]').val() == "") {
			$('input[name=password]').css('border','1px solid red');
		}  else {
			$('input[name=password]').css('border','none');
		}
	}) 

	$('input[name=phone_number]').on('keyup',function(){
		if($('input[name=phone_number]').val() == "") {
			$('input[name=phone_number]').css('border','1px solid red');
		}  else {
			$('input[name=phone_number]').css('border','none');
		}
	}) 
</script>
