<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="public/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" href="public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/assets/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="public/assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="public/assets/css/main.css">
	<script src="public/assets/js/vendor/jquery-2.1.4.min.js"></script>
	<script src="public/assets/js/myscript.js"></script>
<!--===============================================================================================-->
</head>
<body style="background-color: #666666;">

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url('public/images/logo.jpg')">
					<span class="login100-form-title-1">
						Log in to continue
					</span>
				</div>
				<div class="error_login"></div>
<?php include("include/report.php"); ?>
				<form class="login100-form validate-form" method="POST" action="">
					<?php include("include/report.php") ?>
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Email</span>
						<input class="input100" type="text" name="email" value="<?php echo $email?>" placeholder="Enter email">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="password" placeholder="Enter password">
						<span class="focus-input100"></span>
					</div>

					<div class="flex-sb-m w-full p-b-30">
						<!-- <div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

						<div>
							<a href="#" class="txt1">
								Forgot Password?
							</a>
						</div> -->
					</div>

					<div class="container-login100-form-btn">
						<button type="button" class="login100-form-btn" name="login">
							Login
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<script type="text/javascript">
		$('button[name=login]').on('click',function(){
			alert
			var html = '<ul class="alert alert-info">';
			flag = true;
			if($('input[name=email]').val() == '') {
				html += "<li>Email is required</li>";
				flag = false;
			}
			if($('input[name=password]').val() == '') {
				html += "<li>Password is required</li>";
				flag = false;
			}

			html += "</ul>";
			console.log(html);

			if(flag) {
				$('button[name="login"]').attr("type", "submit");
			} else {
				$('.error_login').html(html);
			}
		});
	</script>

	

	<script src="public/assets/js/main1.js"></script>
	<script src="public/assets/js/myscript.js"></script>

</body>
</html>