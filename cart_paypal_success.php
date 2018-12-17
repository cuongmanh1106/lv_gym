<?php

use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
require 'controllers/start.php';

if(!isset($_GET["success"],$_GET["paymentId"],$_GET["PayerID"])) {
	die();
}
if(!$_GET["success"]) {
	require("models/m_order.php");
	$m_order = new M_order();
	$m_order->update_status(5,$_GET["order_id"]);
	echo "<script>alert('So tien trong tai khoang khong du de thuc hien giao dich nay'); window.location='.'</script>";
	die();
}

$paymentId = $_GET["paymentId"];
$payerId = $_GET["PayerID"];

$payment = Payment::get($paymentId,$paypal);
$execute = new PaymentExecution();
$execute->setPayerId($payerId);

try{

	$result  = $payment->execute($execute,$paypal);
} catch(Exception $e) {
	die($e);
}

include("controllers/c_cart.php");
$p = new C_cart();
$p->paypal_success();
?>