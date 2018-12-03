<?php
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
require('controllers/start.php');
$payer = new Payer();
$payer->setPaymentMethod('paypal');

$product = "coffe";
$price = 10;
$shipping = 2.00;
$total = $price + $shipping;
$item = new Item();
$item->setName($product)
	 ->setCurrency('GBP')
	 ->setQuantity(1)
	 ->setPrice($price);

$itemList = new ItemList();
$itemList->setItems([$item]);

$details = new Details();
$details->setShipping($shipping)
		->setSubtotal($price);

$amount = new Amount();	
$amount->setCurrency('GBP')
	   ->setTotal($total)
	   ->setDetails($details);

$transaction = new Transaction();
$transaction->setAmount($amount)
			->setItemList($itemList)
			->setDescription('PayForSomething Payment')
			->setInvoiceNumber(uniqid());
$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl(SITE_URL.'/pay.php?success=true')
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