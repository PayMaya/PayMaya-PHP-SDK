<?php

namespace PayMaya\Test\Model\Checkout;

use PayMaya\Model\Checkout\Address;

class AddressTest extends \PHPUnit_Framework_TestCase
{
	public static function getObject()
	{
		$address = new Address();
		$address->line1 = "9F Robinsons Cybergate 3";
		$address->line2 = "Pioneer Street";
		$address->city = "Mandaluyong City";
		$address->state = "Metro Manila";
		$address->zipCode = "12345";
		$address->countryCode = "PH";
		return $address;
	}

	public function testInitialization()
	{
		$obj = self::getObject();
		$this->assertEquals($obj->line1, "9F Robinsons Cybergate 3");
		$this->assertEquals($obj->line2, "Pioneer Street");
		$this->assertEquals($obj->city, "Mandaluyong City");
		$this->assertEquals($obj->state, "Metro Manila");
		$this->assertEquals($obj->zipCode, "12345");
		$this->assertEquals($obj->countryCode, "PH");
	}
}
