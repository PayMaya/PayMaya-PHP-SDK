<?php

namespace PayMaya\Test\Model\Checkout;

use PayMaya\Model\Checkout\ItemAmount;

class ItemAmountTest extends \PHPUnit_Framework_TestCase
{
	public static function getObject()
	{
		$itemAmount = new ItemAmount();
		$itemAmount->currency = "PHP";
		$itemAmount->value = "69.00";
		$itemAmount->details = ItemAmountDetailsTest::getObject();
		return $itemAmount;
	}

	public function testInitialization()
	{
		$obj = self::getObject();
		$this->assertEquals($obj->currency, "PHP");
		$this->assertEquals($obj->value, "69.00");
		$this->assertEquals($obj->details, ItemAmountDetailsTest::getObject());
	}
}
