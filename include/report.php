<?php
foreach(['danger', 'warning', 'success', 'info'] as $msg):
	if(isset($_SESSION['alert-'.$msg])){
		
?>
<h4 class="alert alert-<?php echo $msg?>"><?php echo $_SESSION['alert-'.$msg]?><button class="close" data-dismiss="alert" aria-label="close">&times;</button></h4>
<?php unset($_SESSION['alert-'.$msg]); } endforeach ?>