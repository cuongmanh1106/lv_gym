<?php 
include("controllers/c_stock_receipt.php");
$c_stock = new C_stock_receipt();
$c_stock->insert_stock();

?>