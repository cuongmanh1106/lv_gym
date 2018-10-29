<?php 
include("controllers/c_orders.php");
$c_pro = new C_orders();
$c_pro->show_order_detail();

?>