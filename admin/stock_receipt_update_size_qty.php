<?php
include("controllers/c_stock_receipt.php");
$c_stock = new C_stock_receipt();
$c_stock->edit_stock_size_qty();
?>