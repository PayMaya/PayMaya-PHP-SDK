<?php

require __DIR__ . "/User.php";

use PayMaya\PayMayaSDK;
use PayMaya\API\Checkout;
use PayMaya\Model\Checkout\Item;
use PayMaya\Model\Checkout\ItemAmount;
use PayMaya\Model\Checkout\ItemAmountDetails;

PayMayaSDK::getInstance()->initCheckout("pk-iaioBC2pbY6d3BVRSebsJxghSHeJDW4n6navI7tYdrN", 
										"sk-uh4ZFfx9i0rZpKN6CxJ826nVgJ4saGGVAH9Hk7WrY6Q", 
										"SANDBOX");

// Item
$itemAmountDetails = new ItemAmountDetails();
$itemAmountDetails->shippingFee = "14.00";
$itemAmountDetails->tax = "5.00";
$itemAmountDetails->subtotal = "50.00";
$itemAmount = new ItemAmount();
$itemAmount->currency = "PHP";
$itemAmount->value = "69.00";
$itemAmount->details = $itemAmountDetails;
$item = new Item();
$item->name = "Leather Belt";
$item->code = "pm_belt";
$item->description = "Medium-sized belt made from authentic leather";
$item->quantity = "1";
$item->amount = $itemAmount;
$item->totalAmount = $itemAmount;

// Checkout
$itemCheckout = new Checkout();
$user = new User();
$itemCheckout->buyer = $user->buyerInfo();
$itemCheckout->items = array($item);
$itemCheckout->totalAmount = $itemAmount;
$itemCheckout->requestReferenceNumber = "123456789";
$itemCheckout->redirectUrl = array(
	"success" => "https://shop.com/success",
	"failure" => "https://shop.com/failure",
	"cancel" => "https://shop.com/cancel"
	);
$itemCheckout->execute();
$itemCheckout->retrieve();

echo "Checkout ID: " . $itemCheckout->id . "\n";
echo "Checkout URL: " . $itemCheckout->url . "\n";
