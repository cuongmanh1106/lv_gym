<?php
session_start();
include("models/m_products.php");


class C_cart{

	function __construct() {
		if(!isset($_SESSION["customer"])) {
			echo "<script>window.location='.'</script>";
		} 
	}

	public function checkout(){

		$m_pro = new M_products();
		$carts = $_SESSION["cart"];
		$total = 0;
		foreach($carts as $c) {
			$total = $c["qty"]*$c["price"];
		}



		//views
		$view = "views/cart/v_checkout.php";
		$title = "Checkout";
		include("include/layout.php");
	}

	public function success() {


		ini_set("display_errors",0);

		include("models/m_order.php");
		

		$m_order = new M_order();
		$m_pro = new M_products();
		$area = $_POST["destination"];

		$delivery_cost = 0;
		if($area == "hcm") {
			$delivery_cost = 2;
		} else {
			$delivery_cost = 4;
		}

		$customer_id = $_SESSION["customer"]->id;
		$total_order = 0;
		$order_id = $m_order->insert_order($customer_id,$_POST["specific"],$area,$delivery_cost);
		if($order_id != null) {
			foreach($_SESSION["cart"] as $key=>$cart) {
				$total_order += $cart["price"]*$cart["qty"];
				$product = $m_pro->read_product_by_id($cart["id"]);
				$sizes = json_decode($product->size);
				$total_quantity = $product->quantity;
				if(count($sizes) > 0) {
					if($sizes->$cart["size"] >= $cart["qty"]) { //trừ sản phẩm mà khách hàng đã đặt
						$sizes->$cart["size"] = $sizes->$cart["size"] - $cart["qty"]; 
						$total_quantity -= $cart["qty"];
					} else {
						$_SESSION["alert-danger"] = "Not enough to supply";
						break;
					}
				} else {
					$total_quantity -= $cart["qty"];
				}

				$m_order->insert_order_detail($order_id,$cart["id"],$cart["price"],$cart["size"],$cart["qty"]);

				$m_pro->update_product($cart["id"],$total_quantity,json_encode($sizes));

				$m_pro->update_view($product->id,$product->view + 1);
			}
		}


		$order = $m_order->read_order_by_id($order_id);
		$carts = $m_order->read_detail_by_order($order_id);

		require_once("smtpgmail/class.phpmailer.php");
		$mail=new PHPMailer();
		$mail->IsSMTP(); // Chứng thực SMTP
		$mail->SMTPAuth=TRUE;
		$mail->Host="smtp.gmail.com";
		$mail->Port=465;
		$mail->SMTPSecure="ssl";
		/* Server google*/
		$mail->Username="cuongmanh1106@gmail.com"; // Nhập mail 
		$mail->Password="nguyenmanhcuong"; // Mật khẩu
		/* Server google*/
		$mail->CharSet="utf-8";
		ob_start();
		require_once 'mail.php';
		$html = ob_get_clean();
		$mail->SetFrom("cuongmanh1106@gmail.com","Harrik");
		$mail->Subject="[Confirm your order]";
		$mail->MsgHTML($html);
		$mail->AddAddress("cuongmanh2311@gmail.com",$_SESSION["customer"]->first_name ." ".$_SESSION["customer"]->last_name); // Mail người nhận
		$mail->Send();

		if($_POST["payment"] == "paypal") {
			require('controllers/test_paypal.php');

		} else {
			$view = "views/cart/v_success.php";
			$title = "Order Successfully";
			include("include/layout.php");
		}

		//view
		
		


	}

	public function export_pdf() {

		//model
		include("models/m_order.php");
		$m_order = new M_order();
		$m_pro = new M_products();

		$order = $m_order->read_order_by_id(137);
		$carts = $_SESSION["cart"];
		$total_order = 0;


		//views
		$title = "Export PDF";
		include("views/cart/v_pdf.php");
	}

	public function paypal_success() {
		$order_id = $_GET["order_id"];
		include("models/m_order.php");
		$m_order = new M_order();
		$order = $m_order->read_order_by_id($order_id);
		$m_pro = new M_products();
		$carts = $m_order->read_detail_by_order($order_id);
		$total_order = 500;
		$view = "views/cart/v_success.php";
		$title = "Order Successfully";
		include("include/layout.php");
	}
}