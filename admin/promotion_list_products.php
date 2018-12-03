<?php
require("controllers/c_promotion.php");
$c_promotion = new C_promotion();
$c_promotion->get_list_products_promotion();
?>