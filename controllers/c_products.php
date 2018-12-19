<?php
session_start();
require 'vendor/autoload.php';
// require 'Carbon/Carbon.php';
use Carbon\Carbon;
include("models/m_products.php");

class C_products {
	public function show_product() {

		//models
		include("models/m_categories.php");
		include("admin/models/m_promotion.php");
		$m_promotion = new M_promotion();
		$m_cate = new M_Category();
		$m_pro = new M_products();
		$products = '';
		$current_page = 1;
		if(isset($_GET['pages'])) {
			$current_page = $_GET['pages'];
		}
		if(isset($_GET['cate_id']) && $_GET['cate_id'] != '') {
			$cate_id = $_GET['cate_id'];
			$cate = $m_cate->read_cate_by_id($cate_id);
			$child = $m_cate->read_cate_by_parent($cate->id);
			if($cate->parent_id == 0 && count($child) > 0) {
				$arrCate = array();
				$arrCate[] = $cate_id;
				$children_cate = $m_cate->read_cate_by_parent($cate->id);
				foreach($children_cate as $c) {
					$arrCate[] = $c->id;
				}
				$products = $m_pro->read_product_by_arrcate($arrCate);
			} else {
				$products = $m_pro->read_product_by_cate_id($cate_id);
			}
		} else {
			$products = $m_pro->read_all_product();
		}
		$count = count($products);
		$limit = 15;
		$total_page = ceil($count/$limit);

		if($current_page > $total_page) {
			$current_page = $total_page; //nếu người dùng chọn số lớn hơn total thì mặc định là total
		} else if($current_page < 1 ) {
			$current_page = 1;
		}

		$vt = ($current_page - 1) * $limit;


		if(isset($_GET['cate_id']) && $_GET['cate_id'] != '') {
			$cate_id = $_GET['cate_id'];
			$cate = $m_cate->read_cate_by_id($cate_id);
			$child = $m_cate->read_cate_by_parent($cate->id);
			if($cate->parent_id == 0 && count($child) > 0) { //có con 
				$arrCate = array();
				$arrCate[] = $cate_id;
				$children_cate = $m_cate->read_cate_by_parent($cate->id);
				foreach($children_cate as $c) {
					$arrCate[] = $c->id;
				}
				$products = $m_pro->read_product_by_arrcate($arrCate,$vt,$limit);
			} else  {

				$products = $m_pro->read_product_by_cate_id($cate_id,$vt,$limit);
			}
		} else {
			$products = $m_pro->read_all_product($vt,$limit);
		}




		//views
		$view = "views/products/v_show.php";
		$title = "List of products";
		include("include/layout.php");
	}

	public function show_single() {

		//models
		$id = $_GET["id"];
		include("models/m_comment.php");
		include("models/m_account.php");
		include("helper/carbon.php");
		include("admin/models/m_promotion.php");
		
		$m_promotion = new M_promotion();
		$m_account = new M_account();
		$m_comment = new M_comment(); 
		$m_pro = new M_products();
		$product = $m_pro->read_product_by_id($id);
		$relative_product = $m_pro->read_relative_product($product->cate_id);
		$comments = $m_comment->read_comment($id,0,10);
		$all_comment = $m_comment->read_all_comment($id);

		//views
		$view = "views/products/v_single.php";
		$title = "Single";
		include("include/layout.php");
	}

	public function search_product() {
		$name = $_POST["search"];
		$m_pro = new M_products();
		require("admin/models/m_promotion.php");
		$m_promotion = new M_promotion();

		$products = $m_pro->search_product('all',$name,'all','');
		$view = "views/products/v_show.php";
		$title = "List of products";
		include("include/layout.php");
	}

	public function promotion() {
		//models
		
		require("admin/models/m_promotion.php");
		$m_promotion = new M_promotion();
		$products = $m_promotion->get_promotion_detail_product();


		//views 
		$view = "views/products/v_promotion.php";
		$title = "Promotion Program";
		require("include/layout.php");
	}

}
?>