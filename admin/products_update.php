<?php 
ini_set('display_errors', 0);
include("controllers/c_products.php");
$c_pro = new C_products();
$c_pro->update();

?>