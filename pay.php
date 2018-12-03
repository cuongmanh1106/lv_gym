<?php
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
require 'controllers/start.php';

if(!isset($_GET["success"],$_GET["paymentId"],$_GET["PayerID"])) {
	die();
}
if(!$_GET["success"]) {
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

echo 'Paymend made. Thanks';

?>