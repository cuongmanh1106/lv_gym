<?php 
include("../controllers/c_categories.php");
$c_categories = new C_categories();
$c_categories->get_all_categories_ajax();

?>