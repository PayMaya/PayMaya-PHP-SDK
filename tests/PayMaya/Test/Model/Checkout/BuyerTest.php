<?php

namespace PayMaya\Test\Model\Checkout;

use PayMaya\Model\Checkout\Buyer;

class BuyerTest extends \PHPUnit_Framework_TestCase
{
	public static function getObject()
	{
		$buyer = new Buyer();
		$buyer->firstName = "John";
		$buyer->middleName = "Michaels";
		$buyer->lastName = "Doe";
		$buyer->contact = ContactTest::getObject();
		$buyer->shippingAddress = AddressTest::getObject();
		$buyer->billingAddress = AddressTest::getObject();
		return $buyer;
	}

	public function testInitialization()
	{
		$obj = self::getObject();
		$this->assertEquals($obj->firstName, "John");
		$this->assertEquals($obj->middleName, "Michaels");
		$this->assertEquals($obj->lastName, "Doe");
		$this->assertEquals($obj->contact, ContactTest::getObject());
		$this->assertEquals($obj->shippingAddress, AddressTest::getObject());
		$this->assertEquals($obj->billingAddress, AddressTest::getObject());
	}
}
