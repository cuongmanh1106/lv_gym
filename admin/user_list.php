<?php 
include("controllers/c_users.php");
$c_user = new C_users();
$c_user->show_all_users();

?>