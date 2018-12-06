<?php
session_start();
include("../helper/help.php");
include("models/m_permission.php");
class C_promotion
{

	function __construct() {

        if(!isset($_SESSION["user"])) {
            echo "<script>window.location='.'</script>";
        } 
    }

	public function get_all_promotion() {

		$m_per = new M_permission;
        if($m_per->check_permission("list_promotion") == 0) {
            $_SESSION['alert-warning'] = "You don't have permission to do this action";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

		//models
		include("models/m_promotion.php");
		$m_promotion = new M_promotion();
		$promotions = $m_promotion->read_all_promotion();

		//views
		$view = "views/promotion/v_list.php";
		$title = "List Of Promotions";
		include("include/layout.php");
	}

	public function add_promotion(){

		$m_per = new M_permission;
        if($m_per->check_permission("insert_promotion") == 0) {
            $_SESSION['alert-warning'] = "You don't have permission to do this action";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

		//models
		$name = $date_from = $date_to = $description = '';
		if(isset($_POST["insert_promotion"])) {
			include("models/m_promotion.php");
			$m_promotion = new M_promotion();
			$name = $_POST["name"];
			$date_from = date("Y-m-d",strtotime($_POST["date_from"]));
			$date_to = date("Y-m-d",strtotime($_POST["date_to"]));
			$description = $_POST["description"];
			$file = $_FILES["image"];
			$image = '';
			if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0){
				$image = newImage($_FILES["image"]["name"]);
				
			}
			if($m_promotion->check_date($date_from,$date_to) && $m_promotion->insert_promotion($name,$description,$image,$date_from,$date_to,0)) {
				if($image != '') {
					move_uploaded_file($_FILES["image"]["tmp_name"],"public/images/".$image);
				}
				$_SESSION["alert-success"] = "Add Successfully";
				echo "<script> window.location = 'promotion_list.php' </script>";
			} else {
				$_SESSION["alert-warning"] = "The time have duplicated with other promotion time";
			}
			
		}

		//views
		$view = "views/promotion/v_add.php";
		$title = "Add a promotion";
		include("include/layout.php");
	}

	public function edit_promotion() {

		$m_per = new M_permission;
        if($m_per->check_permission("edit_promotion") == 0) {
            $_SESSION['alert-warning'] = "You don't have permission to do this action";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
		//models
		$id = $_GET["id"];
		include("models/m_promotion.php");
		$m_promotion = new M_promotion();
		$promotion = $m_promotion->read_promotion_by_id($id);
		if(isset($_POST["edit_promotion"])) {
			$name = $_POST["name"];
			$date_from = date("Y-m-d",strtotime($_POST["date_from"]));
			$date_to = date("Y-m-d",strtotime($_POST["date_to"]));
			$description = $_POST["description"];
			$file = $_FILES["image"];
			$image = $promotion->image;
			$msg = '';
			if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0){
				$image = newImage($_FILES["image"]["name"]);
			}
			if($m_promotion->check_date($date_from,$date_to,$id) && $m_promotion->update_promotion($name,$description,$image,$date_from,$date_to,0,$id)) {
				if($image != $promotion->image ) {
					move_uploaded_file($_FILES["image"]["tmp_name"],"public/images/".$image);
					if($promotion->image != '' && file_exists("public/images/".$promotion->image) ) {
						unlink("public/images/".$promotion->image);
					}
				}
				$_SESSION["alert-success"] = "Edit Promotion Successfully";
			} else {
				$_SESSION["alert-warning"] = "The time have duplicated with other promotion time";
			}
			// echo "<script>window.location = 'promotion_edit.php?id=$id'</script>";
			

		}

		//views
		$view = "views/promotion/v_edit.php";
		$title = "Edit a promotion";
		include("include/layout.php");
	}

	public function get_list_products_promotion() {

		$m_per = new M_permission;
        if($m_per->check_permission("list_promotion_detail") == 0) {
            $_SESSION['alert-warning'] = "You don't have permission to do this action";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }


		$id = $_GET["id"];
		//models
		include("models/m_promotion.php");
		$m_promotion = new M_promotion();
		$detail_promotions = $m_promotion->get_detail_promotion($id);


		//views
		$view = "views/promotion/v_list_products.php";
		$title = "List Products Promotion";
		include("include/layout.php");
	}

	public function choose_products_promotion() {

		$m_per = new M_permission;
        if($m_per->check_permission("insert_promotion_detail") == 0) {
            $_SESSION['alert-warning'] = "You don't have permission to do this action";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }


		$id = $_GET["id"];
		//models
		require("models/m_categories.php");
        require("models/m_products.php");
        require("models/m_supplier.php");
        require("models/m_promotion.php");
        
        $m_promotion = new M_promotion();
        $m_sup = new M_suppliers();
        $m_cate = new M_Categories();
        $m_pro = new M_products();

        $cates = $m_cate->read_all_categories();
        $products = $m_promotion->get_choose_product($id);




		//views
		$view = "views/promotion/v_choose_products.php";
		$title = "List Choose Products Promotion";
		include("include/layout.php");
	}


	public function chose_products_promotion() {

		$m_per = new M_permission;
        if($m_per->check_permission("insert_promotion_detail") == 0) {
            $_SESSION['alert-warning'] = "You don't have permission to do this action";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

		//models
		$id = $_GET["id"];
		$list_id = $_POST["list_id"];
		$str = str_replace('[','',$list_id);
	    $str = str_replace(']', '', $str);
	    $str = explode(',',$str);//chuyển thành mảng
	    include("models/m_promotion.php");
	    include("models/m_categories.php");
	    $m_cate = new M_Categories();
	    $m_promostion = new M_Promotion();
	    $products = $m_promostion->get_chose_products($str);
	    $cates = $m_cate->read_all_categories();



		//views
		$view = "views/promotion/v_chose_products.php";
		$title = "List Products are choosen";
		include("include/layout.php");
	}


	public function save_chose_products() {

		$m_per = new M_permission;
        if($m_per->check_permission("insert_promotion_detail") == 0) {
            $_SESSION['alert-warning'] = "You don't have permission to do this action";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }


		$id = $_GET["id"];
		$pro_id = $_POST["pro_id"];
		$price_promotion = $_POST["promotion_price"];
		$merge=array_combine($pro_id,$price_promotion);
		include("models/m_promotion.php");
		$m_promotion = new M_promotion();

		$m_promotion->insert_promotion_detail($id,$merge);
		$_SESSION["alert-success"] = "Insert Products Promotion Successfully";
		echo "<script>window.location='promotion_list_products.php?id=".$id."'</script>";



	}
}