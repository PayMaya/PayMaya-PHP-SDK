<?php

namespace PayMaya\Test\Model\Checkout;

use PayMaya\Model\Checkout\ItemAmountDetails;

class ItemAmountDetailsTest extends \PHPUnit_Framework_TestCase
{
	public static function getObject()
	{
		$itemAmountDetails = new ItemAmountDetails();
		$itemAmountDetails->discount = "0.00";
		$itemAmountDetails->serviceCharge = "0.00";
		$itemAmountDetails->shippingFee = "14.00";
		$itemAmountDetails->tax = "5.00";
		$itemAmountDetails->subtotal = "50.00";
		return $itemAmountDetails;
	}

	public function testInitialization()
	{
		$obj = self::getObject();
		$this->assertEquals($obj->discount, "0.00");
		$this->assertEquals($obj->serviceCharge, "0.00");
		$this->assertEquals($obj->shippingFee, "14.00");
		$this->assertEquals($obj->tax, "5.00");
		$this->assertEquals($obj->subtotal, "50.00");
	}
}
