<?php
session_start();
include("../helper/help.php");
include("models/m_permission.php");
class C_suppliers
{

	function __construct() {
		if(!isset($_SESSION["user"])) {
            echo "<script>window.location='.'</script>";
        } 
	}

	public function get_all_suppliers() {
		//models
		$m_per = new M_permission;
        if($m_per->check_permission("list_supplier") == 0) {
            $_SESSION['alert-warning'] = "You don't have permission to do this action";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
		include("models/m_supplier.php");
		$m_sup = new M_suppliers();
		$list_suppliers = $m_sup->read_all_suppliers();

		
		


		//views
		$view = "views/suppliers/v_list.php";
		$title = "List Of Suppliers";
		include("include/layout.php");
		
	}

}