

<div class="container" style="margin-top:120px ">	
<?php include('include/report.php'); ?>		
	<div class="contact">
		<h2>Contact</h2>
		<div class="col-md-6 map">
			<h3>Our Location</h3>
			<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3918.518773724518!2d106.78575561463741!3d10.848091360833546!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1532693395712" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
			<div class="address">
				<h4>Address</h4>
				<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas </p>
				<ul class="social ">
					<li><span>42 Đường, 102 Man thiện, Q9, TPHCM </span></li>
					<li><span>+ 1688868553</span></li>
					<li><a href="mailto:info@example.com">cuongmanh1106@gmail.com</a></li>
				</ul>

			</div>
		</div>
		<div class="col-md-6 contact-grid">
			<form method="post" action="">
				
				<div> 
					<span >Message</span>
					<textarea  name="content" class="editor"  required="required" rows="9" placeholder="Content..." class="form-control"></textarea>			
				</div>				
				
				<div class="send-in">
					<?php if(isset($_SESSION["customer"])) { ?>
					<input type="submit" name="send_contact" value="Send" >
					<?php } else {?> 
					<input disabled="" type="submit" value="Send" title="You must login to send message" >
					<?php } ?>
					
				</div>
			</form>

		</div>
		<div class="clearfix"> </div>
	</div>
</div>
