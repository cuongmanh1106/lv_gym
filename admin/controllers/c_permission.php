<?php
session_start();
include("../helper/help.php");
class C_permission
{ 

	function __construct() {
		
		if(!isset($_SESSION["user"])) {
			echo "<script>window.location='.'</script>";
		} 
	}

	function show_all_permission() {
    	//models
		include("models/m_permission.php");
		$m_per = new M_permission();

		if($m_per->check_permission('list_permission') == 0) {
			$_SESSION['alert-warning'] = "You don't have permission to do this action";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
		}

		$per = $m_per->read_all_permission();


		

    	//views
		$view = "views/permission/v_list.php";
		$title = "List of permission";
		include("include/layout.php");

	}

	function show_all_permission_group(){
		$id = $_GET["id"];

		//models
		include("models/m_permission.php");
		$m_per = new M_permission();

		if($m_per->check_permission('edit_permission') == 0 || $id == 1) {
			$_SESSION['alert-warning'] = "You don't have permission to do this action";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
		}

		$list_permission = $m_per->read_group_permission_by_id($id);
		$permission = $m_per->read_permission_by_id($id);

		if(isset($_POST["edit_group"])) {
			$per_id = $_POST['per_id'];
			$id_permission = $_POST['id'];
			$id_group = $_POST['id_group'];

			$per_id = $id_permission;
			$list_product = ($_POST['list_product'] == 'on')?1:0;
			$insert_product = ($_POST['insert_product'] == 'on')?1:0;
			$edit_product = ($_POST['edit_product'] == 'on')?1:0;
			$delete_product = ($_POST['delete_product'] == 'on')?1:0;

			$list_category = ($_POST['list_category']== 'on')?1:0;
			$insert_category = ($_POST['insert_category'] == 'on')?1:0;
			$edit_category = ($_POST['edit_category'] == 'on')?1:0;
			$delete_category = ($_POST['delete_category'] == 'on')?1:0;

			$list_user = ($_POST['list_user'] == 'on')?1:0;
			$insert_user = ($_POST['insert_user'] == 'on')?1:0;
			$edit_user = ($_POST['edit_user'] == 'on')?1:0;
			$delete_user =  ($_POST['delete_user'] == 'on')?1:0;

			$list_permission = ($_POST['list_permission'] == 'on')?1:0;
			$insert_permission = ($_POST['insert_permission'] == 'on')?1:0;
			$edit_permission = ($_POST['edit_permission'] == 'on')?1:0;
			$delete_permission = ($_POST['delete_permission'] == 'on')?1:0;

			$list_stock = ($_POST['list_stock'] == 'on')?1:0;
			$insert_stock = ($_POST['insert_stock'] == 'on')?1:0;
			$edit_stock = ($_POST['edit_stock'] == 'on')?1:0;
			$delete_stock = ($_POST['delete_stock'] == 'on')?1:0;

			$list_detail_stock = ($_POST['list_detail_stock'] == 'on')?1:0;
			$insert_detail_stock = ($_POST['insert_detail_stock'] == 'on')?1:0;
			$edit_detail_stock = ($_POST['edit_detail_stock'] == 'on')?1:0;
			$delete_detail_stock = ($_POST['delete_detail_stock'] == 'on')?1:0;

			$list_promotion = ($_POST['list_promotion'] == 'on')?1:0;
			$insert_promotion = ($_POST['insert_promotion'] == 'on')?1:0;
			$edit_promotion = ($_POST['edit_promotion'] == 'on')?1:0;
			$delete_promotion = ($_POST['delete_promotion'] == 'on')?1:0;

			$list_promotion_detail = ($_POST['list_promotion_detail'] == 'on')?1:0;
			$insert_promotion_detail = ($_POST['insert_promotion_detail'] == 'on')?1:0;
			$edit_promotion_detail = ($_POST['edit_promotion_detail'] == 'on')?1:0;
			$delete_promotion_detail = ($_POST['delete_promotion_detail'] == 'on')?1:0;

			$list_supplier = ($_POST['list_supplier'] == 'on')?1:0;
			$insert_supplier = ($_POST['insert_supplier'] == 'on')?1:0;
			$edit_supplier = ($_POST['edit_supplier'] == 'on')?1:0;
			$delete_supplier = ($_POST['delete_supplier'] == 'on')?1:0;

			$list_order = ($_POST['list_order']=='on')?1:0;
			$edit_order = ($_POST['edit_order'] == 'on')?1:0;

			$list_ship = ($_POST['list_ship'] == 'on')?1:0;
			$edit_ship = ($_POST['edit_ship'] == 'on')?1:0;
			// var_dump($list_category); die();


			if($per_id == '' || $id_group == '') {
				if($m_per->insert_group_permission($per_id,$list_product,$insert_product,$edit_product,$delete_product,$list_category,$insert_category,$edit_category,$delete_category,$list_user,$insert_user,$edit_user,$delete_user,$list_permission,$insert_permission,$edit_permission,$delete_permission,$list_order,$edit_order,$list_ship,$edit_ship,$list_stock,$insert_stock,$edit_stock,$delete_stock,$list_detail_stock,$insert_detail_stock,$edit_detail_stock,$delete_detail_stock,$list_promotion,$insert_promotion,$edit_promotion,$delete_promotion,$list_promotion_detail,$insert_promotion_detail,$edit_promotion_detail,$delete_promotion_detail,$list_supplier,$insert_supplier,$edit_supplier,$delete_supplier)) {
					$_SESSION["alert-success"] = "Succesfully";
				} else {
					$_SESSION["alert-danger"] = "Fail";
				}
			} else {
				if($m_per->update_group_permission($list_product,$insert_product,$edit_product,$delete_product,$list_category,$insert_category,$edit_category,$delete_category,$list_user,$insert_user,$edit_user,$delete_user,$list_permission,$insert_permission,$edit_permission,$delete_permission,$list_order,$edit_order,$list_ship,$edit_ship,$list_stock,$insert_stock,$edit_stock,$delete_stock,$list_detail_stock,$insert_detail_stock,$edit_detail_stock,$delete_detail_stock,$list_promotion,$insert_promotion,$edit_promotion,$delete_promotion,$list_promotion_detail,$insert_promotion_detail,$edit_promotion_detail,$delete_promotion_detail,$list_supplier,$insert_supplier,$edit_supplier,$delete_supplier,$per_id)) {
					$_SESSION["alert-success"] = "Succesfully";
				} else {
					$_SESSION["alert-danger"] = "Fail";
				}
			}
			$list_permission = $m_per->read_group_permission_by_id($id);
			$permission = $m_per->read_permission_by_id($id);

		}
		//views
		$view = "views/permission/v_group.php";
		$title = "Group of permission";
		include("include/layout.php");
	}

	function add() {
		include("models/m_permission.php");
		$name = $_POST["name"];
		$m_per = new M_permission();
		if($m_per->check_permission('insert_permission') == 0) {
			$_SESSION['alert-warning'] = "You don't have permission to do this action";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
		}
		if($m_per->insert_permission($name)) {
			$_SESSION['alert-success'] = "Succesfully";
			echo "<script>window.location='permission_list.php'</script>";
		} else {
			$_SESSION['alert-danger'] = "Fail";
			echo "<script>window.location='permission_list.php'</script>";
		}
	}
}