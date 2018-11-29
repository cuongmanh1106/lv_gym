<?php
ini_set('display_errors', 0);
include("controllers/c_stock_receipt.php");
$c_stock = new C_stock_receipt();
$c_stock->list_stock_product();
?>