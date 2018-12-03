<?php
require 'vendor/autoload.php';
define('SITE_URL','http://localhost/lv_gym');

$paypal = new \PayPal\Rest\ApiContext(
	new \PayPal\Auth\OAuthTokenCredential(
		'AVHUCszSl9BtQ52G4cjMOLNBm7lWXSPRHfW4CjsQsmKol56DqTmNzj5N_71j7MLtqDs6UePIWRxdEr96',
		'EJ9z6Rq6qLX3kyRdeeutPLXFcaad8Dy6PUjtPs1oNeI_XZVHj4NyE3dXsggEQW-qojH8AvymVtoE5oPo'
	)
);
?>