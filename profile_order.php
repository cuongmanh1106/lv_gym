<?php
include("controllers/c_account.php");
if(!isset($_SESSION["customer"])) {
	$_SESSION["alert-warning"] = "Please Login First !!!";
	echo "<script>alert('Please Login First!!!'); window.location='.'</script>";
} 
$p = new C_account();
$p->order();
?>