<?php
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
require('start.php');



$payer = new Payer();
$payer->setPaymentMethod('paypal');
$arrItem = [];
$subtotal = 0;
foreach($_SESSION["cart"] as $key=>$cart) {
	$subtotal += $cart["price"]*$cart["qty"];
	$product = $m_pro->read_product_by_id($cart["id"]);
	$item = new Item();
	$item->setName($product->name)
	 ->setCurrency('USD')
	 ->setQuantity($cart["qty"])
	 ->setPrice($cart["price"]);
	$arrItem[] = $item;
}
$product = "coffe";
$price = 10;
$shipping = 2.00;
$total = $subtotal + $delivery_cost;
// $item = new Item();
// $item->setName($product)
// 	 ->setCurrency('GBP')
// 	 ->setQuantity(1)
// 	 ->setPrice($price);

$itemList = new ItemList();
$itemList->setItems($arrItem);

$details = new Details();
$details->setShipping($delivery_cost)
		->setSubtotal($subtotal);

$amount = new Amount();	
$amount->setCurrency('USD')
	   ->setTotal($total)
	   ->setDetails($details);

$transaction = new Transaction();
$transaction->setAmount($amount)
			->setItemList($itemList)
			->setDescription('PayForSomething Payment')
			->setInvoiceNumber(uniqid());
$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl(SITE_URL.'/cart_paypal_success.php?order_id='.$order_id.'&success=true')
		->setCancelUrl(SITE_URL.'pay.php?success=false');

$payment = new Payment();
$payment->setIntent('sale')
	->setPayer($payer)
	->setRedirectUrls($redirectUrls)
	->setTransactions([$transaction]);

try {
	$payment->create($paypal);
} catch(Exception $e) {
	die($e);
}

$approvalUrl = $payment->getApprovalLink();
header("Location:{$approvalUrl}");
?>