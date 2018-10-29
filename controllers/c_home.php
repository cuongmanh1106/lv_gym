<?php
session_start();
include("models/m_products.php");


class C_home {
	public function show_home() {

		//models
		$m_pro = new M_products();
		$products = $m_pro->read_top_product();






		//views
		$view = "views/home/v_home.php";
		$title = "Home";
		include("include/layout.php");
	}

	public function contact_us() {
		//models

		if(isset($_POST["send_contact"])) {
			$content = $_POST["content"];
			$m_m_pro = new M_products();
			$customer_id = 0;
			if(isset($_SESSION["customer"])) {
				$customer_id = $_SESSION["customer"]->id;
			}
			if($m_m_pro->insert_feedback($customer_id,$content)) {
				$_SESSION["alert-success"] = "Send feedback successfully";
			} else {
				$_SESSION["alert-danger"] = "Send feedback fail";
			}
		}


		//views
		$title = "Contact us";
		$view = "views/home/v_contact.php";
		include("include/layout.php");
	}

	


}
?>