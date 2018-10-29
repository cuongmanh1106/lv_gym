
<?php
ini_set('display_errors', 0);
include("controllers/c_permission.php");
$c_per = new C_permission();
$c_per->show_all_permission_group();
?>