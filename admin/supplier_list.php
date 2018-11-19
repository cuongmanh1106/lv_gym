<?php 
include("controllers/c_suppliers.php");
$c_sup = new C_suppliers();
$c_sup->get_all_suppliers();

?>