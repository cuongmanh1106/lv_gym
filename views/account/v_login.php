

<div class="container" style="margin-top: 100px">

		<div class="account">
		<h2>Account</h2>
		<?php include("include/report.php"); ?>
		<div class="account-pass">
		<div class="col-md-7 account-top">
			<form method="POST">
				
			<div> 	
				<span>Email</span>
				<input style="width: 100%; padding:14px" name="email" value="<?php echo $email ?>" type="email" required=""> 
			</div>
			<div> 
				<span >Password</span>
				<input name="password" type="password" required="">
			</div>				
				<input type="submit" value="Login" name="login"> 
			</form>
		</div>
		<div class="col-md-5 left-account ">
			<a href="single.html"><img class="img-responsive " src="images/ac.png" alt=""></a>
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