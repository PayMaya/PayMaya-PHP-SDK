<?php

require __DIR__ . "/../autoload.php";

use PayMaya\PayMayaSDK;
use PayMaya\API\Webhook;

PayMayaSDK::getInstance()->initCheckout("pk-iaioBC2pbY6d3BVRSebsJxghSHeJDW4n6navI7tYdrN", 
										"sk-uh4ZFfx9i0rZpKN6CxJ826nVgJ4saGGVAH9Hk7WrY6Q", 
										"SANDBOX");

$successWebhook = new Webhook();
$successWebhook->name = Webhook::CHECKOUT_SUCCESS;
$successWebhook->callbackUrl = "http://shop.someserver.com/success";
$successWebhook->register();

$failureWebhook = new Webhook();
$failureWebhook->name = Webhook::CHECKOUT_FAILURE;
$failureWebhook->callbackUrl = "http://shop.someserver.com/failure";
$failureWebhook->register();

$webhooks = Webhook::retrieve();
print_r($webhooks);

$webhook = $webhooks[0];
$webhook->callbackUrl .= "Updated";
$webhook->update();
print_r(Webhook::retrieve());

$webhookCopy = clone $webhook;
echo $webhook->delete();

print_r(Webhook::retrieve());

$webhookCopy->register();

print_r(Webhook::retrieve());