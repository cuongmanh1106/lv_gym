<?php
require("controllers/c_promotion.php");
$c_promotion = new C_promotion();
$c_promotion->get_all_promotion();
?>