<?php

require __DIR__ . "/User.php";

use PayMaya\PayMayaSDK;
use PayMaya\API\Checkout;
use PayMaya\Model\Checkout\Item;
use PayMaya\Model\Checkout\ItemAmount;
use PayMaya\Model\Checkout\ItemAmountDetails;

PayMayaSDK::getInstance()->initCheckout("pk-iaioBC2pbY6d3BVRSebsJxghSHeJDW4n6navI7tYdrN", "SANDBOX");

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
$itemCheckout->execute();

echo "Checkout ID: " . $itemCheckout->getCheckoutId() . "\n";
echo "Checkout URL: " . $itemCheckout->getRedirectUrl() . "\n";
