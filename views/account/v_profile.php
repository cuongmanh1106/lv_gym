<?php include("v_edit_profile.php"); ?>
<?php include("v_change_password.php"); ?>


<div class="panel panel-info" style="margin-top: 125px">
	<?php include('include/report.php') ?>
	<!-- Default panel contents -->
	<div class="panel-heading" style="text-align: center;"><h1>Profile</h1></div>
	<div class="panel-body">
		<div class="col-md-6" style="text-align: right;">
			<img src="admin/public/images/<?php echo ($_SESSION["customer"]!=null && $_SESSION["customer"]->image!='')?$_SESSION["customer"]->image:'us.png' ?>" width="250px">
		</div>
		<div class="col-md-6">
			<h4><b>Name</b>: <?php echo $_SESSION["customer"]->first_name ?> <?php echo $_SESSION["customer"]->last_name ?></h4><br>
			<h4><b>Email</b>: <?php echo $_SESSION["customer"]->email ?></p><br>
				<p><b>Password</b>:  <u><a data-toggle="modal" href="#change_password" style="color:blue">Change password</a></u></p><br>
				<p><b>Phone</b>: <?php echo $_SESSION["customer"]->phone_number ?></p><br>
				<p><b>Address</b>: <?php echo $_SESSION["customer"]->address ?></p><br>
			</div>
			<div class="clearfix"></div>
			<div class="form-group" style="text-align: center;">
				<a class="btn btn-danger"  href="javascript:void(0)" id="profile_logout" style="text-align: center;"><i class="fa fa-times-circle"></i> Logout</a> 
				<a class="btn btn-info" data-toggle="modal" href="#edit_profile" style="text-align: center;"><i class="fa fa-edit"></i> Edit</a>   
				<a class="btn btn-success"  href="." style="text-align: center;"><i class="fa fa-reply"></i> Back</a>  
				<a class="btn btn-warning" href="profile_order.php" style="text-align: center;"><i class="fa fa-eye"></i> See history order</a>  
			</div>
		</div>

		<!-- Table -->
		
	</div>
	<!-- <script type="text/javascript">
		$('#update_profile').on('click',function(){
		html = '<ul class="alert alert-danger>"';
		flag = true;
		if($('input[name=first_name]').val() == '') {
			html += '<li>First name is required</li>';
			flag = false;
		}
		if($('input[name=last_name]').val() == '') {
			html += '<li>Last name  is required</li>';
			flag = false;
		}
		if($('input[name=email]').val() == '') {
			html += '<li>Email is required</li>';
			flag = false;
		}
		if($('input[name=phone_number]').val() == '') {
			html += '<li>First name is required</li>';
			flag = false;
		}
		html += '</ul>';
		if(flag) {
			$('button[name="update_prof"]').attr("type", "submit");
		} else {
			$('.profile_validation').html(html);
		}

	})</script> -->

	<script>
		$('#profile_logout').on('click',function(){
			$.ajax({
				type:'POST',
				url:'ajax.php',
				data:{'profile_logout':'OK'},
				success:function(data) {
					 window.location = '.';
				}
			})
		})
	</script>
