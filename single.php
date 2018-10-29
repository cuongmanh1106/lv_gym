<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');

include("controllers/c_products.php");
$p = new C_products();
$p->show_single();

?>